<?php

/**
 * Constructs the full path to a benchmark file and verifies its existence.
 *
 * @param string $filePath The relative path to the benchmark file.
 * @return string The full path to the benchmark file in the benchmarks directory.
 * @throws void If the file does not exist, the script terminates with an error message.
 */

function getBenchmarkFilePath($filePath)
{
  // if file doesn't end with .php, add it
  if (!str_ends_with($filePath, '.php')) {
    $filePath .= '.php';
  }

  if (file_exists($filePath)) {
    $fullPath = realpath($filePath);
  } else {
    $fullPath = BENCHMARK_LOCATION . ltrim($filePath, '/');
  }

  if (!file_exists($fullPath)) {
    die("\n❌ ERROR: File '{$filePath}' not found in 'benchmarks/' directory.\n");
  }

  return $fullPath;
}

/**
 * Displays an error message indicating a missing argument and shows the correct usage format.
 * Exits the script after displaying the message.
 */
function showUsageAndExit()
{
  $red = "\033[1;31m";   // red
  $green = "\033[1;32m"; // green
  $yellow = "\033[1;33m"; // yellow
  $blue = "\033[1;34m";   // blue
  $reset = "\033[0m";    // Reset

  echo "\n{$red}❌ ERROR: Missing argument!{$reset}\n\n";
  echo "{$yellow}📌 Usage:{$reset} php index.php {$green}<benchmark_file_path>{$reset}\n";
  echo "{$blue}💡 Example:{$reset}: php index.php {$green}benchmarks/array/array_sort.php{$reset}\n\n";
  exit(1);
}
