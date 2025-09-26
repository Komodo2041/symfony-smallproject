<?php

namespace App\Controller;

use App\Entity\Core;
use Doctrine\ORM\EntityManagerInterface; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WarningController extends AbstractController
{
    #[Route('/warnings')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $productRepository = $entityManager->getRepository(Core::class);
        $core = $productRepository->findBy(['deleted' => 0]);        
        return $this->render('warning/index.html.twig', [
           'core' => $core,
           'tab' => 'warning'     
        ]);
    }

     #[Route('/warning/delete/{id}')]
    public function delBudget($id, EntityManagerInterface $entityManager): Response {
    
        $coreRepository = $entityManager->getRepository(Core::class);
     
        $core = $coreRepository->find($id);
        $core->deleted();
        $entityManager->persist($core);
        $entityManager->flush();        
         $this->addFlash('success', 'Ostrzeżenie zostało usunięte');
        return $this->redirect('/warnings');     
    }      
}
