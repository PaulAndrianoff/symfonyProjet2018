<?php

namespace App\Controller;

use App\Entity\Wishe;
use App\Form\WisheType;
use App\Repository\WisheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wishe")
 */
class WisheController extends Controller
{
    /**
     * @Route("/", name="wishe_index", methods="GET")
     */
    public function index(WisheRepository $wisheRepository): Response
    {
        return $this->render('wishe/index.html.twig', ['wishes' => $wisheRepository->findAll()]);
    }

    /**
     * @Route("/new", name="wishe_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $wishe = new Wishe();
        $form = $this->createForm(WisheType::class, $wishe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wishe);
            $em->flush();

            return $this->redirectToRoute('wishe_index');
        }

        return $this->render('wishe/new.html.twig', [
            'wishe' => $wishe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wishe_show", methods="GET")
     */
    public function show(Wishe $wishe): Response
    {
        return $this->render('wishe/show.html.twig', ['wishe' => $wishe]);
    }

    /**
     * @Route("/{id}/edit", name="wishe_edit", methods="GET|POST")
     */
    public function edit(Request $request, Wishe $wishe): Response
    {
        $form = $this->createForm(WisheType::class, $wishe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wishe_edit', ['id' => $wishe->getId()]);
        }

        return $this->render('wishe/edit.html.twig', [
            'wishe' => $wishe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wishe_delete", methods="DELETE")
     */
    public function delete(Request $request, Wishe $wishe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wishe->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wishe);
            $em->flush();
        }

        return $this->redirectToRoute('wishe_index');
    }
}
