<?php
require_once "vendor/autoload.php";
require_once realpath(__DIR__ . '/../core/helpers/config.php');

function seedUsers()
{
    //$2y$10$/sJmksqDk4dBYGO2Ka4UXu4xoBnwTQdeCfTXhLFQQup./7rK5hPhy // agus

    $query = (new Core\Query\QueryBuilder())->table('users')
                            ->create([
                                'email'    => 'agus@gmail.com',
                                'name'     => 'agus',
                                'password' => '$2y$10$/sJmksqDk4dBYGO2Ka4UXu4xoBnwTQdeCfTXhLFQQup./7rK5hPhy',
                                'profile'  => 'profile/avatar.png',
                                'role'     => 'admin'
                            ])
                            ->build();
            (new Core\Query\QueryBuilder())->table('users')
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

function seedTag(){
   $db = (new \Core\DB\Connect())->toDB();
   
   $query = $db->query("INSERT INTO `tags` (`title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
    ('Top 10 Games of 2024', 'top-10-games-2024', 'A curated list of the top 10 games released in 2024, covering various genres and platforms.', '2024-01-10 14:32:00', '2024-01-10 14:32:00'),
    ('Best RPGs to Play', 'best-rpgs-to-play', 'An extensive guide on the best role-playing games available across different consoles and PC.', '2024-02-15 09:21:00', '2024-02-15 09:21:00'),
    ('Game Development Tips', 'game-development-tips', 'Tips and tricks for budding game developers to improve their game development skills.', '2024-03-22 11:45:00', '2024-03-22 11:45:00'),
    ('Upcoming eSports Tournaments', 'upcoming-esports-tournaments', 'A schedule of the most anticipated eSports tournaments happening this year.', '2024-04-18 16:30:00', '2024-04-18 16:30:00'),
    ('Retro Gaming Revival', 'retro-gaming-revival', 'Exploring the resurgence of retro games and why they are gaining popularity again.', '2024-05-05 12:00:00', '2024-05-05 12:00:00'),
    ('VR Games to Watch', 'vr-games-to-watch', 'An overview of the most exciting virtual reality games set to release soon.', '2024-06-25 10:15:00', '2024-06-25 10:15:00'),
    ('Indie Games Spotlight', 'indie-games-spotlight', 'Highlighting some of the best indie games that deserve your attention.', '2024-07-12 08:45:00', '2024-07-12 08:45:00'),
    ('Mobile Gaming Trends', 'mobile-gaming-trends', 'Current trends in mobile gaming and predictions for the future.', '2024-08-19 14:20:00', '2024-08-19 14:20:00'),
    ('Guide to Game Streaming', 'guide-to-game-streaming', 'Everything you need to know about game streaming, from platforms to equipment.', '2024-09-30 09:00:00', '2024-09-30 09:00:00'),
    ('Top 5 Horror Games', 'top-5-horror-games', 'A list of the scariest horror games that will keep you up at night.', '2024-10-25 18:00:00', '2024-10-25 18:00:00');
    ");

    if ($query) {
        echo "Seeding tags success" . PHP_EOL;
    } else {
        echo "Error seeding tags : " . PHP_EOL;
    }
}

seedUsers();
seedCategory();
seedTag();