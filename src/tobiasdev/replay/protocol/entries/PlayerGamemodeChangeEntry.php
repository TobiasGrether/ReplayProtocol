<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerGamemodeChangeEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_GAMEMODE_CHANGE;

    public $eid;
    public $gm;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->eid = $this->getInt();
        $this->gm = $this->getShort();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->eid);
        $this->putShort($this->gm);
    }
}