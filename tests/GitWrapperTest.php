<?php

namespace xEdelweiss\Rada\Tests;

use TQ\Git\Repository\Repository;
use TQ\Vcs\Repository\Transaction;

class GitWrapperTest extends TestCase
{
    public function testGitInit()
    {
        $repositoryPath = $this->getRandomRepositoryPath();

        $git = Repository::open($repositoryPath, null, 0755, null, false);
        $commitMsg = 'Add two test files';

        $result = $git->transactional(function(Transaction $t) use ($commitMsg) {
            file_put_contents($t->getRepositoryPath().'/text1.txt', 'Test 1');
            file_put_contents($t->getRepositoryPath().'/text2.txt', 'Test 2');

            $t->setCommitMsg($commitMsg);
        });

        $this->assertTrue(file_exists($repositoryPath));
        $this->assertEmpty($git->getStatus());
        $this->assertCount(1, $git->getLog());
        $this->assertContains($commitMsg, $git->getLog()[0]);
    }

    protected function getRepositoryPath($repositoryName)
    {
        return $this->getPathToStorageDir($repositoryName);
    }

    protected function getRandomRepositoryPath()
    {
        $repositoryName = uniqid('repo-');
        return $this->getRepositoryPath($repositoryName);
    }
}
