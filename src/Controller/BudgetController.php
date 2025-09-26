<?php

namespace App\Controller;

use App\Entity\Budget;
use Doctrine\ORM\EntityManagerInterface; 

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
use App\Form\BudgetType;  

final class BudgetController extends AbstractController
{
    #[Route('/budgets')]
    public function budgets(EntityManagerInterface $entityManager): Response {
 
        $productRepository = $entityManager->getRepository(Budget::class);
        $budgets = $productRepository->findBy(['deleted' => 0]);
 
        return $this->render('finance/budget.html.twig', [
           'budgets' => $budgets,
           'tab' => 'budget'
        ]);        
    }

     #[Route('/budget/delete/{id}')]
    public function delBudget($id, EntityManagerInterface $entityManager): Response {
    
        $productRepository = $entityManager->getRepository(Budget::class);
     
        $budget = $productRepository->find($id);
        $budget->deleted();
        $entityManager->persist($budget);
        $entityManager->flush();        
         $this->addFlash('success', 'Budget został usunięty');
        return $this->redirect('/budgets');     
    }  
    
     #[Route('/budget/add')]
    public function addBudget(Request $request, EntityManagerInterface $entityManager): Response {

        $budget = new Budget();
        $form = $this->createForm(BudgetType::class, $budget );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($budget);
            $entityManager->flush();
            $this->addFlash('success', 'Budget został zapisany!');
            return $this->redirect('/budgets');
        }

        return $this->render('finance/newbudget.html.twig', [
            'form' => $form->createView(),
            'tab' => 'budget'
        ]);        

    }

    #[Route('/budget/edit/{id}')]
    public function editBudget(Request $request, Budget $budget, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Budżet został zaktualizowany!');

            return $this->redirect('/budgets');
        }
        return $this->render('finance/newbudget.html.twig', [
            'form' => $form->createView(),
            'tab' => 'budget',
            'contractor' => $budget,
        ]);   
    }

}
