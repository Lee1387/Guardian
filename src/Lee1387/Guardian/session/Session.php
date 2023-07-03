<?php

namespace Lee1387\Guardian\session;

use pocketmine\player\Player;

class Session {

    public Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }
}