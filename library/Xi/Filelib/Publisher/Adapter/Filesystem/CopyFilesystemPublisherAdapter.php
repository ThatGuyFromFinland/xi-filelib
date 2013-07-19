<?php

/**
 * This file is part of the Xi Filelib package.
 *
 * For copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xi\Filelib\Publisher\Adapter\Filesystem;

use Xi\Filelib\File\File;
use Xi\Filelib\Publisher\PublisherAdapter;
use Xi\Filelib\Plugin\VersionProvider\VersionProvider;
use Xi\Filelib\Storage\Storage;
use Xi\Filelib\File\FileOperator;
use Xi\Filelib\Publisher\Linker;
use Xi\Filelib\FileLibrary;

/**
 * Publishes files in a filesystem by retrieving them from storage and creating a copy
 *
 * @author pekkis
 *
 */
class CopyFilesystemPublisherAdapter extends AbstractFilesystemPublisherAdapter implements PublisherAdapter
{
    /**
     * @var Storage
     */
    private $storage;

    public function setDependencies(FileLibrary $filelib)
    {
        $this->storage = $filelib->getStorage();
    }

    public function publish(File $file, Linker $linker)
    {
        $link = $this->getPublicRoot() . '/' . $linker->getLink($file, true);

        if (!is_file($link)) {

            $path = dirname($link);
            if (!is_dir($path)) {
                mkdir($path, $this->getDirectoryPermission(), true);
            }

            $tmp = $this->storage->retrieve($file->getResource());

            copy($tmp, $link);
            chmod($link, $this->getFilePermission());

        }
    }

    public function publishVersion(File $file, VersionProvider $version, Linker $linker)
    {
        $link = $this->getPublicRoot() . '/' .
            $linker->getLinkVersion($file, $version->getIdentifier(), $version->getExtensionFor($version));

        if (!is_file($link)) {

            $path = dirname($link);

            if (!is_dir($path)) {
                mkdir($path, $this->getDirectoryPermission(), true);
            }

            if ($version->areSharedVersionsAllowed()) {
                $tmp = $this->storage->retrieveVersion($file->getResource(), $version->getIdentifier(), null);
            } else {
                $tmp = $this->storage->retrieveVersion($file->getResource(), $version->getIdentifier(), $file);
            }

            copy($tmp, $link);
            chmod($link, $this->getFilePermission());
        }
    }

    public function unpublish(File $file, Linker $linker)
    {
        $link = $this->getPublicRoot() . '/' . $linker->getLink($file);
        if (is_file($link)) {
            unlink($link);
        }
    }

    public function unpublishVersion(File $file, VersionProvider $version, Linker $linker)
    {
        $link = $this->getPublicRoot() . '/' .
            $linker->getLinkVersion($file, $version->getIdentifier(), $version->getExtensionFor($version));
        if (is_file($link)) {
            unlink($link);
        }
    }
}