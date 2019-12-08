<?php

namespace tobiasdev\replay\protocol;

use tobiasdev\replay\protocol\entries\BlockBreakEntry;
use tobiasdev\replay\protocol\entries\BlockPlaceEntry;
use tobiasdev\replay\protocol\entries\EntityDespawnEntry;
use tobiasdev\replay\protocol\entries\EntitySpawnEntry;
use tobiasdev\replay\protocol\entries\PlayerAnimationEntry;
use tobiasdev\replay\protocol\entries\PlayerChatEntry;
use tobiasdev\replay\protocol\entries\PlayerGamemodeChangeEntry;
use tobiasdev\replay\protocol\entries\PlayerHotbarFocusEntry;
use tobiasdev\replay\protocol\entries\PlayerItemConsumeEntry;
use tobiasdev\replay\protocol\entries\PlayerMoveEntry;
use tobiasdev\replay\protocol\entries\PlayerQuitEntry;
use tobiasdev\replay\protocol\entries\PlayerSpawnEntry;
use tobiasdev\replay\protocol\entries\PlayerToggleSneakEntry;

class ProtocolLib
{

    public const PLAYER_MOVE = 0x01;
    public const PLAYER_CHAT = 0x02;
    public const BlOCK_BREAK = 0x03;
    public const BLOCK_PLACE = 0x04;
    public const PLAYER_ANIMATION = 0x05;
    public const PLAYER_QUIT = 0x06;
    public const PLAYER_TOGGLE_SNEAK = 0x07;
    public const PLAYER_GAMEMODE_CHANGE = 0x08;
    public const PLAYER_ITEM_CONSUME = 0x09;
    public const ENTITY_DESPAWN = 0x10;
    public const PLAYER_SPAWN = 0x11;
    public const PLAYER_HOTBAR_FOCUS = 0x12;

    /**
     * This array is a list of all Entrys and there associated IDs
     * It is used to initialize newly created EntryPools in threads
     * other than the Main Thread
     */
    public const PACKET_LIST = array(
        0x01 => PlayerMoveEntry::class,
        0x02 => PlayerChatEntry::class,
        0x03 => BlockBreakEntry::class,
        0x04 => BlockPlaceEntry::class,
        0x05 => PlayerAnimationEntry::class,
        0x06 => PlayerQuitEntry::class,
        0x07 => PlayerToggleSneakEntry::class,
        0x08 => PlayerGamemodeChangeEntry::class,
        0x09 => PlayerItemConsumeEntry::class,
        0x10 => EntityDespawnEntry::class,
        0x11 => PlayerSpawnEntry::class,
        0x12 => PlayerHotbarFocusEntry::class
    );
    public const EXCEPTION_REPLAY_NOT_FOUND = 0x69;
}