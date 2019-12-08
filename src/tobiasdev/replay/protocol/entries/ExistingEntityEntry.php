<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\utils\ReplayStream;

class ExistingEntityEntry extends BaseEntry
{
    public $eid;
    public $entity_type;
    public $entity_tag;
    public $entity_varient;

    public $x, $y, $z; // Coordinates for Entity Spawning

    public $spawned = false; // For ReplayPlayer

    public $isPlayer = false;
    public $player_name;

    public function decode(string $data)
    {
        $this->setBuffer($data, 0);
        $this->tick = $this->getInt();
        $this->eid = $this->getString();
        $this->entity_type = $this->getShort();
        $this->entity_tag = $this->getString();
        $this->entity_varient = $this->getShort();
        $this->x = $this->getFloat();
        $this->y = $this->getFloat();
        $this->z = $this->getFloat();
        $this->isPlayer = $this->getBool();
        if ($this->isPlayer) {
            $this->player_name = $this->getString();
        }
    }

    public function encode(ReplayStream $streams)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putString($this->eid);
        $this->putShort($this->entity_type);
        $this->putString($this->entity_tag);
        $this->putShort($this->entity_varient);
        $this->putFloat($this->x);
        $this->putFloat($this->y);
        $this->putFloat($this->z);
        $this->putBool($this->isPlayer);
        if ($this->isPlayer) {
            $this->putString($this->player_name);
        }
    }
}