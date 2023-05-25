<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/accueil', name: 'home_page')]
    public function home(): Response
    {
        $pageTitle = 'Accueil';
        return $this->render('car/home.html.twig', [
            'controller_name' => 'CarController',
            'page_title' => $pageTitle,
        ]);
    }


    #[Route('/annonce', name: 'carList_page')]
    public function annonce(): Response
    {
        $pageTitle = 'Annonces';
        return $this->render('car/carList.html.twig', [
            'controller_name' => 'CarController',
            'page_title' => $pageTitle,
        ]);
    }  
    
    
    #[Route('/details', name: 'details_page')]
    public function details(): Response
    {
        $pageTitle = 'Détails';
        return $this->render('car/details.html.twig', [
            'controller_name' => 'CarController',
            'page_title' => $pageTitle,
        ]);
    }
}
