<?php

namespace App\Controller;

use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Ad;



class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     * @param AdRepository $adRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdRepository $adRepository)
    {
        $ads = $adRepository->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * @Route("/ads/new", name="ads_create")
     *
     * @param Ad|null $ad
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     * @throws \Exception
     */
    public function create(Ad $ad = null, Request $request, ObjectManager $manager)
    {
        $ad = new Ad();

        $form = $this->createForm(AnnonceType::class, $ad);

        // HandleRequest Permet d analyser la requete http, il analyse si le form a bien été soumis,
        //si tout les champs sont bien remplis, il va binder les valeurs.
        $form->handleRequest($request);

        // Si le form a été soumis et que tout les champs sont OK alors on veux enregistrer les données du nouveau produit
        // la méthode en dessous permet de le faire.
        if ($form->isSubmitted() && $form->isValid()) {

            // persisster l article FIXTURES
            $manager->persist($ad);

            // balancer la requete
            $manager->flush();
            // redirige moi sur laroute qui s appelle blog_show, voir le produit $produit->getId
            return $this->redirectToRoute('ads_show', [
                'id' => $ad->getId()
            ]);
        }

        return $this->render('ad/new.html.twig', [

            'formAnnonce' => $form->createView()
        ]);

    }

    /**
     * Permet d afficher une seule annonce
     * @Route("/ads/{slug}", name="ads_show")
     *
     * @return Response
     */

    public function show(Ad $ad)
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

}
