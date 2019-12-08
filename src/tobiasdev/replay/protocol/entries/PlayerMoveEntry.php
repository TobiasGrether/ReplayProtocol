<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerMoveEntry extends BaseEntry
{

    public const INTERPRETER_ID = ProtocolLib::PLAYER_MOVE;


    /** @var float */
    public $x, $y, $z;

    /** @var string */
    public $eid;

    /** @var float */
    public $yaw, $pitch;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->x = $this->getFloat();
        $this->y = $this->getFloat();
        $this->z = $this->getFloat();
        $this->eid = $this->getString();
        $this->yaw = $this->getFloat();
        $this->pitch = $this->getFloat();
    }

    public function encode(ReplayStream $stream)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putFloat($this->x);
        $this->putFloat($this->y);
        $this->putFloat($this->z);
        $this->putString($this->eid);
        $this->putFloat($this->yaw);
        $this->putFloat($this->pitch);
    }
}