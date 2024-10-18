<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $client = new Client();
            $client->setSurname('Nom'. $i);
            $client->setPhone('78765456'. $i);
            $client->setAdresse('Adresse'. $i);
            if ($i % 2== 0) {
                $user = new User();
                $user->setNom('Nom'. $i);
                $user->setPrenom('Prenom'. $i);
                $user->setLogin('login'. $i);
                $plaintextPassword = "password";
                $hashedPassword = $this ->encoder->hashPassword(
                    $user, 
                    $plaintextPassword
                );
                $client ->setUsers($user);
            }
            $manager ->persist($client);
        }


        $manager->flush();
    }
}
