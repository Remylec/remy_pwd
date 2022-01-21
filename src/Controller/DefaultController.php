<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/category", name="category")
     */

    public function category()
    {
        return $this->render('pages/category.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */

    public function login()
    {
        return $this->render('pages/login.html.twig');
    }

    /**
     * @Route("/register", name="register")
     */

    public function register()
    {
        return $this->render('pages/register.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     */

    public function profile()
    {
        return $this->render('pages/profile.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function contact()
    {
        return $this->render('pages/contact.html.twig');
    }

    /**
     * @Route("/product", name="product")
     */

    public function product()
    {
        return $this->render('pages/product.html.twig');
    }
}
