<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerItemConsumeEntry extends BaseEntry
{
    public $eid;
    public $item_id;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->eid = $this->getInt();
        $this->item_id = $this->getInt();
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->eid);
        $this->putInt($this->item_id);
    }
}