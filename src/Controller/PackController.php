<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Form\PackType;
use App\Repository\PackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pack")
 */
class PackController extends AbstractController
{
    /**
     * @Route("/", name="app_pack_index", methods={"GET"})
     */
    public function index(PackRepository $packRepository): Response
    {
        return $this->render('pack/index.html.twig', [
            'packs' => $packRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pack_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PackRepository $packRepository): Response
    {
        $pack = new Pack();
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packRepository->add($pack);
            return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pack/new.html.twig', [
            'pack' => $pack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pack_show", methods={"GET"})
     */
    public function show(Pack $pack): Response
    {
        return $this->render('pack/show.html.twig', [
            'pack' => $pack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pack_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pack $pack, PackRepository $packRepository): Response
    {
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packRepository->add($pack);
            return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pack/edit.html.twig', [
            'pack' => $pack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pack_delete", methods={"POST"})
     */
    public function delete(Request $request, Pack $pack, PackRepository $packRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pack->getId(), $request->request->get('_token'))) {
            $packRepository->remove($pack);
        }

        return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
    }
}
