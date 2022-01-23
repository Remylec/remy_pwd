<?php

namespace App\Controller;

use App\Entity\Adverts;
use App\Entity\Favorites;
use App\Repository\AdvertsRepository;
use App\Repository\FavoritesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        int $id, AdvertsRepository $advertsRepository, Request $request
    )
    {
        $form = $this->createFormBuilder()
            ->add('button', SubmitType::class, ['label' => 'acheter'])
            ->getForm();

        $form->handleRequest($request);
        $target = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get('advertId');
            $target = $advertsRepository->findOneBy(['id' => intval($data)]);
            $target->setBought(true);
            if (count($target->getFavorites()->getValues()) > 0) {
                foreach ($target->getFavorites()->getValues() as $fav) {
                    if ($fav->getAdvert()->getId() === $target->getId() && $fav->getUser()->getId() === $this->getUser()->getId()) {
                        $this->em->remove($fav);
                    }
                }
            }
            $this->em->persist($target);
            $this->em->flush();
            return $this->redirectToRoute('adverts');

        }

        $advert = $advertsRepository->findOneBy(['id' => $id]);

        if (!$advert) {
            return $this->redirectToRoute('adverts');
        } else {
            if ($advert->getBought()) {
                return $this->redirectToRoute('adverts');
            }
        }
        return $this->render('pages/product.html.twig', ['advert' => $advert, 'form' => $form->createView()]);
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
        if ($advert->isFavByUser($user)) {
            $target = $favoritesRepository->findOneBy(['user' => $user, 'advert' => $advert]);

            $this->em->remove($target);
            $this->em->flush();

            return $this->json([
                    'code' => 200,
                    'message' => 'Favori désélectionné',
                ]
            );
        } else {
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
