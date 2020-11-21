<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Form\UserRecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BarmitonController extends AbstractController
{

    /**
     * @Route("/", name = "home")
     */
    public function home()
    {
        return $this->render('barmiton/home.html.twig');
    }

    /**
     * @Route("/barmiton", name="barmiton")
     */
    public function index(RecetteRepository $repoRecette, Request $request, EntityManagerInterface $manager): Response
    {


        $recettes = $repoRecette->findAll();

        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $username = $this->getUser();

        $recetteUser = new Recette();

        $form = $this->createForm(UserRecetteType::class, $recetteUser);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recetteUser->setCreatedAt(new \DateTime());
            $recetteUser->setUsername($username);
            $manager->persist($recetteUser);
            $manager->flush();

            return $this->redirectToRoute('barmiton');
        }

        return $this->render('barmiton/index.html.twig', [
            'controller_name' => 'Barmiton',
            'recettes' => $recettes,
            'formRecetteAdd' => $form->createView()
        ]);
    }

    /**
     * @Route("/barmiton/{id}", name="recette_show")
     */
    public function show(Recette $recette)
    {

        return $this->render('barmiton/show.html.twig', [
            'recette' => $recette
        ]);
    }
}
