<?php

namespace App\DataFixtures;

use Faker;
// use Faker\Factory;
use App\Entity\Recette;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        $plat = (new Category())->setName("Plat");
        $entree = (new Category())->setName("Entrée");
        $dessert = (new Category())->setName("Dessert");

        $manager->persist($plat);
        $manager->persist($entree);
        $manager->persist($dessert);

        $categories = [ $plat, $entree, $dessert];

        for ($i = 1; $i <= 30; $i++) {

        $recette = new Recette();
        $recette
                ->setTitle($faker->sentence())
                ->setAbstract($faker->sentence(20))
                ->setPreparation($faker->paragraph())
                ->setTime($faker->numberBetween($min = 10, $max = 50) . " min")
                ->setPerson($faker->numberBetween($min = 1, $max = 8))
                ->setImage($faker->imageUrl($width = 150, $height = 100))
                ->setCategory($faker->randomElement($categories))
                ->setCreatedAt(new \DateTime());

        $manager->persist($recette);

          }
          $manager->flush();

        // $product = new Product();
        // $manager->persist($product);
    }
}
