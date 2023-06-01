<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Rule;
use DateTime;

class RuleFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
    
        
            for ($i = 0; $i < 10; $i ++) {
    
                $rule = new Rule();
                $rule->setName($this->faker->word());
                $rule->setDescription($this->faker->word());

    
                $manager->persist($rule);
                $this->setReference('car' . $i, $rule);
            }
            $manager->flush();
    
}
}