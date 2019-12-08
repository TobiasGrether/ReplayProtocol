<?php
namespace tobiasdev\replay\protocol\entries;
use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class BlockPlaceEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::BLOCK_PLACE;

    public $x, $y, $z;

    public $block_id, $block_dmg;
    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->x = $this->getInt();
        $this->y = $this->getInt();
        $this->z = $this->getInt();
        $this->block_id = $this->getInt();
        $this->block_dmg = $this->getInt();
    }
    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->x);
        $this->putInt($this->y);
        $this->putInt($this->z);
        $this->putInt($this->block_id);
        $this->putInt($this->block_dmg);
    }
}