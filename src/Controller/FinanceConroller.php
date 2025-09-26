<?php
 
namespace App\Controller;

use App\Entity\Contractor;
 
use Doctrine\ORM\EntityManagerInterface; 

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Form\ContractorType; 
 

class FinanceConroller extends AbstractController
{
 
    #[Route('/contractors')]
    public function contractors(EntityManagerInterface $entityManager): Response {
 
        $productRepository = $entityManager->getRepository(Contractor::class);
        $contractors = $productRepository->findBy(['deleted' => 0]);
 
        return $this->render('finance/contractors.html.twig', [
           'contractors' => $contractors,
           'tab' => 'contractor'
        ]);        
    }

     #[Route('/contractor/delete/{id}')]
    public function delContractors($id, EntityManagerInterface $entityManager): Response {
    
        $productRepository = $entityManager->getRepository(Contractor::class);
     
        $contractor = $productRepository->find($id);
        $contractor->deleted();

        $entityManager->persist($contractor);
        $entityManager->flush();        
         $this->addFlash('success', 'Kontraktor został usunięty');
        return $this->redirect('/contractors');     
    }  
    
     #[Route('/contractor/add')]
    public function addContractor(Request $request, EntityManagerInterface $entityManager): Response {

        $contractor = new Contractor();
        $form = $this->createForm(ContractorType::class, $contractor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         
            $entityManager->persist($contractor);
            $entityManager->flush();

            $this->addFlash('success', 'Kontraktor został zapisany!');

            return $this->redirect('/contractors');
        }

        return $this->render('finance/newcontractor.html.twig', [
            'form' => $form->createView(),
            'tab' => 'contractor'
        ]);        

    }

    #[Route('/contractor/edit/{id}')]
    public function edit(Request $request, Contractor $contractor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContractorType::class, $contractor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Kontraktor został zaktualizowany!');

            return $this->redirect('/contractors');
        }
        return $this->render('finance/newcontractor.html.twig', [
            'form' => $form->createView(),
            'tab' => 'contractor',
            'contractor' => $contractor,
        ]);   
 
    }

 


}