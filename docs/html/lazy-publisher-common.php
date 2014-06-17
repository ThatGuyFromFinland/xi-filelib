<?php

use Xi\Filelib\Publisher\Publisher;
use Xi\Filelib\Publisher\Adapter\Filesystem\SymlinkFilesystemPublisherAdapter;
use Xi\Filelib\Plugin\VersionProvider\OriginalVersionPlugin;
use Xi\Filelib\Plugin\Image\ArbitraryVersionPlugin;
use Xi\Filelib\Plugin\Image\VersionPlugin;
use Xi\Filelib\Publisher\Linker\ReversibleCreationTimeLinker;
use Xi\Filelib\VersionId;

$publisher = new Publisher(
    new SymlinkFilesystemPublisherAdapter(__DIR__ . '/web/lazy-files', '600', '700', 'lazy-files'),
    new ReversibleCreationTimeLinker()
);
$publisher->attachTo($filelib);

$originalPlugin = new OriginalVersionPlugin('original');
$filelib->addPlugin($originalPlugin, array('default'));

$arbitraryPlugin = new ArbitraryVersionPlugin(
    'arbitrary',
    function (array $params) {
        return array(
            array('setImageCompression',Imagick::COMPRESSION_JPEG),
            array('setImageFormat', 'jpg'),
            array('setImageCompressionQuality', 50),
            array('cropThumbnailImage', array($params['x'], round($params['x'] / 4))),
            array('sepiaToneImage', 90),
            'Xi\Filelib\Plugin\Image\Command\WatermarkCommand' => array(__DIR__ . '/watermark.png', 'se', 10),
        );
    },
    'image/jpeg'
);
$filelib->addPlugin($arbitraryPlugin);

$versionPlugin = new VersionPlugin(
    array(
        'cinemascope' => array(
            array(
                array('setImageCompression',Imagick::COMPRESSION_JPEG),
                array('setImageFormat', 'jpg'),
                array('setImageCompressionQuality', 50),
                array('cropThumbnailImage', array(800, 200)),
                array('sepiaToneImage', 90),
                'Xi\Filelib\Plugin\Image\Command\WatermarkCommand' => array(__DIR__ . '/watermark.png', 'se', 10),
            ),
            'image/jpeg'
        )
    )
);
$versionPlugin->enableLazyMode();
$filelib->addPlugin($versionPlugin);




