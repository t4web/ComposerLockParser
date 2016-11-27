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
    "t4web/composer-lock-parser": "1.0.*"
}
```

Usage
------------
Creating ComposerInfo object
```php
$composerInfo = new ComposerLockParser\Composer('/path/to/composer.lock');
$composerInfo->parse();

$packages = $composerInfo->getPackages();

$packages[0]->getName();
$packages[0]->getVersion();
$packages[0]->getNamespace();
```

Testing
------------
Tests runs with Codeception
```bash
$ codeception run
```
