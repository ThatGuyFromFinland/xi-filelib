<?php

/**
 * This file is part of the Xi Filelib package.
 *
 * For copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xi\Filelib;

use DateTime;

interface Versionable
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return DateTime
     */
    public function getDateCreated();

    /**
     * @return array
     */
    public function getVersions();

    /**
     * @param mixed $version
     * @return self
     */
    public function addVersion($version);

    /**
     * @param mixed $version
     * @return self
     */
    public function removeVersion($version);

    /**
     * @param mixed $version
     * @return bool
     */
    public function hasVersion($version);
}
