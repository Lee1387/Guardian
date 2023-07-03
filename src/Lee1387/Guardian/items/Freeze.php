<?php

namespace Lee1387\Guardian\items;

use pocketmine\block\BlockTypeIds;
use pocketmine\block\utils\DyeColor;
use pocketmine\data\bedrock\item\BlockItemIdMap;
use pocketmine\item\Dye;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use Lee1387\Guardian\utils\ItemNames;

class Freeze extends Dye {

    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemTypeIds::DYE), ItemNames::FREEZE);
        $this->setCustomName(ItemNames::FREEZE);
        $this->setColor(DyeColor::LIGHT_BLUE());
    }
}