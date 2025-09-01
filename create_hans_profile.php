<?php

// Simple script to create JobSeeker profile for hans
echo "Creating JobSeeker profile for hans...\n";

// Database connection
$host = 'localhost';
$dbname = 'glints';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Find user hans
    $stmt = $pdo->prepare("SELECT id, email, name FROM users WHERE email = ?");
    $stmt->execute(['hans@gmail.com']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo "User hans@gmail.com not found!\n";
        exit(1);
    }
    
    echo "User found: {$user['email']} (ID: {$user['id']})\n";
    
    // Check if JobSeeker profile exists
    $stmt = $pdo->prepare("SELECT id FROM job_seekers WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $jobSeeker = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($jobSeeker) {
        echo "JobSeeker profile already exists (ID: {$jobSeeker['id']})\n";
    } else {
        // Create JobSeeker profile
        $stmt = $pdo->prepare("
            INSERT INTO job_seekers (user_id, first_name, last_name, birth_date, phone, address, city, province, summary, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");
        
        $stmt->execute([
            $user['id'],
            'Hans',
            'Doe',
            '1990-01-01',
            '081234567890',
            'Jl. Sudirman No. 123',
            'Jakarta',
            'DKI Jakarta',
            'Experienced professional looking for new opportunities.'
        ]);
        
        $jobSeekerId = $pdo->lastInsertId();
        echo "JobSeeker profile created successfully (ID: $jobSeekerId)\n";
    }
    
    echo "\nNow hans should be able to access dashboard directly!\n";
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
    exit(1);
}