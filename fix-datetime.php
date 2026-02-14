<?php
/**
 * Database DateTime Fix Script
 * This script fixes invalid datetime values in the database
 */

require_once 'includes/config.php';

echo "<h2>Database DateTime Fix Script</h2>\n";

try {
    // List of tables and their datetime columns to check
    $tables_to_check = [
        'basic_details' => ['birth_date', 'created_at', 'updated_at'],
        'contacts' => ['created_at', 'updated_at'],
        'education' => ['start_date', 'end_date', 'created_at', 'updated_at'],
        'experience' => ['start_date', 'end_date', 'created_at', 'updated_at'],
        'projects' => ['start_date', 'end_date', 'created_at', 'updated_at'],
        'certifications' => ['created_at', 'updated_at'],
        'others' => ['created_at', 'updated_at']
    ];

    foreach ($tables_to_check as $table => $columns) {
        echo "<h3>Checking table: $table</h3>\n";
        
        // Check if table exists
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() == 0) {
            echo "<p>Table $table does not exist. Skipping...</p>\n";
            continue;
        }
        
        // Get table structure
        $stmt = $pdo->query("DESCRIBE $table");
        $existing_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($columns as $column) {
            if (!in_array($column, $existing_columns)) {
                echo "<p>Column $column does not exist in $table. Skipping...</p>\n";
                continue;
            }
            
            echo "<p>Checking column: $column</p>\n";
            
            // Find invalid datetime values
            $stmt = $pdo->prepare("SELECT id, $column FROM $table WHERE $column IS NOT NULL AND $column != '' AND $column NOT REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}( [0-9]{2}:[0-9]{2}:[0-9]{2})?$'");
            $stmt->execute();
            $invalid_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($invalid_rows) > 0) {
                echo "<p style='color: red;'>Found " . count($invalid_rows) . " invalid datetime values in $table.$column:</p>\n";
                
                foreach ($invalid_rows as $row) {
                    echo "<p>ID: {$row['id']}, Invalid value: '{$row[$column]}'</p>\n";
                    
                    // Fix the invalid value by setting it to NULL
                    $update_stmt = $pdo->prepare("UPDATE $table SET $column = NULL WHERE id = ?");
                    $update_stmt->execute([$row['id']]);
                    echo "<p style='color: green;'>Fixed: Set to NULL</p>\n";
                }
            } else {
                echo "<p style='color: green;'>No invalid datetime values found in $table.$column</p>\n";
            }
        }
    }
    
    echo "<h3 style='color: green;'>Database datetime fix completed successfully!</h3>\n";
    
} catch (Exception $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>\n";
}

echo "<p><a href='admin.php'>Go back to Admin Panel</a></p>\n";
echo "<p><a href='index.php'>Go to Portfolio</a></p>\n";
?>
