<?php

namespace App\Controller;

use App\Entity\TeamParticipant;
use App\Form\TeamParticipantType;
use App\Repository\TeamParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/team/participant")
 */
class TeamParticipantController extends Controller
{
    /**
     * @Route("/", name="team_participant_index", methods="GET")
     */
    public function index(TeamParticipantRepository $teamParticipantRepository): Response
    {
        return $this->render('team_participant/index.html.twig', ['team_participants' => $teamParticipantRepository->findAll()]);
    }

    /**
     * @Route("/new", name="team_participant_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $teamParticipant = new TeamParticipant();
        $form = $this->createForm(TeamParticipantType::class, $teamParticipant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($teamParticipant);
            $em->flush();

            return $this->redirectToRoute('team_participant_index');
        }

        return $this->render('team_participant/new.html.twig', [
            'team_participant' => $teamParticipant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_participant_show", methods="GET")
     */
    public function show(TeamParticipant $teamParticipant): Response
    {
        return $this->render('team_participant/show.html.twig', ['team_participant' => $teamParticipant]);
    }

    /**
     * @Route("/{id}/edit", name="team_participant_edit", methods="GET|POST")
     */
    public function edit(Request $request, TeamParticipant $teamParticipant): Response
    {
        $form = $this->createForm(TeamParticipantType::class, $teamParticipant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_participant_edit', ['id' => $teamParticipant->getId()]);
        }

        return $this->render('team_participant/edit.html.twig', [
            'team_participant' => $teamParticipant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_participant_delete", methods="DELETE")
     */
    public function delete(Request $request, TeamParticipant $teamParticipant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teamParticipant->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teamParticipant);
            $em->flush();
        }

        return $this->redirectToRoute('team_participant_index');
    }
}
