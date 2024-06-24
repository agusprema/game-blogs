<?php
require_once "vendor/autoload.php";
require_once realpath(__DIR__ . '/../core/helpers/config.php');

function createDB()
{
    $host = config('database.hostname');
    $username = config('database.username');
    $password = config('database.password');
    $port = config('database.port');
    $db = config('database.database');

    $conn = mysqli_connect($host, $username, $password);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully" . PHP_EOL;
    } else {
        echo "Error creating database: " . mysqli_error($conn) . PHP_EOL;
    }

    mysqli_close($conn);
}

function dbCOn()
{
    $conn = new Core\DB\Connect();
    $db = $conn->toDB();
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $db;
}

function createUsers($db)
{
    mysqli_query($db, "DROP TABLE IF EXISTS `users`;");
    $sql = <<<SQL
    CREATE TABLE `users` (
        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
        `role` ENUM('user', 'admin') NOT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    SQL;

    if (mysqli_query($db, $sql)) {
        echo "Table users created successfully" . PHP_EOL;
    } else {
        echo "Error creating table users: " . mysqli_error($db) . PHP_EOL;
    }
}

function createPosts($db)
{
    mysqli_query($db, "DROP TABLE IF EXISTS `posts`;");
    $sql = <<<SQL
    CREATE TABLE `posts` (
        `post_id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `user_id` BIGINT unsigned NOT NULL,
        `title` VARCHAR(75) NOT NULL,
        `slug` VARCHAR(100) NOT NULL,
        `summary` MEDIUMTEXT NULL,
        `thumbnail` VARCHAR(255) NOT NULL,
        `content` LONGTEXT NULL DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`post_id`),
        CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    SQL;

    if (mysqli_query($db, $sql)) {
        echo "Table posts created successfully" . PHP_EOL;
    } else {
        echo "Error creating table posts: " . mysqli_error($db) . PHP_EOL;
    }
}

function createCategory($db)
{
    mysqli_query($db, "DROP TABLE IF EXISTS `categorys`;");
    $sql = <<<SQL
    CREATE TABLE `categorys` (
        `category_id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(75) NOT NULL,
        `slug` VARCHAR(100) NOT NULL,
        `content` TEXT NULL DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`category_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    SQL;

    if (mysqli_query($db, $sql)) {
        echo "Table category created successfully" . PHP_EOL;
    } else {
        echo "Error creating table category: " . mysqli_error($db) . PHP_EOL;
    }
}

function createTag($db)
{
    mysqli_query($db, "DROP TABLE IF EXISTS `tags`;");
    $sql = <<<SQL
    CREATE TABLE `tags` (
        `tag_id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(75) NOT NULL,
        `slug` VARCHAR(100) NOT NULL,
        `content` TEXT NULL DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`tag_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    SQL;

    if (mysqli_query($db, $sql)) {
        echo "Table tags created successfully" . PHP_EOL;
    } else {
        echo "Error creating table tags: " . mysqli_error($db) . PHP_EOL;
    }
}

function createPostCategory($db)
{
    mysqli_query($db, "DROP TABLE IF EXISTS `post_categorys`;");
    $sql = <<<SQL
    CREATE TABLE `post_categorys` (
        `post_id` bigint unsigned NOT NULL,
        `category_id` bigint unsigned NOT NULL,
        PRIMARY KEY (`post_id`, `category_id`),
        CONSTRAINT `fk_pc_post` FOREIGN KEY (`post_id`) REFERENCES `posts`(`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `fk_pc_category` FOREIGN KEY (`category_id`) REFERENCES `categorys`(`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    SQL;

    if (mysqli_query($db, $sql)) {
        echo "Table post_categorys created successfully" . PHP_EOL;
    } else {
        echo "Error creating table post_categorys: " . mysqli_error($db) . PHP_EOL;
    }
}

function createPostTag($db)
{
    mysqli_query($db, "DROP TABLE IF EXISTS `post_tags`;");
    $sql = <<<SQL
    CREATE TABLE `post_tags` (
        `post_id` bigint unsigned NOT NULL,
        `tag_id` bigint unsigned NOT NULL,
        PRIMARY KEY (`post_id`, `tag_id`),
        CONSTRAINT `fk_pt_post` FOREIGN KEY (`post_id`) REFERENCES `posts`(`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `fk_pt_tag` FOREIGN KEY (`tag_id`) REFERENCES `tags`(`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    SQL;

    if (mysqli_query($db, $sql)) {
        echo "Table post_tags created successfully" . PHP_EOL;
    } else {
        echo "Error creating table post_tags: " . mysqli_error($db) . PHP_EOL;
    }
}


createDB();
$db = dbCOn();
createUsers($db);
createPosts($db);
createCategory($db);
createPostCategory($db);
createTag($db);
createPostTag($db);