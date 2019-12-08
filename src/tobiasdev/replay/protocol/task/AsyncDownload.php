<?php

namespace tobiasdev\replay\protocol\task;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use tobiasdev\replay\protocol\api\DownloadNotifier;
use tobiasdev\replay\protocol\ProtocolAPI;
use tobiasdev\replay\protocol\ProtocolLib;
use tobiasdev\replay\protocol\utils\ReplayStream;

class AsyncDownload extends AsyncTask
{
    public $rid;
    public $notifier = null;
    public const REPLAY_NOT_FOUND = 0x01;
    public const REPLAY_ERROR = 0x02;
    public const REPLAY_DOWNLOADED = 0x03;

    public function __construct(string $rid, DownloadNotifier $notifier = null)
    {
        $this->rid = $rid;
        $this->notifier = $notifier;
    }

    public function onRun()
    {
        $dat = file_get_contents(str_replace("{id}", $this->rid, ProtocolAPI::DOWNLOAD_PATH));

        $json = json_decode($dat, true);
        if (!is_null($json) && is_array($json)) {
            // Data is json formattable -> Error / SV
            if ($json["error_code"] == ProtocolLib::EXCEPTION_REPLAY_NOT_FOUND) {
                $this->setResult([self::REPLAY_NOT_FOUND]);
            } else {
                $this->setResult([self::REPLAY_ERROR]);
            }
        } else {
            // Data should be raw, continuing..
            $stream = new ReplayStream();
            $stream->initDataPool();
            $stream->decode(zlib_decode($dat));
            $this->setResult([
                self::REPLAY_DOWNLOADED,
                serialize($stream)
            ]);
            return;
        }
    }

    public function onCompletion(Server $server)
    {
        $result = $this->getResult();

        if (isset($this->getResult()[1])) {
            $result[1] = unserialize($this->getResult()[1]);
            /** @var $r ReplayStream */
        }

        if ($this->notifier != null) {
            $this->notifier->notify($result);
        }

    }
}