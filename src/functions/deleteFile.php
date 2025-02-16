<?php

/**
 * Delete all files and subdirectories in a given folder.
 *
 * @param string $path The path to the folder containing files and folders to be deleted.
 * @return void
 */
function deleteContents($path)
{
  if (!is_dir($path)) {
    die("\n❌ ERROR: '{$path}' is not a valid directory.\n\n");
  }

  if (!is_writable($path)) {
    die("\n❌ ERROR: Cannot delete files in '{$path}'. Check folder permissions.\n\n");
  }

  $items = array_diff(scandir($path), ['.', '..']);
  $totalItems = count($items);
  $deletedCount = 0;

  if ($totalItems === 0) {
    echo "\n📂 The folder '{$path}' is already empty.\n\n";
    exit;
  }

  // delete files and subdirectories
  foreach ($items as $item) {
    $fullPath = $path . DIRECTORY_SEPARATOR . $item;

    // delete subdirectory
    if (is_dir($fullPath)) {
      deleteDirectory($fullPath);
    }
    // delete file
    else {
      unlink($fullPath);
    }

    $deletedCount++;
    showProgress($deletedCount, $totalItems, $item);
  }
}

/**
 * Delete a directory and its contents recursively.
 *
 * @param string $dir The path to the directory to be deleted.
 * @return void
 */
function deleteDirectory($dir)
{
  // Retrieve all files and folders, excluding '.' and '..'
  $files = array_diff(scandir($dir), ['.', '..']);

  // Iterate through each file/folder in the directory
  foreach ($files as $file) {
    $filePath = $dir . DIRECTORY_SEPARATOR . $file;

    // Recursively delete subdirectory
    if (is_dir($filePath)) {
      deleteDirectory($filePath);
    } 
    // Delete file
    else {
      unlink($filePath);
    }
  }

  // Remove the directory itself
  rmdir($dir);
}

/**
 * Displays the progress of file deletion process.
 *
 * @param int $deleted The number of items deleted so far.
 * @param int $total The total number of items to be deleted.
 * @param string $currentItem The name of the current item being deleted.
 *
 * Outputs a progress bar indicating the percentage of completion, along with
 * the name of the current item, and the count of deleted and total items.
 */

function showProgress($deleted, $total, $currentItem)
{
  if ($total === 0) {
    echo "\n📂 No files to delete.\n";
    return;
  }

  $percentage = round(($deleted / $total) * 100);
  $progressBar = str_repeat("█", round($percentage / 5)) . str_repeat("-", 20 - round($percentage / 5));

  // Format the output
  $formattedItem = str_pad($currentItem, 12, " ", STR_PAD_RIGHT);
  $formattedDeleted = str_pad($deleted, 2, " ", STR_PAD_LEFT);
  $formattedTotal = str_pad($total, 2, " ", STR_PAD_LEFT);
  $formattedPercentage = str_pad($percentage, 3, " ", STR_PAD_LEFT);

  printf("⏳ Deleting %s: [%s] %s%% (%s/%s)\n", $formattedItem, $progressBar, $formattedPercentage, $formattedDeleted, $formattedTotal);
  flush();
}
