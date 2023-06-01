<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ride;
use DateTime;


class RideFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
    
        
            for ($i = 0; $i < 10; $i ++) {
    
                $ride = new Ride();
                $ride->setDeparture($this->faker->city());
                $ride->setDestination($this->faker->city());
                $ride->setSeats($this->faker->numberBetween(1,4));
                $ride->setPrice($this->faker->numberBetween(5,38));
                $ride->setDate($this->faker->DateTimeThisMonth());
                $ride->setCreated(new DateTime());

    
                $manager->persist($ride);
                $this->setReference('car' . $i, $ride);
            }
            $manager->flush();
    
}
}