<?php

namespace Lee1387\Guardian;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Lee1387\Guardian\commands\ChatCommand;
use Lee1387\Guardian\commands\FreezeCommand;
use Lee1387\Guardian\commands\StaffCommand;
use Lee1387\Guardian\listeners\ItemListener;
use Lee1387\Guardian\listeners\StaffListener;
use Lee1387\Guardian\scheduler\MainScheduler;

class Loader extends PluginBase {
    use SingletonTrait;

    protected function onEnable(): void
    {
        self::setInstance($this);

        $this->getServer()->getCommandMap()->registerAll("Guardian", [
            new StaffCommand(),
            new ChatCommand(),
            new FreezeCommand()
        ]);

        $this->getServer()->getPluginManager()->registerEvents(new ItemListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new StaffListener(), $this);

        $this->getScheduler()->scheduleRepeatingTask(new MainScheduler(), 20);
    }
}