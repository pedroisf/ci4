<?php
namespace Config;

use CodeIgniter\Cache\CacheInterface;
use CodeIgniter\Cache\Handlers\DummyHandler;
use CodeIgniter\Config\BaseConfig;

class Cache extends BaseConfig
{
    public string $handler = 'dummy';
    public string $backupHandler = 'dummy';
    public string $prefix = '';
    public int $ttl = 60;
    public string $reservedCharacters = '{}()/\@:';

    public array $file = [
        'storePath' => WRITEPATH . 'cache/',
        'mode' => 0640,
    ];

    public array $validHandlers = [
        'dummy' => DummyHandler::class
    ];

    public $cacheQueryString = false;
}
