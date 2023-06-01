<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function home(): Response
    {
        $pageTitle = 'Accueil';
        return $this->render('car/home.html.twig', [
            'controller_name' => 'CarController',
            'page_title' => $pageTitle,
        ]);
    }


    
    #[Route('/profil', name: 'profil_page')]
    public function details(): Response
    {
        $pageTitle = 'Profil';
        return $this->render('car/profil.html.twig', [
            'controller_name' => 'CarController',
            'page_title' => $pageTitle,
        ]);
    }   
}
    
