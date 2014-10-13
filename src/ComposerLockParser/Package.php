<?php

namespace ComposerLockParser;

use DateTime;

class Package {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $version;

    /**
     * @var array
     */
    private $source;

    /**
     * @var array
     */
    private $dist;

    /**
     * @var array
     */
    private $require;

    /**
     * @var array
     */
    private $requireDev;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $autoload;

    /**
     * @var array
     */
    private $license;

    /**
     * @var array
     */
    private $authors;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $keywords;

    /**
     * @var DateTime
     */
    private $time;

    public function __construct($name, $version, array $source, array $dist, array $require,
        array $requireDev, $type, array $autoload, array $license, array $authors, $description,
        array $keywords, DateTime $time)
    {
        $this->name = $name;
        $this->version = $version;
        $this->source = $source;
        $this->dist = $dist;
        $this->require = $require;
        $this->requireDev = $requireDev;
        $this->type = $type;
        $this->autoload = $autoload;
        $this->license = $license;
        $this->authors = $authors;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->time = $time;
    }

} 