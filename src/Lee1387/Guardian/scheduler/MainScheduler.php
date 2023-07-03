<?php

namespace Lee1387\Guardian\scheduler;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use Lee1387\Guardian\session\SessionFactory;
use Lee1387\Guardian\session\SessionUtils;

class MainScheduler extends Task {

    public function onRun(): void 
    {
        foreach (SessionUtils::getPlayers() as $player) {
            if (!$player instanceof Player) return;

            if (SessionFactory::isRegistered($player)) {
                $player->setAllowFlight(true);
            }

            if (SessionFactory::isFreeze($player)) {
                $player->sendTip("§cYOU ARE FROZEN");
                return;
            }

            if (SessionFactory::isVanish($player)) {
                $player->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), null, 0, false));
                return;
            }
        }
    }
}