<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerHotbarFocusEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_HOTBAR_FOCUS;

    public $item_id;
    public $item_meta;
    public $eid;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->item_id = $this->getInt();
        $this->item_meta = $this->getInt();
        $this->eid = $this->getInt();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->item_id);
        $this->putInt($this->item_meta);
        $this->putInt($this->eid);
    }
}