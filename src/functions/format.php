<?php

/**
 * Print benchmark results in a formatted comparison table.
 *
 * @param array $benchmarks Associative array of function names and their benchmark results.
 */
function printBenchmarkTable($benchmarks)
{
  if (LOG_MODE === 'log') {
    printTerminalTable($benchmarks);
  } elseif (LOG_MODE === 'md') {
    printMarkdownTable($benchmarks);
  }
}

function printTerminalTable($benchmarks)
{
  $functions = array_keys($benchmarks);

  echo BOLD . "\n=== Results ===" . RESET . "\n\n";
  echo BOLD . str_repeat("═", 100) . "\n" . RESET;
  echo "│ 📌 Function         │ " . implode("          │ ", array_map(fn($f) => str_pad($f, 15), $functions)) . "             \n";
  echo str_repeat("─", 100) . "\n";

  // Result
  echo "│ 🔹 Result           │ " . implode("          │ ", array_map(fn($f) => str_pad(json_encode($benchmarks[$f]['result']), 15), $functions)) . "             \n";

  // Execution time
  echo "│ ⏳ Execution Time   │ " . implode("       │ ", array_map(fn($f) => str_pad(formatTime($benchmarks[$f]['time']), 15), $functions)) . "          \n";

  // Memory used
  echo "│ 💾 Memory Used      │ " . implode("          │ ", array_map(fn($f) => str_pad($benchmarks[$f]['memory'], 15), $functions)) . "             \n";

  echo BOLD . str_repeat("═", 100) . "\n" . RESET;
}

function printMarkdownTable($benchmarks)
{
  $functions = array_keys($benchmarks);


  echo "\n### 📊 Benchmark Results\n\n";
  echo "| Function | " . implode(" | ", $functions) . " |\n";
  echo "|----------|" . str_repeat("---------------|", count($functions)) . "\n";

  // Result
  echo "| **Result** | " . implode(" | ", array_map(fn($f) => json_encode($benchmarks[$f]['result']), $functions)) . " |\n";

  // Execution time
  echo "| **Execution Time** | " . implode(" | ", array_map(fn($f) => formatTime($benchmarks[$f]['time']), $functions)) . " |\n";

  // Memory used
  echo "| **Memory Used** | " . implode(" | ", array_map(fn($f) => $benchmarks[$f]['memory'] . " bytes", $functions)) . " |\n";
}

/**
 * Format time
 *
 * @param float $timeInSeconds
 * @return string
 */
function formatTime($seconds)
{
  $formattedTime = number_format($seconds, 6, '.', '') . "s"; // Format with 6 decimal places

  if ($seconds < 1e-6) {
    $converted = round($seconds * 1e9, 2) . "ns"; // Nanoseconds
  } elseif ($seconds < 1e-3) {
    $converted = round($seconds * 1e6, 2) . "µs"; // Microseconds
  } elseif ($seconds < 1) {
    $converted = round($seconds * 1e3, 2) . "ms"; // Milliseconds
  } else {
    $converted = round($seconds, 6) . "s"; // Seconds
  }

  return "{$formattedTime} - {$converted}";
}
