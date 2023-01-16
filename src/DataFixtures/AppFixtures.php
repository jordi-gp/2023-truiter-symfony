<?php

namespace App\DataFixtures;

use App\Entity\Tweet;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        $user = new User();

        $user->setName("Jordi");
        $user->setUsername("jogapo");
        $user->setCreatedAt($faker->dateTimeInInterval('-1 year'));
        $user->setPassword("1234");
        $user->setVerified(true);

        $manager->persist($user);

        for($i=0; $i<3; $i++) {
            $tweet = new Tweet();
            $tweet->setText($faker->text(280));
            $tweet->setCreatedAt($faker->dateTimeInInterval('-1 year', '1 year'));
            $tweet->setAuthor($user);
            $tweet->setLikeCount(0);

            $manager->persist($tweet);
        }

        $manager->flush();
    }
}
