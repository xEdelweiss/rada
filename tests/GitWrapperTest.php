<?php

namespace xEdelweiss\Rada\Tests;

use TQ\Git\Repository\Repository;
use TQ\Vcs\Repository\Transaction;

class GitWrapperTest extends TestCase
{
    public function testGitInit()
    {
        $repositoryName = uniqid('repo-');
        $repositoryPath = $this->getRepositoryPath($repositoryName);

        $git = Repository::open($repositoryPath, null, 0755, null, false);

        $result = $git->transactional(function(Transaction $t) {
            file_put_contents($t->getRepositoryPath().'/text1.txt', 'Test 1');
            file_put_contents($t->getRepositoryPath().'/text2.txt', 'Test 2');

            $t->setCommitMsg('Add two test files');
        });

        $this->assertTrue(file_exists($repositoryPath));
        $this->assertEmpty($git->getStatus());
        $this->assertCount(1, $git->getLog());
        $this->assertContains('Add two test files', $git->getLog()[0]);
    }

    protected function getRepositoryPath($repositoryName)
    {
        return $this->getPathToStorageDir($repositoryName);
    }
}
