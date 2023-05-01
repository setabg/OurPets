<?php

namespace App\Controller;

use App\Repository\AddPetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainPageController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(AddPetsRepository $addPetsRepository): Response
    {
        $pets = $addPetsRepository->findAllPets();

        return $this->render('mainPage/index.html.twig', [
            'pets' => $pets
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function custom(Request $request)
    {
        return $this->render('MainPage/custom.html.twig');
    }
}
