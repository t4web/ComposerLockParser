ComposerLockParser
==================

OOP reader of composer.lock file

Introduction
------------
Parse composer.lock file and return full information about installed packages in OOP style.

Requirements
------------

Features / Goals
----------------
* Create Composer Entity with full general information from composer.lock [IN PROGRESS]
* Create Package Entity with full information about packges [IN PROGRESS]

Installation
------------
### Main Setup

    ```json
    "require": {
        "t4web/composer-lock-parser": "0.1.*"
    }
    ```

Usage
------------
Creating ComposerInfo object
```php
$composerInfo = new ComposerLockParser\Composer('/path/to/composer.lock');
$composerInfo->getHash();

$packages = $composerInfo->getPackages();

$packages[0]->getName();
$packages[0]->getVersion();
$packages[0]->getAuthors()[0]->getName();
```

Testing
------------
Tests runs with Codeception
```bash
$ codeception run
```
