<?php

namespace Xi\Tests\Filelib\Backend\Doctrine2\Entity;

class FolderTest extends \Xi\Tests\Filelib\TestCase
{
    /**
     * @test
     */
    public function classShouldExist()
    {
        $this->assertTrue(class_exists('Xi\Filelib\Backend\Doctrine2\Entity\Folder'));
    }
    
    
}