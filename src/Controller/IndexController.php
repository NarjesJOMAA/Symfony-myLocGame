<?php

namespace App\Controller;
use App\Entity\Biens;
use App\Entity\User;
use App\Entity\Categories;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $biens= $em->getRepository(Biens::class)->findAll();
        $categories = $em->getRepository(Categories::class)->findAll();

        $userCheck = $this->getuser();


            if (empty($userCheck)) {
                $user = new User;
                $form = $this->createForm(RegistrationType::class, $user);
                $form->handleRequest($request);        

                if ($form->isSubmitted() && $form->isValid()){

                    $hash = $encoder->encodePassword($user, $form->get('password')->getData());

                    $user ->setPassword($hash);
                    $user->setPoints(0);

                    $newUser = $form->getData();
                    dump($user);
                    $em->persist($newUser);

                    $em->flush();
                    return $this->redirect($this->generateUrl('usr_login'));
                };
                return $this->render('base.html.twig', [
                    'form' => $form->createView(),
                    'categories' => $categories,
                ]);
            }else{
                $points = $userCheck->getPoints();

                return $this->render('index/index.html.twig', [
                    'biens' => $biens,
                    'categories' => $categories,
                    'points' => $points

                ]);                
            }
    }

    /**
     * @Route("/login", name="usr_login")
     */
    public function login()
    {
        return $this->render('login.html.twig');
    }

    /**
     * @Route("/logout", name="usr_logout")
     */
    public function logout()
    {

    }


}
