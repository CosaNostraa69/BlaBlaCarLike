<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Entity\Ride;
use App\Entity\User;
use App\Form\RideType;
use App\Form\AddCarType;
use App\Form\EditProfileType;
use App\Form\RegistrationFormType;
use App\Repository\RideRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(RideRepository $rideRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $cars = $user->getCars();
        $rides = $rideRepository->findBy(["driver" => $user]);

        $editCarForms = [];
        foreach ($cars as $car) {
            $editCarForms[$car->getId()] = $this->createForm(AddCarType::class, $car)->createView();
        }

        return $this->render('profile/profile.html.twig', [
            'user' => $user,
            'cars' => $cars,
            'rides' => $rides,
            'editCarForms' => $editCarForms,
            'controller_name' => 'ProfileController',
        ]);

    }

    #[Route('/profile/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
public function editProfile(EntityManagerInterface $entityManager, Request $request): Response
{
    $user = $this->getUser();
  

    $editProfile = $this->createForm(EditProfileType::class, $user);
    $editProfile->handleRequest($request);

    if ($editProfile->isSubmitted() && $editProfile->isValid()) {
        $entityManager->flush();
        return $this->redirectToRoute('app_profile');
    }
    return $this->render('profile/edit_profile.html.twig', [
        'editProfile' => $editProfile->createView(),
        'controller_name' => 'ProfileController',
    ]);
}

  
    #[Route('/profile/add/car', name: 'add_profil_car', methods: ['GET', 'POST'])]
    public function addCar(Request $request, EntityManagerInterface $entityManager): Response
    {
        $car = new Car();
        $addCar = $this->createForm(AddCarType::class, $car);
        $addCar->handleRequest($request);
    
        if ($addCar->isSubmitted() && $addCar->isValid()) {
            $user = $this->getUser();
            $car->setOwner($user);
            $entityManager->persist($car);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('profile/add_car.html.twig', [
            'addCar' => $addCar->createView(),
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/edit/car/{id}', name: 'edit_profil_car', methods: ['GET', 'POST'])]
    public function editCar(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $car = $entityManager->getRepository(Car::class)->find($id);

        if (!$car) {
            throw $this->createNotFoundException('No car found for id ' . $id);
        }
    
        $editCar = $this->createForm(AddCarType::class, $car);
        $editCar->handleRequest($request);
    
        if ($editCar->isSubmitted() && $editCar->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('profile/edit_car.html.twig', [
            'editCar' => $editCar->createView(),
            'controller_name' => 'ProfileController',
        ]);
    }
    #[Route('/profile/delete/car/{id}', name: 'delete_profil_car', methods: ['POST'])]
    public function deleteCar(int $id, EntityManagerInterface $entityManager): Response
    {
        $car = $entityManager->getRepository(Car::class)->find($id);

        if (!$car) {
            throw $this->createNotFoundException('No car found for id ' . $id);
        }

        $entityManager->remove($car);
        $entityManager->flush();

        return $this->redirectToRoute('app_profile');
    }

    #[Route('/profile/add/ride', name: 'add_profil_ride', methods: ['GET', 'POST'])]
public function addRide(Request $request, EntityManagerInterface $entityManager): Response
{
    $ride = new Ride();
    $addRide = $this->createForm(RideType::class, $ride);
    $addRide->handleRequest($request);
    
    
    if ($addRide->isSubmitted() && $addRide->isValid()) {
        $user = $this->getUser();
        $ride->setDriver($user);
        $ride->setCreated(new \DateTime);
        $entityManager->persist($ride);
        $entityManager->flush();

        return $this->redirectToRoute('app_profile');
    }
    return $this->render('profile/add_ride.html.twig', [
        'addRide' => $addRide->createView(),
        'controller_name' => 'ProfileController',
    ]);
}

#[Route('/profile/edit/ride/{id}', name: 'edit_profil_ride', methods: ['GET', 'POST'])]
public function editRide(int $id, Request $request, EntityManagerInterface $entityManager): Response
{
    $ride = $entityManager->getRepository(Ride::class)->find($id);

    if (!$ride) {
        throw $this->createNotFoundException('No ride found for id ' . $id);
    }

    $editRide = $this->createForm(RideType::class, $ride);
    $editRide->handleRequest($request);

    if ($editRide->isSubmitted() && $editRide->isValid()) {
        $entityManager->flush();
        return $this->redirectToRoute('app_profile');
    }
    return $this->render('profile/edit_ride.html.twig', [
        'editRide' => $editRide->createView(),
        'controller_name' => 'ProfileController',
    ]);
}

#[Route('/profile/delete/ride/{id}', name: 'delete_profil_ride', methods: ['POST'])]
public function deleteRide(int $id, EntityManagerInterface $entityManager): Response
{
    $ride = $entityManager->getRepository(Ride::class)->find($id);

    if (!$ride) {
        throw $this->createNotFoundException('No ride found for id ' . $id);
    }

    $entityManager->remove($ride);
    $entityManager->flush();

    return $this->redirectToRoute('app_profile');
}

}
