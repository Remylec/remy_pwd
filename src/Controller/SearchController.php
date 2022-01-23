<?php

namespace App\Controller;

use App\Entity\Adverts;
use App\Entity\Favorites;
use App\Repository\AdvertsRepository;
use App\Repository\FavoritesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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

    /**
     * @Route("/advert/{id<\d+>}/fav", name="fav")
     */
    public function test(int $id, Adverts $advert, FavoritesRepository $favoritesRepository)
    {
        $user = $this->getUser();

        if (!$user) return $this->json([
            'code' => 403,
            'message' => 'Vous devez être connecté'
        ], 403);
        if($advert->isFavByUser($user)){
            $target = $favoritesRepository->findOneBy(['user'=>$user,'advert'=>$advert]);

            $this->em->remove($target);
            $this->em->flush();

            return $this->json([
                    'code' => 200,
                    'message' => 'Favori désélectionné',
                ]
            );
        }else{
            $fav = new Favorites();
            $fav->setUser($user)
                ->setAdvert($advert);

            $this->em->persist($fav);
            $this->em->flush();

            return $this->json([
                'code' => 200,
                'message' => 'Favori sélectionné',
            ]);
        }
    }

}
