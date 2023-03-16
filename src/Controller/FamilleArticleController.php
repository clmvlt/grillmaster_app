<?php

namespace App\Controller;

use App\Entity\FamilleArticle;
use App\Form\FamilleArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamilleArticleController extends AbstractController
{
    #[Route('/famillearticle', name: 'app_famille_article')]
    public function index(): Response
    {
        return $this->render('famille_article/index.html.twig', [
            'controller_name' => 'FamilleArticleController',
        ]);
    }

    #[Route('/famillearticle/create', name: 'app_famillearticle_create')]
    #[Route('/famillearticle/edit/{id}', name: 'app_famillearticle_edit')]
    public function Gestion(FamilleArticle $familleArticle = null,
    Request $request, 
    EntityManagerInterface $manager)
    {
        
        if(!$familleArticle)
        {$familleArticle = new FamilleArticle();}
        
 
        $form = $this->createForm(FamilleArticleType::class,$familleArticle);
 
        $form->handleRequest($request);
 
        if(($form->isSubmitted() && $form->isValid()))
        {
            $manager->persist($familleArticle);
            $manager->flush();
            return $this->redirect($request->getUri());        }
 
        return $this->render('famille_article/create.html.twig', [
            'form' => $form->createView(),
            'editmode' => $familleArticle->getId() !== null
        ]);
    }

    #[Route('/famillearticle/delete/{id}', name: 'app_famillearticle_delete')]
    public function Delete(FamilleArticle $familleArticle = null,
    Request $request, 
    EntityManagerInterface $manager)
    {
        if($familleArticle) {
            $manager->remove($familleArticle);
            $manager->flush();
        }
        return $this->redirectToRoute('app_famille_article');
    }
}
