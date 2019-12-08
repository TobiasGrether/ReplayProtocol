<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\utils\ReplayStream;

class EntityDespawnEntry extends BaseEntry
{
    public const INTERPRETER_ID = 0;

    public $eid;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->eid = $this->getInt();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->eid);
    }
}