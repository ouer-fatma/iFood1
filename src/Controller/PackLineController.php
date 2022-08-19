<?php

namespace App\Controller;

use App\Entity\PackLine;
use App\Form\PackLineType;
use App\Repository\PackLineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pack/line")
 */
class PackLineController extends AbstractController
{
    /**
     * @Route("/index", name="app_pack_line_index", methods={"GET"})
     */
    public function index(PackLineRepository $packLineRepository): Response
    {
        return $this->render('pack_line/index.html.twig', [
            'pack_lines' => $packLineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pack_line_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PackLineRepository $packLineRepository): Response
    {
        $packLine = new PackLine();
        $form = $this->createForm(PackLineType::class, $packLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packLineRepository->add($packLine);
            return $this->redirectToRoute('app_pack_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pack_line/new.html.twig', [
            'pack_line' => $packLine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pack_line_show", methods={"GET"})
     */
    public function show(PackLine $packLine): Response
    {
        return $this->render('pack_line/show.html.twig', [
            'pack_line' => $packLine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pack_line_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PackLine $packLine, PackLineRepository $packLineRepository): Response
    {
        $form = $this->createForm(PackLineType::class, $packLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packLineRepository->add($packLine);
            return $this->redirectToRoute('app_pack_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pack_line/edit.html.twig', [
            'pack_line' => $packLine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pack_line_delete", methods={"POST"})
     */
    public function delete(Request $request, PackLine $packLine, PackLineRepository $packLineRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packLine->getId(), $request->request->get('_token'))) {
            $packLineRepository->remove($packLine);
        }

        return $this->redirectToRoute('app_pack_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
