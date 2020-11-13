<?php

namespace App\DataFixtures;

use Faker;
// use Faker\Factory;
use App\Entity\User;
use App\Entity\Recette;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RecetteFixtures extends Fixture
{


  private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        $plat = (new Category())->setName("Plat");
        $entree = (new Category())->setName("Entrée");
        $dessert = (new Category())->setName("Dessert");

        $user = new User();
        $user
            ->setUsername("khorri")
            ->setPassword($this->passwordEncoder->encodePassword($user,'test'))
            ->setRoles(['ROLE_USER'])
            ->setEmail('horkhaled@gmail.com');

        
        $manager->persist($user);

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
                ->setUsername($user->setUsername("khorri"))
                ->setCreatedAt(new \DateTime());

        $manager->persist($recette);

          }
          $manager->flush();

        // $product = new Product();
        // $manager->persist($product);
    }
}
