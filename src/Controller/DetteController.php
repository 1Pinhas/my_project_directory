<?php

namespace App\Controller;

use App\Entity\Dette;
use App\Form\DetteType;
use App\Repository\DetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetteController extends AbstractController
{
    #[Route('/dettes', name: 'dettes.index', methods:['GET', 'POST'])]
    public function index(DetteRepository $detteRepository , Request $request, EntityManagerInterface $em): Response
    {
        $status = $request->query->get('status');
        $dettes = $em->getRepository(Dette::class)->findBy(['status' => $status]);

        return $this->render('debts/index.html.twig', [
            'dettes' => $dettes,
            'status' => $status,
        ]);
    }

    #[Route('/dettes/create', name: 'dettes.index')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $dette = new Dette();
        $form = $this->createForm(DetteType::class, $dette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dette);
            $em->flush();

            return $this->redirectToRoute('dettes.index');
        }

        return $this->render('dettes/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
