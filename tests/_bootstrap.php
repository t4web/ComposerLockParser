<?php
// This is global bootstrap for autoloading
if (file_exists('../../../vendor/autoload.php')) {
    include '../../../vendor/autoload.php';
} else {
    include './vendor/autoload.php';
}