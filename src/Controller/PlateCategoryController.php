<?php

namespace App\Controller;

use App\Entity\PlateCategory;
use App\Form\PlateCategoryType;
use App\Repository\PlateCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plate/category")
 */
class PlateCategoryController extends AbstractController
{
    /**
     * @Route("/", name="app_plate_category_index", methods={"GET"})
     */
    public function index(PlateCategoryRepository $plateCategoryRepository): Response
    {
        return $this->render('plate_category/index.html.twig', [
            'plate_categories' => $plateCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_plate_category_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PlateCategoryRepository $plateCategoryRepository): Response
    {
        $plateCategory = new PlateCategory();
        $form = $this->createForm(PlateCategoryType::class, $plateCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plateCategoryRepository->add($plateCategory);
            return $this->redirectToRoute('app_plate_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate_category/new.html.twig', [
            'plate_category' => $plateCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_plate_category_show", methods={"GET"})
     */
    public function show(PlateCategory $plateCategory): Response
    {
        return $this->render('plate_category/show.html.twig', [
            'plate_categorie' => $plateCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_plate_category_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PlateCategory $plateCategory, PlateCategoryRepository $plateCategoryRepository): Response
    {
        $form = $this->createForm(PlateCategoryType::class, $plateCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plateCategoryRepository->add($plateCategory);
            return $this->redirectToRoute('app_plate_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate_category/edit.html.twig', [
            'plate_category' => $plateCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_plate_category_delete", methods={"POST"})
     */
    public function delete(Request $request, PlateCategory $plateCategory, PlateCategoryRepository $plateCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plateCategory->getId(), $request->request->get('_token'))) {
            $plateCategoryRepository->remove($plateCategory);
        }

        return $this->redirectToRoute('app_plate_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
