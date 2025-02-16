<?php

foreach (glob(__DIR__ . '/../../src/functions/*.php') as $file) {
  require_once $file;
}

// Load config
require_once __DIR__ . '/../../config.php';
