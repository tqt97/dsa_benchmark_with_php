<?php

/**
 * Benchmark a function call.
 *
 * @param callable $callback
 * @param array $args
 * @return array with keys "result", "time", and "memory"
 */
function benchmark($callback, $args = [])
{
  $startTime = microtime(true);
  $startMemory = memory_get_usage();

  $result = call_user_func_array($callback, $args);

  $endTime = microtime(true);
  $endMemory = memory_get_usage();

  return [
    'result' => $result,
    'time'   => $endTime - $startTime,
    'memory' => $endMemory - $startMemory
  ];
}

/**
 * Runs a benchmark file, captures the output, and saves it to a results file.
 *
 * @param string $filePath The path to the benchmark file.
 */
function runBenchmark($filePath, $outputFile = null)
{
  $benchmarkFile = getBenchmarkFilePath($filePath);

  echo "\n🚀 Running Benchmark for file: " . basename($benchmarkFile) . "\n\n";

  // Bắt đầu benchmark
  ob_start();
  include $benchmarkFile;
  $output = ob_get_clean();

  if ($outputFile) {
    writeLogToFile($benchmarkFile, $output, true, $outputFile);
    echo "\n✅ Benchmark completed! Results saved to '$outputFile'.'\n";
  } else {
    writeLogToFile($benchmarkFile, $output);
    echo "\n✅ Benchmark completed! Results saved to 'results/' directory.'\n";
    if (LOG_MODE === 'log') {
      echo $output;
    }
  }
}

/**
 * Summarize benchmark results.
 *
 * @param array $benchmarks Associative array with function names as keys and benchmark results as values.
 */
function summarizeBenchmarks($benchmarks)
{
  $functions = array_keys($benchmarks);
  $allSame = count(array_unique(array_column($benchmarks, 'result'))) === 1;

  // Sắp xếp để lấy fastest & slowest
  usort($functions, fn($a, $b) => $benchmarks[$a]['time'] <=> $benchmarks[$b]['time']);
  $fastestFunc = $functions[0];
  $slowestFunc = end($functions);

  // Lấy mức tiêu thụ bộ nhớ khác nhau
  $uniqueMemoryValues = array_unique(array_column($benchmarks, 'memory'));
  $memorySame = count($uniqueMemoryValues) === 1;

  if (LOG_MODE === 'log') {
    echo BOLD . "\n📊 === Benchmark Summary ===" . RESET . "\n\n";
    printf("✅ %-15s : %s\n", "Results Match", $allSame ? GREEN . "Yes" . RESET : RED . "No" . RESET);
    printf("⚡ %-15s : " . GREEN . "%-8s" . RESET . " (%s)\n", "Fastest", $fastestFunc, YELLOW . formatTime($benchmarks[$fastestFunc]['time']) . RESET);
    printf("🐢 %-15s : " . RED . "%-8s" . RESET . " (%s)\n", "Slowest", $slowestFunc, YELLOW . formatTime($benchmarks[$slowestFunc]['time']) . RESET);

    if ($memorySame) {
      printf("💾 %-15s : " . CYAN . "Same " . RESET . "    (%s bytes)\n", "Memory Used", GREEN . "{$uniqueMemoryValues[0]}" . RESET);
    } else {
      printf("💡 %-15s : " . GREEN . "%-8s" . RESET . " (%s bytes)\n", "Least Memory", $functions[0], GREEN . "{$benchmarks[$functions[0]]['memory']}" . RESET);
      printf("🔴 %-15s : " . RED . "%-8s" . RESET . " (%s bytes)\n", "Most Memory", $slowestFunc, GREEN . "{$benchmarks[$slowestFunc]['memory']}" . RESET);
    }
    echo BOLD . str_repeat("═", 60) . "\n" . RESET;
  } elseif (LOG_MODE === 'md') {
    echo "\n### 📊 Benchmark Summary\n\n";
    echo "| Metric | Value |\n";
    echo "|--------|-------|\n";
    echo "| ✅ **Results Match** | " . ($allSame ? "✔️ Yes" : "❌ No") . " |\n";
    echo "| ⚡ **Fastest** | `$fastestFunc` (" . formatTime($benchmarks[$fastestFunc]['time']) . ") |\n";
    echo "| 🐢 **Slowest** | `$slowestFunc` (" . formatTime($benchmarks[$slowestFunc]['time']) . ") |\n";

    if ($memorySame) {
      echo "| 💾 **Memory Used** | " . "{$uniqueMemoryValues[0]} bytes (same for all) |\n";
    } else {
      echo "| 💡 **Least Memory** | `$functions[0]` ({$benchmarks[$functions[0]]['memory']} bytes) |\n";
      echo "| 🔴 **Most Memory** | `$slowestFunc` ({$benchmarks[$slowestFunc]['memory']} bytes) |\n";
    }
  }
}

