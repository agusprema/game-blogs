<?php
require_once "vendor/autoload.php";
require_once realpath(__DIR__ . '/../core/helpers/config.php');

function seedUsers()
{
    //$2y$10$/sJmksqDk4dBYGO2Ka4UXu4xoBnwTQdeCfTXhLFQQup./7rK5hPhy // agus

    $queryBuilder = new Core\Query\QueryBuilder();
    $query = $queryBuilder->table('users')
                            ->create([
                                'email'    => 'agus@gmail.com',
                                'name'     => 'agus',
                                'password' => '$2y$10$/sJmksqDk4dBYGO2Ka4UXu4xoBnwTQdeCfTXhLFQQup./7rK5hPhy',
                                'profile'  => 'profile/avatar.png',
                                'role'     => 'admin'
                            ])
                            ->build();
            $queryBuilder->table('users')
                            ->create([
                                'email'    => 'sung@gmail.com', 
                                'name'     => 'agus 2',
                                'password' => '$2y$10$/sJmksqDk4dBYGO2Ka4UXu4xoBnwTQdeCfTXhLFQQup./7rK5hPhy',
                                'profile'  => 'profile/avatar.png',
                                'role'     => 'user'
                            ])
                            ->build();

    if ($query) {
        echo "Seeding users success" . PHP_EOL;
    } else {
        echo "Error seeding users : " . PHP_EOL;
    }
}

function seedCategory(){
    $db = (new \Core\DB\Connect())->toDB();

    $query = $db->query("INSERT INTO `categorys` (`category_id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
	(3, 'Berita Game', 'berita-game', '', '2024-06-15 02:00:53', '2024-06-15 02:00:53'),
	(4, 'Ulasan Game', 'ulasan-game', '', '2024-06-15 02:01:01', '2024-06-15 02:01:01'),
	(5, 'Panduan dan Tips', 'panduan-dan-tips', '', '2024-06-15 02:01:08', '2024-06-15 02:01:08'),
	(6, 'Esports', 'esports', '', '2024-06-15 02:01:17', '2024-06-15 02:01:17'),
	(7, 'Opini dan Editorial', 'opini-dan-editorial', '', '2024-06-15 02:01:26', '2024-06-15 02:01:26'),
	(8, 'Previews', 'previews', '', '2024-06-15 02:01:32', '2024-06-15 02:01:32'),
	(9, 'Hardware dan Periferal', 'hardware-dan-periferal', '', '2024-06-15 02:01:39', '2024-06-15 02:01:39'),
	(10, 'Indie Games', 'indie-games', '', '2024-06-15 02:01:49', '2024-06-15 02:01:49'),
	(11, 'Retro Gaming', 'retro-gaming', '', '2024-06-15 02:01:56', '2024-06-15 02:01:56'),
	(12, 'Community', 'community', '', '2024-06-15 02:02:02', '2024-06-15 02:02:02'),
	(13, 'Event Coverage', 'event-coverage', '', '2024-06-15 02:02:11', '2024-06-15 02:02:11'),
	(14, 'Interviews', 'interviews', '', '2024-06-15 02:02:18', '2024-06-15 02:02:18');");

    if ($query) {
        echo "Seeding categorys success" . PHP_EOL;
    } else {
        echo "Error seeding categorys : " . PHP_EOL;
    }
}

seedUsers();