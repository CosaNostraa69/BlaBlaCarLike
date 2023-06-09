<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Rule;
use DateTime;


class RuleFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i ++) {
            $rule = new Rule();
            $rule->setName($this->faker->word());
            $rule->setDescription($this->faker->word());
            $rule->setAuthor($this->getReference('user_' . $this->faker->numberBetween(0,9)));


            $manager->persist($rule);
            $this->addReference('rule' . $i, $rule);
        }
        $manager->flush();
    }

    public function getDependencies(){
        return [UserFixture::class];
    }
}