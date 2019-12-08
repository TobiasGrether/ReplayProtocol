<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerQuitEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_QUIT;

    public $eid;

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->eid);
        $this->putInt($this->tick);
    }

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->eid = $this->getInt();
        $this->tick = $this->getInt();
    }
}