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

DROP TABLE IF EXISTS finance_table;
CREATE TABLE finance_table (
  finance_id INT PRIMARY KEY AUTO_INCREMENT,
  finance_name VARCHAR(100) NOT NULL,
  finance_description VARCHAR(250),
  finance_price DECIMAL(19,4) NOT NULL,
  finance_date DATE NOT NULL,
  finance_recipient VARCHAR(100),
  fk_user INT NOT NULL,
  FOREIGN KEY (fk_user) REFERENCES user_table(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);
