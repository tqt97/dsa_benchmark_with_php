<?php

$folderPath = $argv[1] ?? RESULT_LOCATION;
$folderPath = rtrim($folderPath, '/');

if (!is_dir($folderPath)) {
  die("\n❌ ERROR: The path '{$folderPath}' is not a valid directory.\n\n");
}

// check permissions
if (!is_writable($folderPath)) {
  die("\n❌ ERROR: The folder '{$folderPath}' is not writable. Check permissions.\n\n");
}

// Confirm deletion
echo "\n⚠️  Are you sure you want to delete all files & subdirectories in '{$folderPath}'? (y/N): ";

// Read input from terminal, prioritize `readline()`, fallback to `fgets()`
$input = function_exists('readline') ? readline() : trim(fgets(STDIN));
if (strtolower($input) !== 'y') {
  echo "\n❌ Operation canceled.\n\n";
  exit;
}

// Delete contents
echo "\n🚀 Deleting all files & subdirectories in '{$folderPath}'...\n\n";
deleteContents($folderPath);
echo "\n✅ All files & subdirectories in '{$folderPath}' have been deleted successfully! 🎉\n\n";
