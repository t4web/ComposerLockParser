<?php

namespace ComposerLockParser\UnitTest;

use ComposerLockParser\Package;
use DateTime;

class PackageTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $packageInfo = [
            'name' => 'name value',
            'version' => 'version value',
            'source' => ['source value'],
            'dist' => ['dist value'],
            'require' => ['require value'],
            'requireDev' => ['requireDev value'],
            'suggest' => ['suggest value'],
            'type' => 'type value',
            'extra' => ['suggest value'],
            'autoload' => [
                "psr-4" => [
                    "Name\\Space\\" => "src/"
                ]
            ],
            'notificationUrl' => 'notificationUrl valuel',
            'license' => ['license value'],
            'authors' => ['authors value'],
            'description' => 'description value',
            'homepage' => 'homepage value',
            'keywords' => ['keywords value'],
            'time' => '2014-10-13 22:29:58',
        ];

        $package = Package::factory($packageInfo);

        $this->assertAttributeSame($packageInfo['name'], 'name', $package);
        $this->assertEquals($packageInfo['name'], $package->getName());
        $this->assertAttributeSame($packageInfo['version'], 'version', $package);
        $this->assertEquals($packageInfo['version'], $package->getVersion());
        $this->assertAttributeSame($packageInfo['source'], 'source', $package);
        $this->assertAttributeSame($packageInfo['dist'], 'dist', $package);
        $this->assertAttributeSame($packageInfo['require'], 'require', $package);
        $this->assertAttributeSame($packageInfo['require-dev'], 'require-dev', $package);
        $this->assertAttributeSame($packageInfo['suggest'], 'suggest', $package);
        $this->assertAttributeSame($packageInfo['type'], 'type', $package);
        $this->assertAttributeSame($packageInfo['extra'], 'extra', $package);
        $this->assertAttributeSame($packageInfo['autoload'], 'autoload', $package);
        $this->assertAttributeSame($packageInfo['notification-url'], 'notification-url', $package);
        $this->assertAttributeSame($packageInfo['license'], 'license', $package);
        $this->assertAttributeSame($packageInfo['authors'], 'authors', $package);
        $this->assertAttributeSame($packageInfo['description'], 'description', $package);
        $this->assertAttributeSame($packageInfo['homepage'], 'homepage', $package);
        $this->assertAttributeSame($packageInfo['keywords'], 'keywords', $package);
        $this->assertAttributeEquals(new DateTime($packageInfo['time']), 'time', $package);

        $this->assertEquals('Name\\Space', $package->getNamespace());
    }
}
