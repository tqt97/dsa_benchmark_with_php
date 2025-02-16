<?php

try {
  // Check if benchmark file path is provided
  if ($argc < 2) {
    throw new InvalidArgumentException("❌ ERROR: Missing benchmark file path.\n");
  }

  $benchmarkFile = $argv[1] ?? null;
  // Check if benchmark file exists
  if (!file_exists(getBenchmarkFilePath($benchmarkFile))) {
    throw new RuntimeException("❌ ERROR: Benchmark file '{$benchmarkFile}' not found.\n");
  }

  $outputFile = null;

  // loop through arguments to find --output
  foreach ($argv as $arg) {
    if (str_starts_with($arg, '--output=')) {
      $outputFile = substr($arg, 9); // get the value after --output=
    }
  }

  // run benchmark
  runBenchmark($benchmarkFile, $outputFile);
} catch (InvalidArgumentException $e) {
  fwrite(STDERR, $e->getMessage());
  exit(1);
} catch (RuntimeException $e) {
  fwrite(STDERR, $e->getMessage());
  exit(1);
} catch (Throwable $e) {
  fwrite(STDERR, "\n🚨 ERROR:: " . $e->getMessage() . "\n");
  exit(1);
}
