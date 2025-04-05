<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Test database connection
require_once 'config/database.php';

echo "<h1>PHP Test Page</h1>";
echo "<p>PHP is working!</p>";

// Test database connection
if($conn) {
    echo "<p>Database connection successful!</p>";
    
    // Test query
    $result = $conn->query("SELECT * FROM menu LIMIT 1");
    if($result) {
        echo "<p>Query successful!</p>";
        $row = $result->fetch_assoc();
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    } else {
        echo "<p>Query failed: " . $conn->error . "</p>";
    }
} else {
    echo "<p>Database connection failed: " . mysqli_connect_error() . "</p>";
}

// Test session
session_start();
echo "<p>Session ID: " . session_id() . "</p>";

// Test file paths
echo "<p>Current directory: " . __DIR__ . "</p>";
echo "<p>Document root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

// List files in current directory
echo "<h2>Files in current directory:</h2>";
echo "<ul>";
foreach(scandir(__DIR__) as $file) {
    if($file != "." && $file != "..") {
        echo "<li>$file</li>";
    }
}
echo "</ul>";

// Check if tables exist
$tables = ['users', 'menu', 'orders', 'order_items', 'messages'];
$missing_tables = [];

foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows == 0) {
        $missing_tables[] = $table;
    }
}

// Check menu table structure
$menu_columns = [];
$result = $conn->query("SHOW COLUMNS FROM menu");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $menu_columns[] = $row['Field'];
    }
}

// Check orders table structure
$orders_columns = [];
$result = $conn->query("SHOW COLUMNS FROM orders");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $orders_columns[] = $row['Field'];
    }
}

// Check order_items table structure
$order_items_columns = [];
$result = $conn->query("SHOW COLUMNS FROM order_items");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $order_items_columns[] = $row['Field'];
    }
}

// Output results
echo "<h1>Database Structure Test</h1>";

echo "<h2>Missing Tables:</h2>";
if (empty($missing_tables)) {
    echo "<p>All required tables exist.</p>";
} else {
    echo "<ul>";
    foreach ($missing_tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
}

echo "<h2>Menu Table Columns:</h2>";
echo "<ul>";
foreach ($menu_columns as $column) {
    echo "<li>$column</li>";
}
echo "</ul>";

echo "<h2>Orders Table Columns:</h2>";
echo "<ul>";
foreach ($orders_columns as $column) {
    echo "<li>$column</li>";
}
echo "</ul>";

echo "<h2>Order Items Table Columns:</h2>";
echo "<ul>";
foreach ($order_items_columns as $column) {
    echo "<li>$column</li>";
}
echo "</ul>";

// Check if menu items exist
$result = $conn->query("SELECT COUNT(*) as count FROM menu");
if ($result) {
    $row = $result->fetch_assoc();
    echo "<h2>Menu Items:</h2>";
    echo "<p>Total menu items: " . $row['count'] . "</p>";
}

// Check if the database.sql file has been executed
echo "<h2>Next Steps:</h2>";
if (!empty($missing_tables)) {
    echo "<p>Please run the database.sql file to create the missing tables:</p>";
    echo "<pre>mysql -u root -p patel_brothers < database.sql</pre>";
}
?> 