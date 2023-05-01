<?php

namespace App\Controller;

use App\Entity\AddPets;
use App\Form\AddPetsType;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddPetsController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function addPets(Request $request): Response{
         $form=$this->createForm(AddPetsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $pet = new AddPets();
            $pet->setCreatedAt(new DateTimeImmutable('now'));
            $pet->setName($data->getName());
            $pet->setPetKind($data->getPetKind());
            $pet->setPetInfo($data->getPetInfo());

                $em->persist($pet);
                $em->flush();
            return $this->redirect($this->generateUrl('added'));
        }

        //return a response
        return $this->render('add_pets/addPets.html.twig', [
            'form'=>$form->createView()
        ]);
    }

//    /**
//     * @Route("/show/{id}", name="show")
//     * @param Post $post
//     * @return Response
//     */
//    public function show(Post $post){
//        //create the show view
//        return $this->render('post/show.html.twig', [
//            'post'=>$post
//        ]);
//    }
//
//    /**
//     * @Route("/delete/{id}", name="delete")
//     * @param Post $post
//     */
//    public function remove(Post $post){
//
//        $em=$this->getDoctrine()->getManager();
//        $em->remove($post);
//        $em->flush();
//
//        $this->addFlash('success', 'The post was removed');
//
//        return $this->redirect($this->generateUrl('post.index'));
//    }
}
