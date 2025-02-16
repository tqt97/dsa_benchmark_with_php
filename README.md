# 📚 Lean Data Structure Algorithms using PHP

----

## 🚀 Overview
This project is designed to **learn and benchmark algorithms using PHP**. It focuses on fundamental **data structures, algorithms, and complexity analysis**. The benchmarking system allows performance comparisons of different implementations.

## 🔨 Project Status
🚧 This project is currently under development. Features and benchmarks may change as improvements are made. Contributions and feedback are welcome!

## 👨‍💻 Author
[![GitHub](https://img.shields.io/badge/GitHub-TQT97-blue?logo=github&style=for-the-badge)](https://github.com/tqt97)

📧 Contact: quoctuanit2018@gmail.com

## 🛠 Features
- ✅ **Benchmarking Engine**: Compare multiple algorithm implementations.
- 📊 **Execution Time Analysis**: Evaluate the efficiency of each function.
- 💾 **Memory Usage Tracking**: Identify the most optimized approach.
- 🎨 **Formatted Output**: Clean and structured result presentation.
- 🔬 **Unit Testing**: Ensure the accuracy of benchmark results.

## 📜 List of Algorithms
> 📌 Click the link below to view all implemented algorithms:

[📖 **View All Algorithms**](algorithms.md) *(updating...)*

### 🔢 Categories:
| Algorithm Type  | Examples |
|----------------|----------|
| 🏁 **Sorting** | Bubble Sort, Quick Sort, Merge Sort |
| 🔍 **Searching** | Linear Search, Binary Search |
| 🔗 **Graph Algorithms** | BFS, DFS, Dijkstra’s Algorithm |
| 🧠 **Dynamic Programming** | Fibonacci, Knapsack Problem |
| 💡 **Greedy Algorithms** | Huffman Coding, Kruskal’s Algorithm |

📂 **Full List:** See [`algorithms.md`](algorithms.md)*(updating...)*

---

## 📖 What are Data Structure and Algorithms?

### **Data Structure**
A **Data Structure (DS)** is a way of organizing and storing data efficiently to perform operations like searching, sorting, and modifying data effectively. Common types of data structures include:

- **Arrays** 📊 – Fixed-size lists of elements stored in contiguous memory.
- **Linked Lists** 🔗 – Dynamic lists where elements (nodes) are linked together.
- **Stacks & Queues** 📥📤 – LIFO (Last In, First Out) and FIFO (First In, First Out) structures.
- **Trees** 🌳 – Hierarchical structures used in databases, search operations (e.g., Binary Search Trees).
- **Graphs** 🕸 – A set of nodes connected by edges, useful for networking and social connections.
- **Hash Tables** 🔑 – Key-value storage used for quick lookups (e.g., associative arrays, maps).

### **Algorithms**
An **Algorithm** is a step-by-step procedure to solve a problem efficiently. Algorithms work alongside data structures to process data effectively. Some common algorithms include:

- **Sorting Algorithms** 📌 (Bubble Sort, Quick Sort, Merge Sort)
- **Searching Algorithms** 🔍 (Binary Search, Linear Search)
- **Graph Algorithms** 🔗 (Dijkstra's Algorithm, BFS, DFS)
- **Divide and Conquer** 🪓 (Merge Sort, Quick Sort)
- **Dynamic Programming** 🎭 (Fibonacci, Knapsack Problem)
- **Greedy Algorithms** 💰 (Huffman Coding, Prim’s Algorithm)

---

## 🛠 **Time Complexity & Space Complexity**
### **Time Complexity** ⏳
Time complexity measures how the runtime of an algorithm grows as the input size increases. It is represented using **Big-O Notation**:

| Complexity  | Notation  | Example Algorithms |
|-------------|----------|--------------------|
| Constant    | O(1)     | Hash Table Lookup  |
| Logarithmic | O(log n) | Binary Search      |
| Linear      | O(n)     | Linear Search      |
| Quadratic   | O(n²)    | Bubble Sort        |
| Exponential | O(2ⁿ)    | Recursive Fibonacci|

### **Space Complexity** 💾
Space complexity measures the amount of memory required by an algorithm as the input size grows. It includes:

1. **Auxiliary Space** – Extra space required beyond input data.
2. **Input Space** – Memory occupied by input data.

| Complexity  | Notation  | Example |
|-------------|----------|---------|
| O(1)        | Constant | Swapping two variables |
| O(n)        | Linear   | Storing results in an array |
| O(n²)       | Quadratic | Creating an adjacency matrix for graphs |

💡 **Example: Space Complexity in Recursion**
```php
function factorial($n) {
    if ($n == 0) return 1;
    return $n * factorial($n - 1);
}
```
- This function has **O(n) space complexity** due to recursive stack calls.

---

## 📂 Project Structure
```
📦 project/                   
│── 📂 benchmarks/                     # 💨 Algorithm benchmarks
│   ├── 📂 array/                      # 🔢 Contains array algorithms
│   ├── 📂 graph/                      # 🕸 Contains graph algorithms
│   ├── 📂 linked_list/                # 🔗 Contains linked list algorithms
│   ├── 📂 queue/                      # 📤 Contains queue algorithms
│   ├── 📂 string/                     # 🔡 Contains string algorithms
│   ├── 📂 stack/                      # 📥 Contains stack algorithms
│   ├── 📂 tree/                       # 🌳 Contains tree algorithms
│
│── 📂 results/                        # 📊 Benchmark logs (auto-generated)
│   ├── 📂 array/                      # 📝 Results of array benchmarks
│   ├── 📂 string/                     # 📝 Results of string benchmarks
│
│── 📂 logs/                           # 📁 Store runtime logs
│
│── 📂 src/                            # 🔧 Core logic (business logic)
│   ├── 📂 bootstrap/                  # 🚀 Bootstrap & initialization
│   │   ├── 📄 autoload.php            # 🔄 Load all functions and config
│   │── 📂 commands/                   # 🖥️ CLI command handlers
│   │   ├── 📄 benchmark.php           # ⚡ Handle benchmarking
│   │   ├── 📄 clean.php               # 🧹 Handle cleaning results
│   │   ├── 📄 list.php                # 📜 Generate list of algorithms
│   ├── 📂 functions/                  # 🏗️ Core utility functions
│   │   ├── 📄 benchmark.php           # ⏳ Benchmarking logic
│   │   ├── 📄 deleteFile.php          # 🗑️ File deletion utilities
│   │   ├── 📄 env.php                 # 🌎 Load environment variables
│   │   ├── 📄 format.php              # 🎨 Format output, print, and timing
│   │   ├── 📄 help.php                # ℹ️ Show CLI help text
│   │   ├── 📄 logger.php              # 📝 Write output to file
│   │   ├── 📄 utils.php               # 🛠️ General helper functions
│
│── 📂 tests/                          # ✅ Unit tests
│
│── 📄 .env.example                    # 🔧 Example env file
│── 📄 .gitignore                      # 🚫 Ignore unnecessary files
│── 📄 config.php                      # ⚙️ Configuration settings
│── 📄 index.php                       # 🚀 Main entry point
│── 📖 README.md                       # 📚 Documentation
```

### 📌 Key Files & Directories
- [**benchmarks/**](./benchmarks) - Contains different algorithm benchmarks.
- [**src/**](./src) - Core logic including benchmark execution and formatting.
- [**results/**](./results) - Stores benchmarking logs.
- [**tests/**](./tests) - Unit tests to validate accuracy.
- [**index.php**](./index.php) - Main script to execute benchmarks.

## 🚀 Getting Started

#### 1️⃣ Clone the Repository
```bash
git clone https://github.com/tqt97/benchmark-project.git
cd benchmark-project
```

#### 2️⃣ 🚀 Usage

>📢 **Guide:** How to implement benchmark. [how_to_implement_benchmark.md](./how_to_implement_benchmark.md)

##### **Run a benchmark**
```sh
php index.php benchmark benchmarks/array/1_sum.php
```
- 🏁 This will execute the benchmark script `benchmarks/array/1_sum.php`.
- If no action (`benchmark`, `list`, `clean`) is specified, it defaults to **benchmark**.

##### **Generate algorithm list**
```sh
php index.php list
```
- 📜 This will create a **`algorithms.md`** file listing all available benchmark scripts with clickable links.

##### **Clean the results directory**
```sh
php index.php clean
```
- 🧹 This will delete all files inside the **results** directory after confirmation.

##### **Auto-detect benchmark mode**
```sh
php index.php benchmarks/array/1_sum.php
```
- 🤖 Since no action (`benchmark`, `list`, `clean`) is provided, the system assumes **benchmark mode** automatically.

---

## 🤝 Contributing

We appreciate contributions to improve this project! If you’d like to contribute, follow these steps:

### 1️⃣ Fork the repository
Click the **Fork** button on GitHub to create your own copy of the project.

### 2️⃣ Clone the project
```sh
git clone https://github.com/your-username/benchmark-project.git
cd benchmark-project
```

### 3️⃣ Create a new branch
```sh
git checkout -b feature/new-feature
```

### 4️⃣ Make changes and commit
- Improve benchmarks, optimize algorithms, or add new features.
- Follow the existing code structure for consistency.
- **Add a new algorithm** inside the `benchmarks/` directory under the appropriate data structure folder.
   ```
   benchmarks/
   ├── array/
   │   ├── 1.sum.php  # Example of array algorithm
   ├── stack/
   │   ├── stack_push.php  # Example of stack algorithm
   ```
```sh
git commit -m "✨ Added new sorting algorithm"
```

### 5️⃣ Push and create a Pull Request
```sh
git push origin feature/new-feature
```
- Open a **Pull Request (PR)** from your fork to the main repository.
- Add a description of your changes.

📢 **Note:** All new algorithms must be added inside the `benchmarks/` directory!

---

## 📜 Contribution Guidelines
✔ Keep code **clean** and **well-documented**.  
✔ Follow **PSR-12** PHP coding standards.  
✔ Run tests before submitting PRs.  

> 💡 **Have a suggestion or found a bug?** Open an **Issue** on GitHub! 🚀

Enjoy coding! 🚀
