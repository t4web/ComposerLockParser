<?php
namespace ComposerLockParser;

class ComposerInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testComposerInfo()
    {
        $pathToLockFile = 'tests/_data/composer.lock';

        $composerInfo = new ComposerInfo($pathToLockFile);

        $composerInfo->parse();

        $this->assertEquals('bc3fc96991a54bac5552cddfe6d7b201', $composerInfo->getHash());
        $this->assertEquals('stable', $composerInfo->getMinimumStability());

        $packages = $composerInfo->getPackages();

        $this->assertInstanceOf('ComposerLockParser\PackagesCollection', $packages);

        $package = $packages[0];

        $this->assertInstanceOf('ComposerLockParser\Package', $package);

        $this->assertEquals('league/climate', $package->getName());
        $this->assertEquals('2.4.0', $package->getVersion());
        $this->assertEquals('League\\CLImate', $package->getNamespace());

        $package = $packages[1];

        $this->assertInstanceOf('ComposerLockParser\Package', $package);

        $this->assertEquals('t4web/authentication', $package->getName());
        $this->assertEquals('dev-master', $package->getVersion());
        $this->assertEquals('Authentication', $package->getNamespace());

        $package = $packages[2];

        $this->assertInstanceOf('ComposerLockParser\Package', $package);

        $this->assertEquals('t4web/composer-lock-parser', $package->getName());
        $this->assertEquals('0.1.0', $package->getVersion());
        $this->assertEquals('ComposerLockParser', $package->getNamespace());

        $package = $packages[3];

        $this->assertInstanceOf('ComposerLockParser\Package', $package);

        $this->assertEquals('t4web/modules', $package->getName());
        $this->assertEquals('dev-master', $package->getVersion());
        $this->assertEquals('Modules', $package->getNamespace());

        $package = $packages[4];

        $this->assertInstanceOf('ComposerLockParser\Package', $package);

        $this->assertEquals('zendframework/zendframework', $package->getName());
        $this->assertEquals('2.3.3', $package->getVersion());
        $this->assertEquals('Zend', $package->getNamespace());
    }

}