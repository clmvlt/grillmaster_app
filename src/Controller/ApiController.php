<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    #[Route('/api/getArticles', name: 'app_api_getarticles')]
    public function getArticles(ArticleRepository $rep): JsonResponse
    {
        $lesarticles = $rep->findAll();
        $data = [];
        foreach ($lesarticles as $article) {
            $data[] = [
                'id' => $article->getId(),
                'libelle' => $article->getLibelle(),
                'image' => $article->getImage(),
                'prix_euro' => $article->getPrixEuro(),
                'prix_fidelite' => $article->getPrixFidelite(),
            ];
        }
        return new JsonResponse($data);
    }
}