/**
 * Generate a list of benchmark files.
 *
 * This function generates a Markdown file `algorithms.md` containing a list of all
 * benchmark files in the `benchmarks/` folder.
 *
 * @return void
 */
function generateBenchmarkList()
{
  if (!is_dir(BENCHMARK_LOCATION)) {
    die("❌ ERROR: Benchmarks directory not found.\n");
  }

  $categories = array_filter(scandir(BENCHMARK_LOCATION), function ($folder) {
    // Filter out non-directory files
    return is_dir(BENCHMARK_LOCATION . "/$folder") && !in_array($folder, ['.', '..']);
  });

  $totalCategories = count($categories);
  $processedCategories = 0;

  // echo "🚀 **Starting to generate benchmark list...**\n\n";

  $markdownContent = "# 🚀 Benchmark Algorithms List\n\n";
  $markdownContent .= "> 📌 **List of algorithms in `benchmarks/` folder**\n\n";
  $markdownContent .= "---\n\n";

  foreach ($categories as $category) {
    $categoryPath = BENCHMARK_LOCATION . "/$category";
    $files = array_values(array_filter(scandir($categoryPath), function ($file) {
      // Filter out hidden files, `.gitignore`, and `README.md`
      return !in_array($file, ['.', '..', '.gitignore', 'README.md']);
    }));

    // if (empty($files)) continue;

    // Sort files by name
    natcasesort($files);

    $markdownContent .= "## 📂 **" . ucfirst($category) . " Algorithms**\n\n";
    $fileCount = count($files);
    $processedFiles = 0;
    $pluralFile = $fileCount > 1 ? "files" : "file";
    echo "\n🎯 Algorithms: $category - $fileCount $pluralFile \n";

    foreach ($files as $file) {
      $filePath = "benchmarks/$category/$file";
      $fileName = pathinfo($file, PATHINFO_FILENAME);
      $markdownContent .= "🔹 [`$fileName`]($filePath)\n";

      $processedFiles++;
      // showProgressGenerateList("🔄 Total file $fileCount", $processedFiles, $fileCount);
    }

    $processedCategories++; // ✅
    echo "\n"; // ✅ 
    showProgressGenerateList("📜 Overall Progress", $processedCategories, $totalCategories);
    echo "\n";
  }

  file_put_contents(ALGORITHMS_LIST_FILE, $markdownContent);

  echo "\n✅ File algorithms.md has been generated! 🎉\n";

  $filePath = realpath(ALGORITHMS_LIST_FILE);
  echo "\n📂 You can open it using:\n";
  echo "➜  Run: `open $filePath`\n";
  echo "➜  Or manually open it in Finder.\n";
}

/**
 * Displays a progress bar for generating the benchmark list.
 */
function showProgressGenerateList($message, $current, $total)
{
  $percentage = round(($current / $total) * 100);
  $progressBar = str_repeat("█", round($percentage / 5)) . str_repeat("-", 20 - round($percentage / 5));
  echo "\r$message: [$progressBar] $percentage% ($current/$total)";
  flush();
  usleep(50000);
}

// array of benchmark results
$benchmarkResults = [];

/**
 * Run benchmark for a single algorithm and save the results in a global array.
 *
 * @param string   $algorithmName name of the algorithm 
 * @param callable $algorithm     function to benchmark
 * @param array    $params        parameters to pass to the algorithm
 */
function runAndPrintBenchmark(string $algorithmName, callable $algorithm, array $params)
{
  global $benchmarkResults;

  $benchmarkResults[$algorithmName] = benchmark($algorithm, $params);
}

/**
 * Finalize the benchmark and print the results.
 */
function finalizeBenchmark()
{
  global $benchmarkResults;

  // check if benchmark results are not empty
  if (!empty($benchmarkResults)) {
    printBenchmarkTable($benchmarkResults);
    summarizeBenchmarks($benchmarkResults);
  }
}
