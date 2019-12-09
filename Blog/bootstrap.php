<?php

defined('DOC_ROOT') || define('DOC_ROOT', __DIR__);
defined('APP_ROOT') || define('APP_ROOT', DOC_ROOT . '/app');
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function ($classname) {
  $path = DOC_ROOT . DS . $classname . '.php';

  if (file_exists($path)) {
    require_once $path;
  }
});

// register services
require_once APP_ROOT . DS . 'services.php';