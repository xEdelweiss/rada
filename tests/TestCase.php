<?php

namespace xEdelweiss\Rada\Tests;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $storagePath = __DIR__ . '/../storage';

    protected function getPathToStorageDir($dirName)
    {
        return realpath($this->storagePath) . '/' . $dirName;
    }
}