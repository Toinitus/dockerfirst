<?php
require_once 'vendor/autoload.php';
require_once 'db.php';

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$faker = Faker\Factory::create('fr_FR');

$post = [];
$categories = [];


for($i=0; $i<50; $i++)
{
$pdo->exec("
INSERT INTO post SET
name='{$faker->sentence()}',
slug='{$faker->slug}',
content='{$faker->paragraphs(rand(3, 15), true)}', 
created_at='{$faker->date} {$faker->time}'
");
$posts[] = $pdo->lastInsertId();
}


for ($i = 0; $i<50; $i++){
    $pdo->exec("INSERT INTO category SET
        name='{$faker->words(3, true)}',
        slug='{$faker->slug}'
    ");
    $categories[] = $pdo->lastInsertId();
 }

 foreach($posts as $post){
     $randomCategories = $faker->randomElements($categories, 1);
     foreach($randomCategories as $category){
         $pdo->exec("INSERT INTO post_category SET
                                    post_id={$post},
                                    category_id={$category}");
     }
 }
 
for ($i=0; $i <20; $i++) { 
    $passwordhash = password_hash($faker->password(), PASSWORD_BCRYPT);
    $pdo->exec("INSERT INTO user SET
    username='{$faker->name}',
    password ='{$passwordhash}'
    ");
}