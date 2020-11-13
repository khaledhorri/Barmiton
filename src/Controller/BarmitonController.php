<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BarmitonController extends AbstractController
{

    /**
     * @Route("/", name = "home")
     */
    public function home(){
        return $this->render('barmiton/home.html.twig');
    }

    /**
     * @Route("/barmiton", name="barmiton")
     */
    public function index(RecetteRepository $repoRecette/* EntityManagerInterface $manager */): Response
    {
        
        $recettes = $repoRecette->findAll();
        
        // for ($i=1; $i <= 10; $i++) { 
        // $recette = new Recette();
        // $recette->setTitle("Titre de la recette n°$i")
        //         ->setAbstract("Pizza à base d'ingrédients bio")
        //         ->setPreparation("Patte fine, sauce tomate, 4 fromages, olives, viande hachée.....")
        //         ->setTime("25 min")
        //         ->setPerson(2)
        //         ->setCreatedAt(new \DateTime());
        // $manager->persist($recette);
        // }
        
        // $manager->flush();

        return $this->render('barmiton/index.html.twig', [
            'controller_name' => 'Barmiton',
            'recettes' => $recettes
        ]);
    }

    /**
     * @Route("/barmiton/{id}", name="recette_show")
     */
    public function show(Recette $recette) {

        return $this->render('barmiton/show.html.twig', [
            'recette' => $recette
        ]);

    }

}
