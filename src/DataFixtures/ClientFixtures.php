<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Dette;
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
                //creation d un utilisateur avec le client
                $user = new User();
                $user->setNom('Nom'. $i);
                $user->setPrenom('Prenom'. $i);
                $user->setLogin('login'. $i);
                $plaintextPassword = "password";
                $hashedPassword = $this ->encoder->hashPassword(
                    $user, 
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);
                $client ->setUsers($user);
                //Creation des dettes
                for ($j=1; $j <= 2 ; $j++) { 
                    $dette = new Dette();
                    $dette->setMontant(5000*$j);
                    $dette->setMontantVerser(15000*$j);
                    $client->addDette($dette);
                }
            }else {
                for ($j=1; $j <= 2 ; $j++) { 
                    $dette = new Dette();
                    $dette->setMontant(5000*$j);
                    $dette->setMontantVerser(15000);
                    $client->addDette($dette);
                }
            }
            $manager ->persist($client);
        }


        $manager->flush();
    }
}
