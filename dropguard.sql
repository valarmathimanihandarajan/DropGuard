CREATE DATABASE dropguard;

USE dropguard;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('user','admin') DEFAULT 'user'
);

CREATE TABLE incidents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  place VARCHAR(100),
  date DATE,
  time TIME,
  category VARCHAR(50),
  severity INT,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE experiences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  message TEXT,
  submitted_on DATETIME DEFAULT CURRENT_TIMESTAMP,
  approved TINYINT(1) DEFAULT 0
);

CREATE TABLE quiz_scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  score INT,
  date_taken DATE
);
