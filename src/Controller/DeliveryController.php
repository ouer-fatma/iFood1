<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Form\DeliveryType;
use App\Repository\DeliveryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Reclamation;
use App\Entity\Utilisateur;
use App\Entity\Command;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Twilio\Rest\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/delivery")
 */
class DeliveryController extends AbstractController
{
    /**
     * @Route("/trahnchouf", name="deliverychof")
     * @Method("GET")
     */
    public function allRecAction(EntityManagerInterface $entityManager)
    {

        $delivery = $this->getDoctrine()->getManager()->getRepository(Delivery::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($delivery);

        return new JsonResponse($formatted);

    }
    /**
     * @Route("/addDileevry", name="xxxss")
     * @Method("POST")
     */

    public function ajouterrDelivery(Request $request,EntityManagerInterface $entityManager)
    {
        $delivery= new Delivery();
        $lang = $request->query->get("lang");
        $attitude = $request->query->get("attitude");
        $price = $request->query->get("price");
        $idGuy=$request->query->get("idGuy");


        $user=$entityManager->getRepository(Utilisateur::class)->find($idGuy);

        $em = $this->getDoctrine()->getManager();



        $delivery->setLang($lang);
        $delivery->setAttitude($attitude);
        $delivery->setPrice($price);
        $delivery->setDeliveryGuy($user);


        $em->persist($delivery);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($delivery);
        return new JsonResponse($formatted);

    }


    /**
     * @Route("/deleteReclamation", name="aeaeae")
     * @Method("DELETE")
     */

    public function deleteReclamationAction(Request $request) {
        $id = $request->get("id");

        $em = $this->getDoctrine()->getManager();
        $delivery = $em->getRepository(Delivery::class)->find($id);
        if($delivery!=null ) {
            $em->remove($delivery);
            $em->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Reclamation a ete supprimee avec success.");
            return new JsonResponse($formatted);

        }
        return new JsonResponse("id delivery invalide.");


    }
    /**
     * @Route("/updateReclamation", name="xaaxxxxaqqqq")
     * @Method("PUT")
     */
    public function modifierReclamationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $delivery = $this->getDoctrine()->getManager()
            ->getRepository(Delivery::class)
            ->find($request->get("id"));


        $delivery->setLang ($request->get("lang"));
        $delivery->setAttitude ($request->get("attitude"));
        $delivery->setPrice ($request->get("price"));


        $em->persist($delivery);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($delivery);
        return new JsonResponse("delivery a ete modifiee avec success.");


    }
    /**
     * @Route("/", name="app_delivery_index", methods={"GET"})
     */
    public function index(DeliveryRepository $deliveryRepository): Response
    {
        return $this->render('delivery/index.html.twig', [
            'deliveries' => $deliveryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_delivery_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DeliveryRepository $deliveryRepository): Response
    {
        $delivery = new Delivery();
        $form = $this->createForm(DeliveryType::class, $delivery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deliveryRepository->add($delivery);
            return $this->redirectToRoute('app_delivery_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('delivery/new.html.twig', [
            'delivery' => $delivery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_delivery_show", methods={"GET"})
     */
    public function show(Delivery $delivery): Response
    {
        return $this->render('delivery/show.html.twig', [
            'delivery' => $delivery,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_delivery_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Delivery $delivery, DeliveryRepository $deliveryRepository): Response
    {
        $form = $this->createForm(DeliveryType::class, $delivery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deliveryRepository->add($delivery);
            return $this->redirectToRoute('app_delivery_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('delivery/edit.html.twig', [
            'delivery' => $delivery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_delivery_delete", methods={"POST"})
     */
    public function delete(Request $request, Delivery $delivery, DeliveryRepository $deliveryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$delivery->getId(), $request->request->get('_token'))) {
            $deliveryRepository->remove($delivery);
        }

        return $this->redirectToRoute('app_delivery_index', [], Response::HTTP_SEE_OTHER);
    }

    public function articlesParCategorie(Request $request) {
        $categorySearch = new CategorySearch();
        $form = $this->createForm(CategorySearchType::class,$categorySearch);
        $form->handleRequest($request);

        $articles= [];

        if($form->isSubmitted() && $form->isValid()) {
            $category = $categorySearch->getCategory();

            if ($category!="")
            {

                $articles= $category->getArticles();
                // ou bien
                //$articles= $this->getDoctrine()->getRepository(Article::class)->findBy(['category' => $category] );
            }
            else
                $articles= $this->getDoctrine()->getRepository(Article::class)->findAll();
        }

        return $this->render('articles/articlesParCategorie.html.twig',['form' => $form->createView(),'articles' => $articles]);
    }

}





