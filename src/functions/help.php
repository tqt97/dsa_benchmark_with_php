<?php

function showHelp()
{
  echo "\033[1;34m📖 Usage:\033[0m\n";
  echo "  php index.php \033[1;32m<command>\033[0m [args]\n\n";
  echo "\033[1;33mAvailable commands:\033[0m\n";
  echo "  \033[1;32mbenchmark <file>\033[0m   Run a benchmark script.\n";
  echo "  \033[1;32mlist\033[0m               Generate algorithms list.\n";
  echo "  \033[1;32mclean\033[0m              Clean up result directories.\n";
  echo "  \033[1;32mhelp\033[0m               Show this help message.\n";
  exit(0);
}
