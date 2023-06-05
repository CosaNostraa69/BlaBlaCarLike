<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use DateTime;

class UserFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i ++) {
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
            $user->setPassword($this->faker->password());
            $user->setPhone($this->faker->phoneNumber());
            $user->setCreated(new DateTime());



            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }
        $manager->flush();
    }
}
