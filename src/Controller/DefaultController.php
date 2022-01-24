<?php


namespace App\Controller;

use App\Entity\Favorites;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FavoritesRepository;
use App\Repository\AdvertsRepository;




class DefaultController extends AbstractController
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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

    public function profile(AdvertsRepository $advertsRepository,FavoritesRepository $favoritesRepository)
    {

        $userAdverts=$advertsRepository->findBy(['user'=>$this->getUser()]);
        $userFavorites=$favoritesRepository->findBy(['user'=>$this->getUser()]);
        return $this->render('pages/profile.html.twig',['adverts'=>$userAdverts,'favorites'=>$userFavorites]);

    }







}
