<?php
namespace tobiasdev\replay\protocol\api;
use tobiasdev\replay\protocol\utils\ReplayStream;

abstract class DownloadNotifier
{
    public abstract function notify(array $data);
}