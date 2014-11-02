<?php

namespace ComposerLockParser\UnitTest;

use ComposerLockParser\PackagesCollection;
use Codeception\Util\Stub;

class PackagesCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testGetByName()
    {
        $package1 = Stub::make('ComposerLockParser\Package', array('getName' => 'package1'));
        $package2 = Stub::make('ComposerLockParser\Package', array('getName' => 'package2'));
        $package3 = Stub::make('ComposerLockParser\Package', array('getName' => 'package3'));
        $packagesCollection = new PackagesCollection();

        $packagesCollection[] = $package1;
        $packagesCollection[] = $package2;
        $packagesCollection[] = $package3;

        $this->assertTrue($packagesCollection->hasPackage('package1'));
        $this->assertEquals($package1, $packagesCollection->getByName('package1'));

        $this->assertTrue($packagesCollection->hasPackage('package2'));
        $this->assertEquals($package2, $packagesCollection->getByName('package2'));

        $this->assertTrue($packagesCollection->hasPackage('package3'));
        $this->assertEquals($package3, $packagesCollection->getByName('package3'));
    }

    public function testReIndexingByName()
    {
        $package1 = Stub::make('ComposerLockParser\Package', array('getName' => 'package1'));
        $package2 = Stub::make('ComposerLockParser\Package', array('getName' => 'package2'));
        $package3 = Stub::make('ComposerLockParser\Package', array('getName' => 'package3'));
        $packagesCollection = new PackagesCollection();

        $packagesCollection[] = $package1;
        $packagesCollection[] = $package2;

        $packagesCollection->hasPackage('package1');

        $packagesCollection[] = $package3;

        $this->assertTrue($packagesCollection->hasPackage('package1'));
        $this->assertEquals($package1, $packagesCollection->getByName('package1'));

        $this->assertTrue($packagesCollection->hasPackage('package2'));
        $this->assertEquals($package2, $packagesCollection->getByName('package2'));

        $this->assertTrue($packagesCollection->hasPackage('package3'));
        $this->assertEquals($package3, $packagesCollection->getByName('package3'));
    }

}