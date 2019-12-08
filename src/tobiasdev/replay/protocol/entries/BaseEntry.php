<?php

namespace tobiasdev\replay\protocol\entries;
use pocketmine\network\mcpe\NetworkBinaryStream;
use tobiasdev\replay\protocol\utils\ReplayStream;

abstract class BaseEntry extends NetworkBinaryStream
{
    /** @var integer
     */
    public const INTERPRETER_ID = 0;

    public $tick = 0;

    public abstract function encode(ReplayStream $streams);

    public abstract function decode(string $data);
}