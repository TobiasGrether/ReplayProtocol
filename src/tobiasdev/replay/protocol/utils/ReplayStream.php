<?php

namespace tobiasdev\replay\protocol\utils;

use pocketmine\network\mcpe\NetworkBinaryStream;
use tobiasdev\replay\protocol\entries\BaseEntry;
use tobiasdev\replay\protocol\entries\ExistingEntityEntry;
use tobiasdev\replay\protocol\EntryPool;
use tobiasdev\replay\protocol\ProtocolLib;

class ReplayStream extends NetworkBinaryStream
{
    public $rid;

    public $lvl_name;

    public $start;

    public $stop;

    public $server;
    
    /** @var BaseEntry[] */
    public $data = [];

    /** @var ExistingEntityEntry[] */
    public $entities = [];

    public function encode()
    {
        $this->setBuffer("");
        $this->putString($this->rid);
        $this->putString($this->lvl_name);
        $this->putShort($this->start);
        $this->putShort($this->stop);
        $this->putInt(count($this->data));
        foreach ($this->data as $entry) {
            $this->putShort($entry::INTERPRETER_ID);
            $entry->encode($this);
            $this->putString($entry->getBuffer());
        }
        $this->putInt(count($this->entities));
        foreach ($this->entities as $entity) {
            $entity->encode($this);
            $this->putString($entity->getBuffer());
        }
        // Close
        return $this->getBuffer();
    }

    public function decode(string $data)
    {

        $this->setBuffer($data);
        $this->rid = $this->getString();
        $this->lvl_name = $this->getString();
        $this->start = $this->getShort();
        $this->stop = $this->getShort();
        $entries = $this->getInt();
        for ($i = 0; $i < $entries; $i++) {
            // Entry Decoding
            $entryId = $this->getShort();
            if (($entry = EntryPool::getEntryByID($entryId)) != null) {
                // Entry loading
                $entry->decode($this->getString());
                $this->data[] = $entry;
            } else {
                $this->getString(); // Skipping String of data
            }
        }
        $entity = null;
        $dat = $this->getInt();
        for ($i = 0; $i < $dat; $i++) {
            $entity = new ExistingEntityEntry();
            $entity->decode($this->getString());
            $this->entities[] = $entity;
        }
    }

    /**
     * This is called when EntryPool needs to be initialized beceause the stream en/decoding
     * is not run in the Main Thread ( I mean Mainframe *hust* )
     */
    public function initDataPool()
    {
        foreach (ProtocolLib::PACKET_LIST as $name => $path) {
            $entry = new $path;
            EntryPool::registerEntry($entry);
        }
    }

    public function toString()
    {
        return ($this->rid ?? "No RID") . " || " . $this->lvl_name . " || " . $this->start . " <> " . $this->stop . " || EntryCount: " . count($this->data) . " || EntityCount: " . count($this->entities);
    }
}
