# 📊 How to Implement Benchmark in PHP

This guide provides a step-by-step method to benchmark different algorithm implementations using PHP. The benchmarking tool will measure **execution time**, **memory usage**, and compare performance across multiple implementations.

---

## 🚀 Step 1: Define Your Functions

Create different versions of the function you want to benchmark. Below is an example with three variations of a function that sums an array.

```php
<?php

/*
* Calculate the sum of elements in the array.
*/
function sum(array $arr): int
{
  if (empty($arr)) {
    return 0;
  }

  $sum = 0;
  foreach ($arr as $value) {
    $sum += $value;
  }

  return $sum;
}

// Version 2
function sum2(array $arr): int
{
  $length = count($arr);
  if ($length === 0) {
    return 0;
  }

  $sum = 0;
  for ($i = 0; $i < $length; $i++) {
    $sum += $arr[$i];
  }

  return $sum;
}

// Version 3
function sum3(array $arr): int
{
  return array_sum($arr);
}
```

---

## 🏃‍♂️ Step 2: Run the Benchmark

Call the `runAndPrintBenchmark` function to test the implementations:

```php
// Define test data
$arr = [1, 2, 3, 4, 5];

// Run benchmark to test different functions
runAndPrintBenchmark("sum", "sum", [$arr]);
runAndPrintBenchmark("sum2", "sum2", [$arr]);
runAndPrintBenchmark("sum3", "sum3", [$arr]);

// Print summary
finalizeBenchmark();
```

---

## 📊 Example Output

### **🔹 Benchmark Results**

```
════════════════════════════════════════════════════════════════════════════════════════════════════
│ 📌 Function         │ sum                      │ sum2                     │ sum3                        
────────────────────────────────────────────────────────────────────────────────────────────────────
│ 🔹 Result           │ 15                       │ 15                       │ 15                          
│ ⏳ Execution Time   │ 0.000004s - 4.05µs       │ 0.000001s - 1.19µs       │ 0.000000s - 0ns              
│ 💾 Memory Used      │ 0                        │ 0                        │ 0                           
════════════════════════════════════════════════════════════════════════════════════════════════════
```

### **📜 Benchmark Summary**

✅ **Results Match**   : **Yes**  
⚡ **Fastest**         : **sum3** _(0.000000s - 0ns)_  
🐢 **Slowest**         : **sum** _(0.000004s - 4.05µs)_  
💾 **Memory Used**     : **Same** _(0 bytes)_  

---

## 🎯 Conclusion

- **Function `sum3` (using `array_sum`) is the fastest** in this case.
- **All implementations returned the same result**, proving correctness.
- **Memory usage remains constant across all implementations**.

You can now add your own algorithms and benchmark them to determine which implementation is the most efficient! 🚀

