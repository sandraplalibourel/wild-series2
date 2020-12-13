<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
USE Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew-Lincoln',
        'Norman-Reedus',
        'Lauren-Cohan',
        'Danai-Gurira',
    ];

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
       foreach (self::ACTORS as $key => $actorName) {
           $faker = Faker\Factory::create('en_US');
           $actorName = $faker->name;
           $actor = new Actor();
           $actor->setName($actorName);
           $actor->addProgram($this->getReference('program_0'));
           $manager->persist($actor);
           $this->addReference('actor_' . $key, $actor);
       }
        $manager->flush();
    }
}
