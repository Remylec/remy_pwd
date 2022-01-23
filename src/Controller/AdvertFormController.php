<?php

namespace App\Controller;

use App\Form\AdvertFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertFormController extends AbstractController
{
    /**
     * @Route("/contact", name="advert_form")
     */
    public function advert(Request $request)
    {
        if (!$this->getAdvert()) {
            $advert = new Advert();
            $advertForm = $this->createForm(AdvertFormType::class, $advert);
            $advertForm->handleRequest($request);
        }
    }}

