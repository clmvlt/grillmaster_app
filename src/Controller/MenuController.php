<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;



class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(): Response
    {
        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
    #[Route('/menu/create', name: 'app_menu_create')]
    #[Route('/menu/edit/{id}', name: 'edit')]
    public function Gestion(Menu $menu = null,
    Request $request, 
    EntityManagerInterface $manager): Response
    {

        if(!$menu)
        {$menu = new Menu();}



        $form = $this->createForm(MenuType::class,$menu);
      

        $form->handleRequest($request);

        if(($form->isSubmitted() && $form->isValid()))
        {
            $file_tmp = $_FILES['menu']['tmp_name']['image'];

            $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
            $img = $form['image']->getData();
            $data = file_get_contents($img);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $menu->setImage($base64);
            $manager->persist($menu);
            $manager->flush();
            return $this->redirect($request->getUri());        }
 
        return $this->render('menu/create.html.twig', [
            'form' => $form->createView(),
            'editmode' => $menu->getId() !== null
        ]);

    
    }
}
