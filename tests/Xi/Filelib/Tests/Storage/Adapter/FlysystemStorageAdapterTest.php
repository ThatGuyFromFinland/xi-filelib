<?php

/**
 * This file is part of the Xi Filelib package.
 *
 * For copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xi\Filelib\Tests\Storage\Adapter;

use League\Flysystem\Plugin\ListFiles;
use Xi\Filelib\Storage\Adapter\Filesystem\DirectoryIdCalculator\TimeDirectoryIdCalculator;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Xi\Filelib\Storage\Adapter\Filesystem\PathCalculator\LegacyPathCalculator;
use Xi\Filelib\Storage\Adapter\FlysystemStorageAdapter;

/**
 * @group storage
 */
class FlysystemStorageAdapterTest extends TestCase
{
    private $filesystem;

    /**
     * @return Filesystem
     */
    private function getFilesystem()
    {
        if (!$this->filesystem) {
            $adapter = new LocalAdapter(ROOT_TESTS . '/data/files');
            $this->filesystem = new Filesystem($adapter);
        }

        return $this->filesystem;
    }

    protected function tearDown()
    {
        $filesystem = $this->getFilesystem();
        foreach ($filesystem->listFiles('', true) as $file) {

            if (!preg_match('#\.gitignore#', $file['path'])) {
                $filesystem->delete($file['path']);
            }
        }
    }

    protected function getStorage()
    {
        $filesystem = $this->getFilesystem();
        $filesystem->addPlugin(new ListFiles());

        $dc = new TimeDirectoryIdCalculator();
        $pc = new LegacyPathCalculator($dc);
        $storage = new FlysystemStorageAdapter($filesystem, $pc, false);
        return array($storage, true);
    }

}
