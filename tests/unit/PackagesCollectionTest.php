<?php

namespace ComposerLockParser\UnitTest;

use ComposerLockParser\PackagesCollection;

class PackagesCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $packagesCollection = new PackagesCollection([]);

    }

}