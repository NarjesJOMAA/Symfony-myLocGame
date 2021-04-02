<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Form\RegistrationType;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{nom}", name="category")
     */
    public function index($nom, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getuser();
        $points = $user->getPoints();

        $category= $em->getRepository(Categories::class)->findOneBy([
            'nom' => $nom,
        ]);
        $categories = $em->getRepository(Categories::class)->findAll();
        return $this->render('category/category.html.twig', [
            'categories' => $categories,
            'biens' => $category -> getBien(),
            'points' => $points
        ]);

    }
}
