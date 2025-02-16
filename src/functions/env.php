<?php

/**
 * Reads environment variables from a file.
 *
 * @param string $file The file path to load environment variables from. Defaults to '.env'.
 * @return array A key-value array of environment variables.
 */
function loadEnv($filePath = '.env'): array
{
  if (!file_exists($filePath)) {
    return [];
  }

  $env = [];
  $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
      continue; // exclude comments
    }

    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    // if contains comma, convert to array and trim each element
    if (strpos($value, ',') !== false) {
      $value = array_map('trim', explode(',', $value));
    }

    $env[$key] = $value;
  }

  return $env;
}
