DROP DATABASE IF EXISTS intrabanking_database;
CREATE DATABASE intrabanking_database;
USE intrabanking_database;

DROP TABLE IF EXISTS user_table;
CREATE TABLE user_table(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(80) NOT NULL,
    user_email VARCHAR(100) NOT NULL UNIQUE,
    user_ddd CHAR(2) NOT NULL,
    user_number CHAR(9) NOT NULL,
    user_password VARCHAR(32) NOT NULL
);
