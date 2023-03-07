<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    #[Route('/article/liste', name: 'app_article_liste')]
    public function liste(ArticleRepository $rep): Response
    {
        $t = $rep->findAll();
        return $this->render('article/liste.html.twig', [
            'lesArticles' => $t,
        ]);
    }

    #[Route('/article/create', name: 'app_article_create')]
    #[Route('/article/edit/{id}', name: 'app_article_edit')]
    public function GestionProprietaires(Article $article = null,
    Request $request, 
    EntityManagerInterface $manager)
    {
        
        if(!$article)
        {$article = new Article();}
        
 
        $form = $this->createForm(ArticleType::class,$article);
 
        $form->handleRequest($request);
 
        if(($form->isSubmitted() && $form->isValid()))
        {
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('retour');
        }
 
        return $this->render('article/create.html.twig', [
            'form' => $form->createView(),
            'editmode' => $article->getId() !== null
        ]);
    }
}
