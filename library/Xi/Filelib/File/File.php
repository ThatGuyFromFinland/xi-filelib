<?php

/**
 * This file is part of the Xi Filelib package.
 *
 * For copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xi\Filelib\File;

use DateTime;
use ArrayObject;
use Xi\Filelib\Identifiable;
use Xi\Filelib\Resource\Resource;

class File implements Identifiable
{
    const STATUS_RAW = 1;
    const STATUS_COMPLETED = 2;

    /**
     * Key to method mapping for fromArray
     *
     * @var array
     */
    protected static $map = array(
        'id' => 'setId',
        'folder_id' => 'setFolderId',
        'profile' => 'setProfile',
        'name' => 'setName',
        'date_created' => 'setDateCreated',
        'status' => 'setStatus',
        'uuid' => 'setUuid',
        'resource' => 'setResource',
        'versions' => 'setVersions',
        'data' => 'setData'
    );

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var mixed
     */
    private $folderId;

    /**
     * @var string
     */
    private $profile;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTime
     */
    private $dateCreated;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var ArrayObject
     */
    private $data;

    private function __construct()
    { }

    /**
     * Sets id
     *
     * @param  mixed $id
     * @return File
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets folder id
     *
     * @param  mixed $folderId
     * @return File
     */
    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;

        return $this;
    }

    /**
     * Returns folder id
     *
     * @return mixed
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * Returns mimetype
     *
     * @return string
     */
    public function getMimetype()
    {
        return $this->getResource()->getMimetype();
    }

    /**
     * Sets profile name
     *
     * @param  string $profile
     * @return File
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Returns profile name
     *
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Returns file size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->getResource()->getSize();
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns create date
     *
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets create date
     *
     * @param  DateTime $dateCreated
     * @return File
     */
    public function setDateCreated(DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Sets status
     *
     * @param  integer $status
     * @return File
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Returns status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return File
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     *
     * @param  Resource $resource
     * @return File
     */
    public function setResource(Resource $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Returns resource or null if file doesn't have one
     *
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Unsets resource
     */
    public function unsetResource()
    {
        $this->resource = null;
    }

    /**
     * Returns the file as standardized file array
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'folder_id' => $this->getFolderId(),
            'profile' => $this->getProfile(),
            'name' => $this->getName(),
            'date_created' => $this->getDateCreated(),
            'status' => $this->getStatus(),
            'resource' => $this->getResource(),
            'uuid' => $this->getUuid(),
            'data' => $this->getData(),
        );
    }

    /**
     * Sets data from array
     *
     * @param  array $data
     * @return File
     */
    public function fromArray(array $data)
    {
        foreach (static::$map as $key => $method) {
            if (isset($data[$key])) {
                $this->$method($data[$key]);
            }
        }

        return $this;
    }

    /**
     * Creates an instance with data
     *
     * @param  array $data
     * @return File
     */
    public static function create(array $data = array())
    {
        $file = new self();

        return $file->fromArray($data);
    }

    /**
     * @return ArrayObject
     */
    public function getData()
    {
        if (!$this->data) {
            $this->data = new ArrayObject();
        }

        return $this->data;
    }

    public function setData($data)
    {
        if (is_array($data)) {
            $data = new ArrayObject($data);
        }
        $this->data = $data;
        return $this;
    }


    /**
     * Sets currently created versions
     *
     * @param  array    $versions
     * @return Resource
     */
    public function setVersions(array $versions = array())
    {
        $data = $this->getData();
        $data['versions'] = $versions;

        return $this;
    }

    /**
     * Returns currently created versions
     *
     * @return array
     */
    public function getVersions()
    {
        $data = $this->getData();
        if (!isset($data['versions'])) {
            $data['versions'] = array();
        }
        return $data['versions'];
    }

    /**
     * Adds version
     *
     * @param string $version
     */
    public function addVersion($version)
    {
        $versions = $this->getVersions();
        if (!in_array($version, $versions)) {
            array_push($versions, $version);
            $this->setVersions($versions);
        }
    }

    /**
     * Removes a version
     *
     * @param string $version
     */
    public function removeVersion($version)
    {
        $versions = $this->getVersions();
        $versions = array_diff($versions, array($version));
        $this->setVersions($versions);
    }

    /**
     * Returns whether resource has version
     *
     * @param  string  $version
     * @return boolean
     */
    public function hasVersion($version)
    {
        return in_array($version, $this->getVersions());
    }

    public function __clone()
    {
        if ($this->data) {
            $this->data = clone $this->data;
        }
    }
}
