Composer .lock Parser
==================

OOP reader of composer.lock file

Introduction
------------
Parse composer.lock file and return full information about installed packages in OOP style.

Requirements
------------

Features / Goals
----------------
* Create Composer Entity with full general information from composer.lock [DONE]
* Create Package Entity with full information about packges [DONE]

Installation
------------
### Main Setup

```json
"require": {
    "t4web/composer-lock-parser": "1.1.*"
}
```

Usage
------------
Creating ComposerInfo object and getting all of the packages
```php
$composerInfo = new \ComposerLockParser\ComposerInfo('/path/to/composer.lock');
// default all packages
$packages = $composerInfo->getPackages();
// or explicitly get all packages
$packages = $composerInfo->getPackages($composerInfo::ALL);

echo $packages[0]->getName();
echo $packages[0]->getVersion();
echo $packages[0]->getNamespace();
```

Getting just production packages.
```php
$composerInfo = new \ComposerLockParser\ComposerInfo('/path/to/composer.lock');
$packages = $composerInfo->getPackages($composerInfo::PRODUCTION);
```

Getting just development packages.
```php
$composerInfo = new \ComposerLockParser\ComposerInfo('/path/to/composer.lock');
$packages = $composerInfo->getPackages($composerInfo::DEVELOPMENT);
```

Testing
------------
Tests runs with Codeception
```bash
$ codeception run
```
