<?php

namespace Lee1387\Guardian\items;

use pocketmine\block\utils\DyeColor;
use pocketmine\item\Dye;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use Lee1387\Guardian\utils\ItemNames;

class Vanish extends Dye {

    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemTypeIds::DYE), ItemNames::VANISH);
        $this->setCustomName(ItemNames::VANISH);
        $this->setColor(DyeColor::LIME());
    }
}