<?php

/**
 * Write log to file
 *
 * @param string $content
 * @param bool $overwrite
 * @param string $customOutput
 *
 * If custom output is provided, the file path will be set to the custom output.
 * If file doesn't end with .php, add it.
 * If overwrite is false and file exists, append content.
 */
function writeLogToFile($filePath, $content, $overwrite = false, $customOutput = null)
{
  // if custom output is provided
  if (isset($customOutput)) {
    $filePath = $customOutput;
    
  } else {
    // if file doesn't end with .php, add it
    if (!pathinfo($filePath, PATHINFO_EXTENSION)) {
      $filePath .= '.php';
    }

    // keep the same directory
    $resultFilePath = RESULT_LOCATION . dirname($filePath);

    if (!is_dir($resultFilePath)) {
      mkdir($resultFilePath, 0777, true);
    }

    // make file name based on file name
    $filePath = $resultFilePath . '/' . pathinfo($filePath, PATHINFO_FILENAME) . "." . EXTENSION_RESULT_FILE;
    echo $filePath . "\n";
  }

  // if overwrite is false and file exists, append content
  if (!$overwrite && file_exists($filePath)) {
    file_put_contents($filePath, $content, FILE_APPEND);
  } else {
    file_put_contents($filePath, $content);
  }
}
