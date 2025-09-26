<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WarningController extends AbstractController
{
    #[Route('/warnings')]
    public function index(): Response
    {
        return $this->render('warning/index.html.twig', []);
    }
}
