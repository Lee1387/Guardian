<?php

namespace Lee1387\Guardian\forms;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\Position;
use Lee1387\Guardian\FormAPI\SimpleForm;
use Lee1387\Guardian\session\SessionUtils;
use Lee1387\Guardian\utils\Prefixes;

class TeleportMenu extends SimpleForm {

    public function __construct()
    {
        parent::__construct(function (Player $player, $data = null) {
            if (is_null($data)) {
                return;
            }

            if (SessionUtils::equals($data, "close")) {
                return;
            }

            $objective = Server::getInstance()->getPlayerExact($data);

            if (!$objective instanceof Player) {
                $player->sendMessage(Prefixes::PLUGIN . "This Player is Not Online");
                return;
            }

            if (SessionUtils::equals($player->getName(), $objective->getName())) {
                $player->sendMessage(Prefixes::PLUGIN . "No...");
                return;
            }

            $x = $objective->getPosition()->getX();
            $y = $objective->getPosition()->getY();
            $z = $objective->getPosition()->getZ();
            $world = $objective->getPosition()->getWorld();

            $player->teleport(new Position($x, $y, $z, $world));
            $player->sendMessage(Prefixes::PLUGIN . "Successfully Teleported To §e" . $objective->getName());

        });
        $this->setTitle("Player List");
        foreach (SessionUtils::getPlayers() as $player) {
            $this->addButton($player->getName() . "\nTap To Teleport", 0, "textures/ui/icon_steve", $player->getName());
        }
        $this->addButton("Close", 0, "textures/ui/redX1", "close");
    }
}