<?php

namespace ComposerLockParser;

use ArrayObject;

class PackagesCollection extends ArrayObject
{
    /**
     * @var array
     */
    private $indexedByName;

    /**
     * @param string $name
     *
     * @return Package
     */
    public function getByName($name)
    {
        if (!$this->hasPackage($name)) {
            throw new \UnexpectedValueException("Package $name not exists");
        }

        return $this->getIndexedByName()[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasPackage($name)
    {
        return array_key_exists($name, $this->getIndexedByName());
    }

    public function offsetSet($index, $package)
    {
        if ($package instanceof Package) {
            $this->indexedByName[$package->getName()] = $package;
        }

        return parent::offsetSet($index, $package);
    }

    /**
     * @return array
     */
    private function getIndexedByName()
    {
        if (!empty($this->indexedByName)) {
            return $this->indexedByName;
        }

        /** @var Package $package */
        foreach($this->getArrayCopy() as $package) {
            if (!($package instanceof Package)) {
                continue;
            }
            $this->indexedByName[$package->getName()] = $package;
        }

        return $this->indexedByName;
    }

}