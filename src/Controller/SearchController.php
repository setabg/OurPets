<?php

namespace App\Controller;

use App\Repository\AddPetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    private AddPetsRepository $addPetsRepository;

    /**
     * @param AddPetsRepository $addPetsRepository
     */
    public function __construct(AddPetsRepository $addPetsRepository)
    {
        $this->addPetsRepository = $addPetsRepository;
    }

    /**
     * @param AddPetsRepository $addPetsRepository
     * @param Request $request
     * @return Response
     */
    public function searchPet(AddPetsRepository $addPetsRepository, Request $request): Response
    {

//        $petsByName = [];
//        $petsByKind = [];
//        $petsByNameAndKind = [];
//
//
//        if ($request->query->get('petName') != '' && $request->query->get('petKind') != '') {
//            $petName = $request->query->get('petName');
//            $petKind = $request->query->get('petKind');
//            $petsByNameAndKind = $addPetsRepository->findPetByKindAndName($petName, $petKind);
//        } elseif ($request->query->get('petName') != '') {
//            $petsByName = $this->addPetsRepository->findPetByName($request->query->get('petName'));
//        } elseif ($request->query->get('petName') == '' && $request->query->get('petKind') != '') {
//            $petsByKind = $this->addPetsRepository->findPetByKind($request->query->get('petKind'));
//        }

        $petKinds = [];
        $petsKind = $this->addPetsRepository->findAll();
        foreach ($petsKind as $pet) {
            $petKind = $pet->getPetKind();
            if (!in_array($petKind, $petKinds)) {
                $petKinds[] = $petKind;
            }
        }
        return $this->render('search/search.html.twig', [
            'petKinds' => $petKinds,
//            'petsByName' => $petsByName,
//            'petsByKind' => $petsByKind,
//            'petsByNameAndKind' => $petsByNameAndKind
        ]);
    }

    public function showResult(Request $request, AddPetsRepository $addPetsRepository){
        $petsByName = [];
        $petsByKind = [];
        $petsByNameAndKind = [];


        if ($request->query->get('petName') != '' && $request->query->get('petKind') != '') {
            $petName = $request->query->get('petName');
            $petKind = $request->query->get('petKind');
            $petsByNameAndKind = $addPetsRepository->findPetByKindAndName($petName, $petKind);
        } elseif ($request->query->get('petName') != '') {
            $petsByName = $this->addPetsRepository->findPetByName($request->query->get('petName'));
        } elseif ($request->query->get('petName') == '' && $request->query->get('petKind') != '') {
            $petsByKind = $this->addPetsRepository->findPetByKind($request->query->get('petKind'));
        }

        return $this->render('search/showResult.htm.twig', [
            'petsByName' => $petsByName,
            'petsByKind' => $petsByKind,
            'petsByNameAndKind' => $petsByNameAndKind
        ]);
    }
}

