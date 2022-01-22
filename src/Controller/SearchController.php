<?php

namespace App\Controller;

use App\Repository\AdvertsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/adverts", name="adverts")
     */

    public function adverts(AdvertsRepository $advertsRepository,PaginatorInterface $paginator,Request $request)
    {
        $adverts=$advertsRepository->findAll();
        $adverts = $paginator->paginate(
            $adverts,
            $request->query->getInt('page',1),
            6
        );
        return $this->render('pages/adverts.html.twig',['adverts'=>$adverts]);
    }
}
