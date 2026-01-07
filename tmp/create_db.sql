CREATE DATABASE IF NOT EXISTS tendakian CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'db_user'@'127.0.0.1' IDENTIFIED BY 'db_pass';
CREATE USER IF NOT EXISTS 'db_user'@'localhost' IDENTIFIED BY 'db_pass';
GRANT ALL PRIVILEGES ON tendakian.* TO 'db_user'@'127.0.0.1';
GRANT ALL PRIVILEGES ON tendakian.* TO 'db_user'@'localhost';
FLUSH PRIVILEGES;
