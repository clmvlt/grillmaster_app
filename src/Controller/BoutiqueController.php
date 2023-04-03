<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{
    #[Route('/boutique', name: 'app_boutique')]
    public function index(): Response
    {
        return $this->render('boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }
    #[Route('/panier', name: 'app_panier')]
    public function Panier(): Response
    {
        return $this->render('boutique/panier.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }
    #[Route('/paiement/{fidelite}', name: 'app_paiement')]
    public function Paiement(Bool $fidelite, Request $req)
    {
        $session = $req->getSession();
        $panier = $session->get('panier');
        $user = $this->getUser();

        $msg = "Commande ok.";
        $cmdOk = true;

        $totalFid = 0;
        $totalEur = 0;
        foreach ($panier as $item) {
            if ($fidelite) {
                $totalFid += $item->getPrixFidelite();
            } else {
                $totalEur += $item->getPrixEuro();
            }
        }

        if ($fidelite) {
            if ($user->getAmountFidelite() < $totalFid) {
                $msg = "Pas assez de points de fidelite.";
                $cmdOk = false;
            }
        } else {
            if ($user->getAmountEuro() < $totalEur) {
                $msg = "Pas assez d'argent";
                $cmdOk = false;
            }
        }

        if ($cmdOk) {
            if ($fidelite) {
                $user->setAmountFidelite($user->getAmountFidelite() - $totalFid);
            } else {

            }
        }
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function Accueil(): Response
    {
        return $this->render('boutique/accueil.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }
}
