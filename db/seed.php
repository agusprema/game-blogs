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

seedUsers();