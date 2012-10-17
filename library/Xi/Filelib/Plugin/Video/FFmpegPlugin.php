<?php

namespace Xi\Filelib\Plugin\Video;

use Xi\Filelib\Configurator;
use Xi\Filelib\File\File;
use Xi\Filelib\Plugin\ConsoleHelper;
use Xi\Filelib\Plugin\VersionProvider\AbstractVersionProvider;
use Xi\Filelib\Plugin\VersionProvider\VersionProvider;

class FFmpegPlugin extends AbstractVersionProvider implements VersionProvider
{
    protected $providesFor = array('video');

    public function createVersions(File $file)
    {
        $ffmpeg = new ConsoleHelper('ffmpeg', 'en_US.UTF-8');
    }

    public function getExtensionFor($version)
    {
    }

    public function getVersions()
    {
        return array(); // @TODO calculate from options' outfiles
    }

    public function getDuration(File $file)
    {
        return (float) $this->getVideoInfo($file)->format->duration;
    }

    public function getVideoInfo(File $file)
    {
        $probe = new ConsoleHelper('ffprobe');
        $path = $this->getStorage()->retrieve($file)->getPathname();

        $json = implode("\n", $probe->execute(
            sprintf("-loglevel quiet -print_format json -show_format %s", $path)
        ));
        return json_decode($json);
    }
}