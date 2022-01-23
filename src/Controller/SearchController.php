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

    public function adverts(AdvertsRepository $advertsRepository, PaginatorInterface $paginator, Request $request)
    {
        $adverts = $advertsRepository->findAll();
        $adverts = $paginator->paginate(
            $adverts,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('pages/adverts.html.twig', ['adverts' => $adverts]);
    }

    /**
     * @Route("/advert/{id<\d+>}", name="advert-info")
     */
    public function advertInfo(
        int $id,
        AdvertsRepository $advertsRepository
    )
    {

        $advert = $advertsRepository->findOneBy(['id' => $id]);

        if (!$advert) {
            return $this->redirectToRoute('adverts');
        }
        return $this->render('pages/product.html.twig', ['advert' => $advert]);
    }

}
