<?php

namespace xEdelweiss\Rada\Tests;

use TQ\Git\Repository\Repository;
use xEdelweiss\Rada\Storage;

class StorageTest extends TestCase
{
    public function testStorageInit()
    {
        $storage = new Storage(uniqid('storage-'));

        $storagePath = $storage->getStoragePath();

        $this->assertTrue(file_exists($storagePath));
    }
}
