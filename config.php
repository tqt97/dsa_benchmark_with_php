<?php

// CLI Arguments
global $cliArgs;
$env = loadEnv();

// ANSI Color Codes
define("RESET", "\033[0m");
define("BOLD", "\033[1m");
define("RED", "\033[1;31m");
define("GREEN", "\033[1;32m");
define("YELLOW", "\033[1;33m");
define("BLUE", "\033[1;34m");
define("CYAN", "\033[1;36m");
define("WHITE", "\033[37m");

// Log Mode
define('LOG_TYPES', $env['LOG_TYPES'] ?? ['log', 'md']);
$logMode = $argv[2] ?? ($env['LOG_MODE'] ?? 'log');
if (!in_array($logMode, LOG_TYPES)) {
  die("\n❌ ERROR: Invalid log mode. Must be one of: " . implode(", ", LOG_TYPES) . "\n");
}
define("LOG_MODE", $logMode);
define("EXTENSION_RESULT_FILE", LOG_MODE === 'md' ? 'md' : 'log');

// Paths
define("BENCHMARK_LOCATION", $env['BENCHMARK_LOCATION'] ??  "benchmarks/");
define("RESULT_LOCATION", $env['RESULT_LOCATION'] ??  "results/");
define('SCRIPTS_LOCATION', $env['SCRIPTS_LOCATION'] ??  'src/commands/');
define('DEFAULT_SCRIPT', $env['DEFAULT_SCRIPT'] ??  SCRIPTS_LOCATION . 'benchmark.php');
define('ALGORITHMS_LIST_FILE', $env['ALGORITHMS_LIST_FILE'] ?? '/algorithms.md');
