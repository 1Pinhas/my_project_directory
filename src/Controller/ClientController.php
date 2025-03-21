<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(Request $request): Response
    {
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}
