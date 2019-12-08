<?php

namespace tobiasdev\replay\protocol\entries;

use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class PlayerChatEntry extends BaseEntry
{
    public const INTERPRETER_ID = ProtocolLib::PLAYER_CHAT;

    public $message;

    public function decode(string $data)
    {
        $this->setBuffer($data);
        $this->tick = $this->getInt();
        $this->message = $this->getString();
    }

    public function encode(ReplayStream $stream)
    {
        $this->setBuffer("");
        $this->putInt($this->tick);
        $this->putString($this->message);
    }
}