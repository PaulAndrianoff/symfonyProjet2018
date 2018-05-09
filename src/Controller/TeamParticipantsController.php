<?php

namespace App\Controller;

use App\Entity\TeamParticipants;
use App\Form\TeamParticipantsType;
use App\Repository\TeamParticipantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/team/participants")
 */
class TeamParticipantsController extends Controller
{
    /**
     * @Route("/", name="team_participants_index", methods="GET")
     */
    public function index(TeamParticipantsRepository $teamParticipantsRepository): Response
    {
        return $this->render('team_participants/index.html.twig', ['team_participants' => $teamParticipantsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="team_participants_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $teamParticipant = new TeamParticipants();
        $form = $this->createForm(TeamParticipantsType::class, $teamParticipant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($teamParticipant);
            $em->flush();

            return $this->redirectToRoute('team_participants_index');
        }

        return $this->render('team_participants/new.html.twig', [
            'team_participant' => $teamParticipant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_participants_show", methods="GET")
     */
    public function show(TeamParticipants $teamParticipant): Response
    {
        return $this->render('team_participants/show.html.twig', ['team_participant' => $teamParticipant]);
    }

    /**
     * @Route("/{id}/edit", name="team_participants_edit", methods="GET|POST")
     */
    public function edit(Request $request, TeamParticipants $teamParticipant): Response
    {
        $form = $this->createForm(TeamParticipantsType::class, $teamParticipant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_participants_edit', ['id' => $teamParticipant->getId()]);
        }

        return $this->render('team_participants/edit.html.twig', [
            'team_participant' => $teamParticipant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_participants_delete", methods="DELETE")
     */
    public function delete(Request $request, TeamParticipants $teamParticipant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teamParticipant->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teamParticipant);
            $em->flush();
        }

        return $this->redirectToRoute('team_participants_index');
    }
}
