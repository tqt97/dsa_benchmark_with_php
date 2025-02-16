<?php

require_once "./src/bootstrap/autoload.php";

$args = parseArgs($argv);

// if argument is "help", show help
if (isset($args['help'])) {
  showHelp();
  exit(0);
}
// get first argument
$firstArg = $argv[1] ?? null;

// If there are no parameters or the first parameter is not a script, default runs scripts/benchmark.php
$script = (is_null($firstArg) || strpos($firstArg, '/') !== false) ? DEFAULT_SCRIPT : SCRIPTS_LOCATION . "{$firstArg}.php";

// Check if script not exists
if (!file_exists($script)) {
  die(sprintf("❌ ERROR: Script '%s' not found.\n", $script));
}

// Check to prevent access to system files
if (!str_starts_with(realpath($script), realpath(SCRIPTS_LOCATION))) {
  die("\033[1;31m❌ ERROR:\033[0m Invalid script path detected.\n");
}

// define $argv
$args = ($script === DEFAULT_SCRIPT) ? $argv : array_merge([$script], array_slice($argv, 2));

// update $argv, $argc
$argv = $args;
$argc = count($argv);

require_once realpath($script);
