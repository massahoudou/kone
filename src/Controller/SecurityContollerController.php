<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityContollerController extends AbstractController
{
    private $userRepository;
    private $manager;
    public function __construct(UsersRepository  $userRepository,EntityManagerInterface $managerInterface)
    {
        $this->userRepository = $userRepository;
        $this->manager = $managerInterface;
    }
    /**
     * @Route("/", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->userRepository->findOneBy(['username' => 'admin']);

        if (!$user)
        {
            $user = new Users() ;
            $user->setUsername('admin');
              $user->setPassword(123456);
                $user->setEmail('admin@gmail.com');
            $this->manager->persist($user);
            $this->manager->flush();

        }
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityContollerController',
            'error' => $error ,
            'last_username' => $lastUsername,
        ]);
    }

    /**
     * @Route("/logout",name="logout")
     */
    public function logout()
    {}

    /**
     *  @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('admin/index.html.twig');
    }
    
}
