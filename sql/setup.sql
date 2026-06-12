CREATE DATABASE IF NOT EXISTS unit_test_db;
USE unit_test_db;

CREATE TABLE IF NOT EXISTS tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    method_name VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS test_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    test_id INT NOT NULL,
    status ENUM('passed', 'failed') NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (test_id) REFERENCES tests(id) ON DELETE CASCADE
);

-- Seed data
INSERT INTO tests (name, method_name, description) VALUES 
('Test Addition', 'add', 'Checks if 2+2=4'),
('Test Subtraction', 'subtract', 'Checks if 5-3=2'),
('Test Division by Zero', 'divideByZero', 'Checks if division by zero is handled'),
('Test String Match', 'checkString', 'Checks if string matches');
