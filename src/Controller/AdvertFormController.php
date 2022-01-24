<?php

namespace App\Controller;

use App\Form\AdvertFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adverts;

class AdvertFormController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/addavert", name="advert_form")
     */
    public function advert(Request $request)
    {
            $advert = new Adverts();
            $advertForm = $this->createForm(AdvertFormType::class, $advert);
            $advertForm->handleRequest($request);
            if ($advertForm->isSubmitted() && $advertForm->isValid()){
                $data=$advertForm->getData();
                $data->setUser($this->getUser());
                $data->setBought(false);
                $this->em->persist($data);
                $this->em->flush();
                return $this->redirectToRoute('adverts');

            }
            return $this->render('pages/advertForm.html.twig',[
                'formAdvert'=> $advertForm->createView()
            ]);
    }}

