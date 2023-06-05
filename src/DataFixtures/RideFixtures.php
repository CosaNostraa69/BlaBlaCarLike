<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ride;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RideFixtures extends AbstractFixture implements DependentFixtureInterface
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
            $ride->setDriver($this->getReference('user_' . $this->faker->numberBetween(0,9)));
            $ride->addRule($this->getReference('rule' . $this->faker->numberBetween(0,9)));


            $manager->persist($ride);
            $this->addReference('ride' . $i, $ride);
        }
        $manager->flush();
    }
    public function getDependencies(){
        return [UserFixture::class, RuleFixtures::class];
    }
}
