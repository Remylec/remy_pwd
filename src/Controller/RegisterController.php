<?php


namespace App\Controller;

use App\Entity\User;
use App\form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(
        Request $request,
        UserPasswordHasherInterface $encoder
    )
    {
        $user=new User();
        $registerForm=$this->createForm(RegisterFormType::class,$user);
        $registerForm->handleRequest($request);
        if($registerForm->isSubmitted() && $registerForm->isValid()){
            if($registerForm->get('password')->getData()){
                $user->setPassword($encoder->hashPassword($user, $registerForm->get('password')->getData()));
            }
        }
    }

}
