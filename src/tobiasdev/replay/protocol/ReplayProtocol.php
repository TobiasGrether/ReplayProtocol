<?php

namespace tobiasdev\replay\protocol;

use pocketmine\plugin\PluginBase;
use tobiasdev\replay\protocol\entries\PlayerMoveEntry;
use tobiasdev\replay\protocol\entries\PlayerChatEntry;

class ReplayProtocol extends PluginBase
{
    public function onEnable()
    {
        EntryPool::registerEntry(new PlayerChatEntry());
        EntryPool::registerEntry(new PlayerMoveEntry());
    }
}