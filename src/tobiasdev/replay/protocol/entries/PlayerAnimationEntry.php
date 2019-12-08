<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerAnimationEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_ANIMATION;

    public $type;
    public $eid;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->type = $this->getInt();
        $this->eid = $this->getInt();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->type);
        $this->putInt($this->eid);
    }
}