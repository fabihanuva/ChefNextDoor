-- ============================================
-- ChefNextDoor Database Schema
-- ============================================

CREATE DATABASE IF NOT EXISTS chefnextdoor;
USE chefnextdoor;

-- 1. Users (authentication + roles)
CREATE TABLE IF NOT EXISTS `users` (
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `name`          VARCHAR(100) NOT NULL,
    `email`         VARCHAR(120) UNIQUE NOT NULL,
    `password`      VARCHAR(255) NOT NULL,
    `role`          ENUM('customer', 'chef', 'admin') NOT NULL DEFAULT 'customer',
    `phone`         VARCHAR(20),
    `profile_image` VARCHAR(255) DEFAULT NULL,
    `created_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Chef Profiles (extra chef info)
CREATE TABLE IF NOT EXISTS `chef_profiles` (
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`     INT NOT NULL,
    `bio`         TEXT,
    `specialty`   VARCHAR(100),
    `location`    VARCHAR(150),
    `rating`      DECIMAL(2,1) DEFAULT 0,
    `is_approved` TINYINT(1) DEFAULT 1,
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Dishes (chef menu items)
CREATE TABLE IF NOT EXISTS `dishes` (
    `id`           INT AUTO_INCREMENT PRIMARY KEY,
    `chef_id`      INT NOT NULL,
    `title`        VARCHAR(150) NOT NULL,
    `description`  TEXT,
    `price`        DECIMAL(10,2) NOT NULL,
    `image`        VARCHAR(255),
    `category`     VARCHAR(100),
    `availability` TINYINT(1) DEFAULT 1,
    `stock`        INT DEFAULT 0,
    `created_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`chef_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Orders (main order table)
CREATE TABLE IF NOT EXISTS `orders` (
    `id`               INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id`      INT NOT NULL,
    `chef_id`          INT NOT NULL,
    `total_price`      DECIMAL(10,2),
    `delivery_address` TEXT,
    `status`           ENUM('pending','accepted','preparing','out_for_delivery','delivered','cancelled') DEFAULT 'pending',
    `payment_status`   ENUM('unpaid','paid') DEFAULT 'unpaid',
    `created_at`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`customer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`chef_id`)     REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Order Items (dishes inside each order)
CREATE TABLE IF NOT EXISTS `order_items` (
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `order_id`  INT NOT NULL,
    `dish_id`   INT NOT NULL,
    `quantity`  INT DEFAULT 1,
    `price`     DECIMAL(10,2),
    `subtotal`  DECIMAL(10,2),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`dish_id`)  REFERENCES `dishes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Reviews (customer reviews for chefs)
CREATE TABLE IF NOT EXISTS `reviews` (
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `chef_id`     INT NOT NULL,
    `order_id`    INT NOT NULL,
    `rating`      INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    `comment`     TEXT,
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`customer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`chef_id`)     REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`order_id`)    REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Favorites (customer saved dishes)
CREATE TABLE IF NOT EXISTS `favorites` (
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `dish_id`     INT NOT NULL,
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`customer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`dish_id`)     REFERENCES `dishes`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_favorite` (`customer_id`, `dish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
