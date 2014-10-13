<?php

namespace ComposerLockParser\UnitTest;

use ComposerLockParser\ComposerInfo;
use ComposerLockParser\Package;

class ComposerInfoTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $pathToLockFile = 'path/to/composer.lock';

        $composerInfo = new ComposerInfo($pathToLockFile);

        $this->assertAttributeSame($pathToLockFile, 'pathToLockFile', $composerInfo);
    }

    public function testFileDoesNotExists()
    {
        $pathToLockFile = 'XXX/_data/composer.lock';

        $composerInfo = new ComposerInfo($pathToLockFile);

        $this->setExpectedException(
            'ComposerLockParser\RuntimeException',
            "File $pathToLockFile not found or not readable"
        );
        $composerInfo->parse();
    }

    public function testJsonParseError()
    {
        $pathToLockFile = 'tests/_data/bad_composer.lock';

        $composerInfo = new ComposerInfo($pathToLockFile);

        $this->setExpectedException(
            'ComposerLockParser\RuntimeException',
            "Json parser error: Syntax error, malformed JSON"
        );
        $composerInfo->parse();
    }

    public function testGeneralComposerInfo()
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
    }

}