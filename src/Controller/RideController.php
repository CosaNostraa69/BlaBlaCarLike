<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Ride;
use App\Entity\User;
use App\Entity\Rule;

class RideController extends AbstractController
{
#[Route('/ride', name: 'app_ride')]
public function index(EntityManagerInterface $entityManager): Response
{
// J'accède au repertoire de la classe Product grâce au EntityManagerInterface
$pageTitle = 'Ride';
$rideRepository = $entityManager->getRepository(Ride::class);
$userRepository = $entityManager->getRepository(User::class);
$allRides = $rideRepository->findAll();
$users = $userRepository->findAll();
return $this->render('ride/ride.html.twig', [
'controller_name' => 'RideController',
'rides' => $allRides,
'users' => $users,
'page_title' => $pageTitle,

]);
}
#[Route('/ride/detail/{id}', name: 'app_ride_detail')]
public function detail(EntityManagerInterface $entityManager, string $id): Response
{
// J'accède au repertoire de la classe Product grâce au EntityManagerInterface
$pageTitle = 'Detail';
$rideRepository = $entityManager->getRepository(Ride::class);
$userRepository = $entityManager->getRepository(User::class);
$ruleRepository = $entityManager->getRepository(Rule::class);
$ride = $rideRepository->find($id);
$users = $userRepository->findAll();
$rules = $ruleRepository->findAll();
return $this->render('ride/detail.html.twig', [
'ride' => $ride,
'users' => $users,
'rules' => $rules,
'page_title' => $pageTitle,

]);
}

}