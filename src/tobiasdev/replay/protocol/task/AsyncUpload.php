<?php

namespace tobiasdev\replay\protocol\task;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use tobiasdev\replay\protocol\api\UploadNotifier;
use tobiasdev\replay\protocol\ProtocolAPI;
use tobiasdev\replay\protocol\utils\ReplayStream;

class AsyncUpload extends AsyncTask
{
    public const COMPRESSION_LEVEL = 4;
    public $data;
    public $notifier = null;

    public function __construct(ReplayStream $data, UploadNotifier $notifier = null)
    {
        $this->data = serialize($data);
        $this->notifier = $notifier;
    }

    public function onRun()
    {
        $start = microtime(true);
        $data = unserialize($this->data);

        if ($data instanceof ReplayStream) {
            var_dump("[$data->rid] Uploading " . count($data->data) . " Entries and " . count($data->entities) . " Entities");
            $str = $data->encode();
            $comp = zlib_encode($str, ZLIB_ENCODING_GZIP, 9);
            file_put_contents($data->rid . ".rpld", $comp);
            $fields = [];
            $fields["replay"] = curl_file_create($data->rid . ".rpld");
            $fields["server"] = $data->server;
            $fields["rid"] = $data->rid;
            $curl = curl_init(ProtocolAPI::UPLOAD_PATH);
            curl_setopt($curl, CURLOPT_URL, ProtocolAPI::UPLOAD_PATH);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "multipart/form-data"]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
            curl_exec($curl);
            unlink($data->rid . ".rpld");
        }
        $this->setResult((microtime(true) - $start));
    }

    public function onCompletion(Server $server)
    {
        if ($this->notifier != null) $this->notifier->notify();
        Server::getInstance()->getLogger()->warning("Uploaded in " . $this->getResult() . " Second(s)");
    }
}
