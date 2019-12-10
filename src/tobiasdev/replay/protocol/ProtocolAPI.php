<?php

namespace tobiasdev\replay\protocol;

use pocketmine\Server;
use tobiasdev\replay\protocol\api\DownloadNotifier;
use tobiasdev\replay\protocol\task\AsyncDownload;
use tobiasdev\replay\protocol\task\AsyncUpload;
use tobiasdev\replay\protocol\utils\ReplayStream;

class ProtocolAPI
{
    public const HOST = "219.host.battlemc.de";
    public const PORT = "5758";
    public const SECKEY = "qw5qb2aQUAveh5DYv58T";
    
    public const UPLOAD_PATH = "http://" . self::HOST . ":" . self::PORT . "/replay/upload?seckey_io=" . self::SECKEY;
    public const DOWNLOAD_PATH = "http://" . self::HOST . ":" . self::PORT . "/replay/download/{id}?seckey_io=" . self::SECKEY;
    public const INFO_PATH = "http://" . self::HOST . ":" . self::PORT . "/replay/info/{id}?seckey_io=" . self::SECKEY;

    public static function compileAndUploadAsync(ReplayStream $stream)
    {
        Server::getInstance()->getAsyncPool()->submitTask(new AsyncUpload($stream));
    }

    public static function downloadReplay(string $name, DownloadNotifier $notifier = null)
    {

        Server::getInstance()->getAsyncPool()->submitTask(new AsyncDownload($name, $notifier));
    }


}
