<?php

namespace Xi\Filelib\Tests\File\Command;

class AbstractResourceCommandTest extends \Xi\Filelib\Tests\TestCase
{

    /**
     * @test
     */
    public function classShouldExist()
    {
        $this->assertClassExists('Xi\Filelib\Resource\Command\AbstractResourceCommand');
        $this->assertImplements(
            'Xi\Filelib\Command\Command',
            'Xi\Filelib\Resource\Command\AbstractResourceCommand'
        );
    }

    /**
     * @test
     */
    public function attachesFromFilelib()
    {
        $rere = $this->getMockedResourceRepository();
        $filelib = $this->getMockedFilelib(
            null,
            array(
                'rere' => $rere,
            )
        );

        $command = $this->getMockForAbstractClass('Xi\Filelib\Resource\Command\AbstractResourceCommand');
        $command->attachTo($filelib);

        $this->assertAttributeSame($rere, 'resourceRepository', $command);
    }
}
