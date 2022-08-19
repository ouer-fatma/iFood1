<?php

namespace App\Controller;

use App\Entity\Plate;
use App\Form\PlateType;
use App\Repository\PlateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plate")
 */
class PlateController extends AbstractController
{
    /**
     * @Route("/", name="app_plate_index", methods={"GET"})
     */
    public function index(PlateRepository $plateRepository): Response
    {
        return $this->render('plate/index.html.twig', [
            'plates' => $plateRepository->findAll(),
        ]);
    }
    /**
     * @Route("/range/", name="rangetest", methods={"GET"})
     */
    public function indexs(PlateRepository $plateRepository,Request $request)
    {
        echo ($request->get('id'));
        echo ($request->get('range'));
        return var_dump($request->get('id')) ;
    }

    /**
     * @Route("/new", name="app_plate_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PlateRepository $plateRepository): Response
    {
        $plate = new Plate();
        $form = $this->createForm(PlateType::class, $plate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plateRepository->add($plate);
            return $this->redirectToRoute('app_plate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate/new.html.twig', [
            'plate' => $plate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_plate_show", methods={"GET"})
     */
    public function show(Plate $plate): Response
    {
        return $this->render('plate/show.html.twig', [
            'plate' => $plate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_plate_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Plate $plate, PlateRepository $plateRepository): Response
    {
        $form = $this->createForm(PlateType::class, $plate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plateRepository->add($plate);
            return $this->redirectToRoute('app_plate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate/edit.html.twig', [
            'plate' => $plate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_plate_delete", methods={"POST"})
     */
    public function delete(Request $request, Plate $plate, PlateRepository $plateRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plate->getId(), $request->request->get('_token'))) {
            $plateRepository->remove($plate);
        }

        return $this->redirectToRoute('app_plate_index', [], Response::HTTP_SEE_OTHER);
    }
}
