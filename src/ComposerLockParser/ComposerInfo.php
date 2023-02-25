<?php

namespace ComposerLockParser;

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

    /**
     * Constant flag for all packages, see getPackage()
     * @var int
     */
    const ALL = 0;

    /**
     * Constant flag for production packages, see getPackage()
     * @var int
     */
    const PRODUCTION = 1;

    /**
     * Constant flag for development packages, see getPackage()
     * @var int
     */
    const DEVELOPMENT = 2;

    public function __construct($pathToLockFile)
    {
        $this->pathToLockFile = $pathToLockFile;
    }

    private function parse()
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
     * Get the list of packages as a collection object.
     *
     * @param int $list What list of packages should we return.
     *      self::ALL - Both dev and production.
     *      self::PRODUCTION - Just production.
     *      se=lf::DEVELOPMENT - Just dev.
     * @return PackagesCollection of Package
     */
    public function getPackages($list = self::ALL)
    {
        if (empty($this->decodedValue)) {
            $this->parse();
        }

        // remove the check if packages is already set.

        $this->packages = new PackagesCollection();

        // Production packages
        if (in_array($list, [0, 1]) && isset($this->decodedValue['packages'])) {
            foreach ($this->decodedValue['packages'] as $packageInfo) {
                $this->packages->append(Package::factory($packageInfo));
            }
        }

        // Dev packages
        if (in_array($list, [0, 2]) && isset($this->decodedValue['packages-dev'])) {
            foreach ($this->decodedValue['packages-dev'] as $packageInfo) {
                $this->packages->append(Package::factory($packageInfo));
            }
        }

        return $this->packages;
    }

    private function checkFile()
    {
        if (!file_exists($this->pathToLockFile) || !is_readable($this->pathToLockFile)) {
            throw new RuntimeException("File {$this->pathToLockFile} not found or not readable.");
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
