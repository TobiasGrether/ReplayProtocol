<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerSpawnEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_SPAWN;

    public $x, $y, $z;

    public $nametag;

    public $eid;

    public $name;
    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->x = $this->getFloat();
        $this->y = $this->getFloat();
        $this->z = $this->getFloat();
        $this->nametag = $this->getString();
        $this->eid = $this->getInt();
        $this->name = $this->getString();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putFloat($this->x);
        $this->putFloat($this->y);
        $this->putFloat($this->z);
        $this->putString($this->nametag);
        $this->putInt($this->eid);
        $this->putString($this->name);
    }
}