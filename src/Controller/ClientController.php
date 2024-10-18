<?php

namespace App\Controller;

use App\Form\ClientType;
use App\Form\SearchClientType;
use App\Repository\ClientRepository;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class ClientController extends AbstractController
{
    #[Route('/clients', name: 'clients.index', methods:['GET', 'POST'])]
    public function index(ClientRepository $clientRepository, Request $request): Response
    {
        $formSearch = $this->createForm(SearchClientType::class);
        $formSearch->handleRequest($request);
        $page = $request->query->getInt('page',1);
        $count = 0;
        $maxPage = 0;
        $limit = 3;
        if ($formSearch->isSubmitted($request) && $formSearch->isValid()) {
            $clients = $clientRepository->findBy(['phone'=> $formSearch->get('phone')->getData()]);
        }else {
            $clients = $clientRepository->paginateClients($page, $limit);
            $count = $clients->count();
            $maxPage = ceil($count /$limit);
        }
        return $this->render('client/index.html.twig', [
            'datas'=> $clients,
            'formSearch'=> $formSearch->createView(),
            'page' => $page,
            'maxPage'=> $maxPage,
        ]);
    }
    //utilsationn des path variables(les données en parametres)
    #[Route('/clients/show/{id?}', name: 'clients.show', methods:['GET'])]
    public function show(int $id): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    //utilisatin des query params
    #[Route('/clients/search/phone', name: 'clients.showClientByPhone', methods:['GET'])]
    public function searchClientByPhone(Request $request): Response
    {
        //$request->query->get('phone')=>$_GET['key'];
        //$request->request->get('name_field') => $_POST['name_field']
        $phone = $request->query->get('tel');
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/clients/remove/{id?}', name: 'clients.remove', methods:['GET', 'POST'])]
    public function remove(int $id): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/clients/store', name: 'clients.store', methods:['GET', 'POST'])]
    public function store(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client->setCreateAt(new \DateTimeImmutable());
            $client->setUpdateAt(new \DateTimeImmutable());
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('clients.index');

        }
        return $this->render('client/form.html.twig', [
            'formClient' => $form->createView(),
        ]);
    }
}