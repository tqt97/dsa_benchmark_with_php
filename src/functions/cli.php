<?php

/**
 * Parse CLI arguments into key-value pairs
 */
function parseArgs($argv)
{
  $args = [];
  foreach ($argv as $arg) {
    if (strpos($arg, '--') === 0) {
      $arg = ltrim($arg, '--');
      if (strpos($arg, '=') !== false) {
        list($key, $value) = explode('=', $arg, 2);
        $args[$key] = $value;
      } else {
        $args[$arg] = true;
      }
    } else {
      $args['command'][] = $arg;
    }
  }
  return $args;
}
