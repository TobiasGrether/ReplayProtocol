<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerToggleSneakEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_TOGGLE_SNEAK;

    public $eid;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->eid = $this->getInt();
        $this->tick = $this->getInt();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->eid);
        $this->putInt($this->tick);
    }
}