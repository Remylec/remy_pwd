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
