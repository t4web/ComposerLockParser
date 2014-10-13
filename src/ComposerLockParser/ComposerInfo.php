<?php

namespace ComposerLockParser;

use DateTime;

class ComposerInfo {

    /**
     * @var string
     */
    private $pathToLockFile;

    /**
     * @var array
     */
    private $decodedValue = [];

    /**
     * @var PackagesCollection
     */
    private $packages;

    public function __construct($pathToLockFile)
    {
        $this->pathToLockFile = $pathToLockFile;
    }

    public function parse()
    {
        $this->checkFile();

        $this->decodedValue = json_decode(file_get_contents($this->pathToLockFile), true);

        if (json_last_error()) {
            throw new RuntimeException("Json parser error: " . $this->getJsonLastErrorMsg());
        }
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return array_key_exists('hash', $this->decodedValue) ? $this->decodedValue['hash'] : null;
    }

    /**
     * @return string
     */
    public function getMinimumStability()
    {
        return array_key_exists('minimum-stability', $this->decodedValue) ? $this->decodedValue['minimum-stability'] : null;
    }

    /**
     * @return PackagesCollection
     */
    public function getPackages()
    {
        if ($this->packages) {
            return $this->packages;
        }

        $this->packages = new PackagesCollection();

        foreach($this->decodedValue['packages'] as $packageInfo) {
            $this->packages[] = new Package(
                $packageInfo['name'],
                $packageInfo['version'],
                $packageInfo['source'],
                $packageInfo['dist'],
                $packageInfo['require'],
                isset($packageInfo['requireDev']) ? $packageInfo['requireDev'] : [],
                $packageInfo['type'],
                $packageInfo['autoload'],
                isset($packageInfo['license']) ? $packageInfo['license'] : [],
                isset($packageInfo['authors']) ? $packageInfo['authors'] : [],
                $packageInfo['description'],
                $packageInfo['keywords'],
                new DateTime($packageInfo['time'])
            );
        }

        return $this->packages;
    }

    private function checkFile()
    {
        if (!file_exists($this->pathToLockFile)) {
            throw new RuntimeException("File {$this->pathToLockFile} not found or not readable");
        }
    }

    private function getJsonLastErrorMsg() {
        $errors = array(
            JSON_ERROR_NONE             => null,
            JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH   => 'Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR        => 'Unexpected control character found',
            JSON_ERROR_SYNTAX           => 'Syntax error, malformed JSON',
            JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );

        $error = json_last_error();
        return array_key_exists($error, $errors) ? $errors[$error] : "Unknown error ({$error})";
    }
}