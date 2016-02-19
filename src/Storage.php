<?php

namespace xEdelweiss\Rada;

use TQ\Git\Repository\Repository;

class Storage
{
    /**
     * @var string
     */
    protected $storageRoot;

    /**
     * @var string
     */
    protected $storageId;

    /**
     * @var Repository
     */
    protected $gitWrapper;

    /**
     * Storage constructor.
     */
    public function __construct($storageId, $storageRoot = __DIR__ . '/../storage')
    {
        $this->storageRoot = $storageRoot;
        $this->storageId = $storageId;

        $this->gitWrapper = $this->initRepository();
    }

    /**
     * @return string
     */
    public function getStoragePath()
    {
        return realpath($this->storageRoot) . '/' . $this->storageId;
    }

    /**
     * @param string $storageId
     * @return Repository
     */
    protected function initRepository()
    {
        $repositoryPath = $this->getStoragePath();
        $git = Repository::open($repositoryPath, null, 0755, null, false);

        return $git;
    }
}