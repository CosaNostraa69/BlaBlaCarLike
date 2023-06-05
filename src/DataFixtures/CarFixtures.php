<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Car;
use DateTime;



class CarFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i ++) {
            $car = new Car();
            $car->setBrand($this->faker->word());
            $car->setModel($this->faker->word());
            $car->setSeats($this->faker->numberBetween(1,4));
            $car->setCreated(new DateTime());
            $car->setOwner($this->getReference('user_'. $this->faker->numberBetween(0,9)));


            $manager->persist($car);
            $this->addReference('car' . $i, $car);
        }
        $manager->flush();
    }

    public function getDependencies(){
        return [UserFixture::class];
    }
}