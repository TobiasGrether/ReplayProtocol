<?php

namespace tobiasdev\replay\protocol;

use tobiasdev\replay\protocol\entries\BaseEntry;

class EntryPool
{
    public static $entries = [];

    public static function registerEntry(BaseEntry $entry)
    {
        self::$entries[$entry::INTERPRETER_ID] = $entry;
    }

    public static function getEntryByID(int $id): ?BaseEntry
    {
        if (isset(self::$entries[$id])) {
            return clone self::$entries[$id];
        } else {
            return null;
        }
    }
}