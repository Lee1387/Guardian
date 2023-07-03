<?php

namespace Lee1387\Guardian\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Lee1387\Guardian\session\SessionFactory;
use Lee1387\Guardian\session\SessionUtils;
use Lee1387\Guardian\utils\Permissions;
use Lee1387\Guardian\utils\Prefixes;

class FreezeCommand extends Command {

    public function __construct()
    {
        parent::__construct("freeze");

        $this->setPermission(Permissions::FREEZE_COMMAND);

        $this->setDescription("Guardian Freeze Command");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): void 
    {
        if (!$player instanceof Player) return;

        if (!$this->testPermission($player)) {
            $player->sendMessage(Prefixes::PLUGIN . "You don't have permission to use this.");
            return;
        }

        if (!isset($args[0])) {
            $player->sendMessage(Prefixes::FREEZE . "Usage: /freeze <player>");
            return;
        }

        $victim = SessionUtils::getPlayerByPrefix($args[0]);

        if (!$victim instanceof Player) {
            $player->sendMessage(Prefixes::FREEZE . "This player is not online.");
            return;
        }

        if (SessionFactory::isRegistered($victim)) {
            $player->sendMessage(Prefixes::FREEZE . "You can't freeze a person who is also in StaffMode!");
            return;
        }

        if (!SessionFactory::isFreeze($victim)) {
            SessionFactory::sendFreeze($victim);
            SessionUtils::broadcastMessage(Prefixes::FREEZE . "Player §e" . $victim->getName() . "§7 was frozen by §a" . $player->getName());
            return; 
        }

        SessionFactory::cancelFreeze($victim);
        SessionUtils::broadcastMessage(Prefixes::FREEZE . "Player §e" . $victim->getName() . "§7 was unfrozen by §a" . $player->getName());
    }
}