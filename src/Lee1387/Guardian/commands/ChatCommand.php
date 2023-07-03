<?php

namespace Lee1387\Guardian\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Lee1387\Guardian\session\SessionFactory;
use Lee1387\Guardian\utils\Permissions;
use Lee1387\Guardian\utils\Prefixes;

class ChatCommand extends Command {

    public function __construct()
    {
        parent::__construct("staffchat");

        $this->setPermission(Permissions::CHAT_COMMAND);

        $this->setAliases(["sc"]);

        $this->setDescription("Guardian Chat Command");
    }

    public function execute(CommandSender $player, string $commandLabel, array $args): void
    {
        if (!$player instanceof Player) return;

        if (!$this->testPermission($player)) {
            $player->sendMessage(Prefixes::PLUGIN . "You dont have permission to use this.");
            return;
        }

        if (!SessionFactory::isChat($player)) {
            SessionFactory::sendChat($player);
            $player->sendMessage(Prefixes::PLUGIN . "You have entered StaffChat");
            return;
        }

        if (SessionFactory::isChat($player)) {
            SessionFactory::cancelChat($player);
            $player->sendMessage(Prefixes::PLUGIN . "You have exited StaffChat");
            return;
        }
    }
}