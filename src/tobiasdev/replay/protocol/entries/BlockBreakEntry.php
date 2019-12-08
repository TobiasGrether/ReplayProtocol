<?php
namespace tobiasdev\replay\protocol\entries;
use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class BlockBreakEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::BlOCK_BREAK;

    public $x, $y, $z;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->x = $this->getInt();
        $this->y = $this->getInt();
        $this->z = $this->getInt();
    }
    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putInt($this->x);
        $this->putInt($this->y);
        $this->putInt($this->z);
    }
}