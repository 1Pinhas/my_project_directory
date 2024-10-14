<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class ClientController extends AbstractController
{
    #[Route('/clients', name: 'clients.index', methods:['GET'])]
    public function index(Request $request): Response
    {
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    //utilsationn des path variables(les données en parametres)
    #[Route('/clients/show/{id?}', name: 'clients.show', methods:['GET'])]
    public function show(int $id): Response
    {
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    //utilisatin des query params
    #[Route('/clients/search/phone', name: 'clients.showClientByPhone', methods:['GET'])]
    public function searchClientByPhone(Request $request): Response
    {
        //$request->query->get('phone')=>$_GET['key];
        //$request->request->get('name_field') => $_POST['name_field']
        $phone = $request->query->get('tel');
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/clients/remove/{id?}', name: 'clients.remove', methods:['GET', 'POST'])]
    public function remove(int $id): Response
    {
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/clients/store', name: 'clients.store', methods:['GET', 'POST'])]
    public function store(): Response
    {
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

}
