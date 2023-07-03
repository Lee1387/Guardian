<?php

namespace Lee1387\Guardian\items;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use Lee1387\Guardian\utils\ItemNames;

class Teleport extends Item {

    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemTypeIds::COMPASS));
        $this->setCustomName(ItemNames::TELEPORT);
    }
}