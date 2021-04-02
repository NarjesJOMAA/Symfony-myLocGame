<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Entity\User;
use App\Entity\Biens;
use App\Form\AddingType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function session(Request $request): Response
    {
        $session="/session";
        $em = $this->getDoctrine()->getManager();

        $user = $this->getuser();

        
        if (!empty($user)) {
            
            $bien = $user -> getBien();
            $pret = $user -> getPrets();
            $points = $user->getPoints();

            
            $newBien = new Biens;

            $form = $this->createForm(AddingType::class, $newBien);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $newBien = $form -> getData();
                $newBien -> setProprietaire($user);
                $em->persist($newBien);
                $em->flush();
                return $this->redirectToRoute('index');
            }
            return $this->render('session/session.html.twig', [
                'biens' => $bien,
                'prets' => $pret,
                'session' => $session,
                'form' =>$form->createView(),
                'points' => $points
            ]);
    
        } else {
            return $this->render('login.html.twig');
        }
    }
}
