<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRecetteController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_recette")
     */
    public function index(RecetteRepository $repoRecette): Response
    {

        $recettes = $repoRecette->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminRecetteController',
            'recettes' => $recettes
        ]);
    }


    /**
     * @Route("/admin/create", name="recette_create")
     */

    public function create(Recette $recette = null, Request $request, EntityManagerInterface $manager) {

        if(!$recette){
            $recette = new Recette();
        }
        
    
        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recette->setCreatedAt(new \DateTime());
            $manager->persist($recette);
            $manager->flush();

            return $this->redirectToRoute('admin_recette');
        }

        return $this->render('/admin/create.html.twig', [
            'formRecette' => $form->createView(),
        ]);

    }

    /**
     * @Route("/admin/{id}/edit", name="recette_edit")
     */

    public function edit(Recette $recette = null, Request $request, EntityManagerInterface $manager) {

        if(!$recette){
            $recette = new Recette();
        }
        
    
        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($recette);
            $manager->flush();

            return $this->redirectToRoute('admin_recette');
        } 

        return $this->render('/admin/edit.html.twig', [
            'formRecetteEdit' => $form->createView(),
        ]);


    }


    /**
     * @Route("/admin/{id}/delete", name="recette_delete")
     */

    public function delete(Recette $recette = null, EntityManagerInterface $manager) {

        if(!$recette){
            $recette = new Recette();
        }
    
            $manager->remove($recette);
            $manager->flush();
        
        return $this->redirectToRoute('admin_recette');

    }
}
