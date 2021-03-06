<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route ("/register", name="app_register")
     */
    public function register(EntityManagerInterface $em, Request $request)
    {
    $user = new User();
    $user->setRoles(["ROLE_USER"]);
    $registerForm = $this->createForm(RegisterType::class, $user);
    if($registerForm->isSubmitted() && $registerForm->isValid())
    {
        $registerForm->handleRequest($request);
        $em->persist($user);
        $em->flush();
        $this->addFlash("success", "Welcome !");
        $this->redirectToRoute("home");
    }

    return $this->render("/security/register.html.twig", [
        "registerForm"=>$registerForm->createView()
    ]);
    }

}
