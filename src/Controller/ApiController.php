<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\FamilleArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('api/addPanier/{id}', name: 'app_api_addpanier')]
    public function AddPanier(Article $article, Request $req) {
        $session = $req->getSession();
        $panier = $session->get('panier');
        if (is_null($panier)) $panier = array();
        array_push($panier, $article);
        $session->set('panier', $panier);

        return new JsonResponse(true);
    }

    #[Route('api/removePanier/{id}', name: 'app_api_removepanier')]
    public function RemovePanier(Article $article, Request $req) {
        $session = $req->getSession();
        $panier = $session->get('panier');
        if (is_null($panier)) $panier = array();
        $item = null;
        foreach ($panier as $key => $value) {
            $item = $key;
            if ($value->getId() == $article->getId()) break;
        }
        unset($panier[$item]);  
        $session->set('panier', $panier);

        return new JsonResponse(true);
    }


    #[Route('api/getPanier', name: 'app_api_getpanier')]
    public function GetPanier(Request $req, FamilleArticleRepository $rep) {
        $session = $req->getSession();
        $panier = $session->get('panier');
        if (is_null($panier)) $panier = array();
        $data = array();
        foreach ($panier as $item) {
            $data[] = [
                'id' => $item->getId(),
                'libelle' => $item->getLibelle(),
                'image' => $item->getImage(),
                'prix_euro' => $item->getPrixEuro(),
                'prix_fidelite' => $item->getPrixFidelite(),
                'fidelite' => $item->isFidelite(),
                'description' => $item->getDescription(),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('api/getUser', name: 'app_api_getuser')]
    public function GetLoggedUser(Request $req) {
        $user = $this->getUser();
        if (is_null($user)) {
            $data = [
                'id' => null,
            ];
        } else {
            $data = [
                'id' => $user->getId(),
                'username' => $user->getUserIdentifier(),
                'roles' => $user->getRoles(),
                'amount_euro' => $user->getAmountEuro(),
                'amount_fidelite' => $user->getAmountFidelite(),
            ];
        }

        return new JsonResponse($data);
    }
    #[Route('api/getMenu', name: 'app_api_getmenu')]
    public function getMenu(ArticleRepository $rep): JsonResponse
    {
        $lesmenu = $rep->findAll();
        $data = [];
        foreach ($lesmenu as $menu) {
            $data[] = [
                'id' => $menu->getId(),
                'libelle' => $menu->getLibelle(),
                'image' => $menu->getImage(),
           
            ];
        }
        return new JsonResponse($data);
    }
}
