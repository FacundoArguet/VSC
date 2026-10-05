-- Creación de la base de datos si no existe
CREATE DATABASE IF NOT EXISTS registration;

-- Selección de la base de datos para trabajar sobre ella
USE registration;

-- Creación de la tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    gmail VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

-- Migración compatible con MariaDB/XAMPP para instalaciones existentes.
SET @role_exists = (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'users' AND COLUMN_NAME = 'role'
);
SET @role_migration = IF(
    @role_exists = 0,
    'ALTER TABLE users ADD COLUMN role ENUM(''user'', ''admin'') NOT NULL DEFAULT ''user''',
    'SELECT 1'
);
PREPARE role_migration FROM @role_migration;
EXECUTE role_migration;
DEALLOCATE PREPARE role_migration;

-- Pedidos vinculados permanentemente a la cuenta que los creó.
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    category VARCHAR(30) NOT NULL,
    details VARCHAR(200) NOT NULL,
    status ENUM('Pendiente', 'En proceso', 'Completado', 'Cancelado') NOT NULL DEFAULT 'Pendiente',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_orders_user_created (user_id, created_at)
);
