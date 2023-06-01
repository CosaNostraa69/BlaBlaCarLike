<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Car;
use DateTime;

class CarFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
    
        
            for ($i = 0; $i < 10; $i ++) {
    
                $car = new Car();
                $car->setBrand($this->faker->word());
                $car->setModel($this->faker->word());
                $car->setSeats($this->faker->numberBetween(1,4));
                $car->setCreated(new DateTime());

    
                $manager->persist($car);
                $this->setReference('car' . $i, $car);
            }
            $manager->flush();
    
}
}