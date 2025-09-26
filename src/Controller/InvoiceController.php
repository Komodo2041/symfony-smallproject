<?php

namespace App\Controller;

use App\Entity\Invoice;
 
use Doctrine\ORM\EntityManagerInterface; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
 
use Symfony\Component\HttpFoundation\Request;
use App\Form\InvoiceType;  

final class InvoiceController extends AbstractController
{
 
    #[Route('/invoices')]
    public function invoices(EntityManagerInterface $entityManager): Response {
 
        $productRepository = $entityManager->getRepository(Invoice::class);
        $invoices = $productRepository->findBy(['deleted' => 0]);
 
        return $this->render('finance/invoice.html.twig', [
           'invoices' => $invoices,
           'tab' => 'invoice'
        ]);        
    }

     #[Route('/invoice/add')]
    public function addInvoice(Request $request, EntityManagerInterface $entityManager): Response {

        $invoice = new Invoice();
        $invoice->setcoluid();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($invoice);
            $entityManager->flush();
            $this->addFlash('success', 'Faktura została zapisana!');
            return $this->redirect('/invoices');
        }

        return $this->render('finance/newinvoice.html.twig', [
            'form' => $form->createView(),
            'tab' => 'invoice'
        ]);        

    }

     #[Route('/invoice/delete/{id}')]
    public function delInvoice($id, EntityManagerInterface $entityManager): Response {
    
        $productRepository = $entityManager->getRepository(Invoice::class);
     
        $invoice = $productRepository->find($id);
        $invoice->deleted();
        $entityManager->persist($invoice);
        $entityManager->flush();        
         $this->addFlash('success', 'Faktura została usunięta');
        return $this->redirect('/invoices');     
    }      

    #[Route('/invoice/edit/{id}')]
    public function editInvoice(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Faktura została zaktualizowana!');

            return $this->redirect('/invoices');
        }
        return $this->render('finance/newinvoice.html.twig', [
            'form' => $form->createView(),
            'tab' => 'invoice',
            'invoice' => $invoice,
        ]);   
    }


}
