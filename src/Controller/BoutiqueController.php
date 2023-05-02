<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commande;
use App\Entity\FamilleArticle;
use App\Entity\TypeCommande;
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
    public function Paiement(Bool $fidelite, Request $req, EntityManagerInterface $manager): Response
    {
        $session = $req->getSession();
        $panier = $session->get('panier');
        $user = $this->getUser();

        $msg = "Commande ok.";
        $cmdOk = true;

        $totalFid = 0;
        $totalEur = 0;
        $gainFid = 0;

        foreach ($panier as $item) {
            if ($fidelite) {
                $totalFid += $item->getPrixFidelite();
            } else {
                $totalEur += $item->getPrixEuro();
            }
        }

        if ($fidelite) {
            if ($user->getAmountFidelite() < $totalFid) {
                $msg = "Vous n'avez pas assez de points de fidelite.";
                $cmdOk = false;
            }
        } else {
            if ($user->getAmountEuro() < $totalEur) {
                $msg = "Vous n'avez pas assez d'euro sur votre compte.";
                $cmdOk = false;
            }
        }

        if (count($panier)==0) {
            $cmdOk = false;
            $msg = "Vous n'avez aucun article dans votre panier.";
        }
        if ($cmdOk) {
            $commande = new Commande();

            if ($fidelite) {
                $user->setAmountFidelite($user->getAmountFidelite() - $totalFid);
                $commande->setMontantEuro(0);
                $commande->setMontantFidelite($totalFid);
            } else {
                $user->setAmountEuro($user->getAmountEuro() - $totalEur);
                $commande->setMontantEuro($totalEur);
                $commande->setMontantFidelite(0);
            }
            $commande->setUser($user);
            $commande->setDateCommande(new \DateTime());
            
            
            $gainFid = $commande->getMontantEuro();
            
            $commande->setGainFidelite($gainFid);
            $commande->setIdTypecommande($manager->getRepository(TypeCommande::class)->find(1));
            $user->setAmountFidelite($user->getAmountFidelite() + $gainFid);

            $manager->persist($commande);
            $manager->flush();

            $session->set('panier', array());
        }
        return $this->render('boutique/paiement.html.twig', [
            'controller_name' => 'BoutiqueController',
            'message' => $msg,
            'cmdOk' => $cmdOk,
            "gainFid" => $gainFid
        ]);
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function Accueil(): Response
    {
        return $this->render('boutique/accueil.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }

    #[Route('/compte', name: 'app_compte')]
    public function Compte(): Response
    {
        return $this->render('boutique/compte.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }

    #[Route('/avantages', name: 'app_avantages')]
    public function Avntages(): Response
    {
        return $this->render('boutique/accueil.html.twig', [
            'controller_name' => 'BoutiqueController',
        ]);
    }
}
