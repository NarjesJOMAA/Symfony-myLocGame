<?php

namespace App\Controller;
use App\Entity\Biens;
use App\Entity\Prets;
use App\Entity\Categories;
use App\Form\ReserveType;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SingleController extends AbstractController
{
    /**
     * @Route("/single/{nom}/{id}", name="single")
     */
    public function single($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categories::class)->findAll();

        $single ="/single";

        $user = $this->getuser();

        $newPret = new Prets;
        $form = $this->createForm(ReserveType::class, $newPret);
        $form->handleRequest($request);

        $bien = $em->getRepository(Biens::class)->findOneBy([
            'id' => $id
        ]);
        //soldes de points 
        $proprio = $bien->getProprietaire();
        $points = $proprio->getPoints();
        $point = $points + 1;
        //Les dates des prets
        $getPrets = $bien -> getPrets();
        $date = array();
        $arrayDates = array();
        foreach($getPrets as $getPret){

            $start = $getPret -> getDateDebut(); 
            $end = $getPret -> getDateFin();
            $date['startDate'] = $start ->format('Y-m-d');
            $date['endDate'] = $end ->format('Y-m-d');
            array_push($arrayDates, $date);
        }
        //Formulaire
        if ($form->isSubmitted() && $form->isValid()){

            $newPret = $form->getData();
            $newPret -> setEmprunteur($user);
            $newPret -> setBien($bien);
            $proprio -> setPoints($point);
            $em = $this->getDoctrine()->getManager();
            $em->persist($newPret);
            $em->flush();
            return $this-> redirect($this->generateUrl('session'));
        }

        return $this->render('single/single.html.twig', [
            'bien' => $bien,
            'categories' => $categories,
            'form' => $form->createView(),
            'single' => $single,
            'arrayDates' => $arrayDates,
            'points' => $points
        ]);

    }
}
