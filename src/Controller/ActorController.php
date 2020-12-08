<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actor", name="actor_")
 */
class ActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findAll();

        return $this->render('actor/index.html.twig', [
            'actors' => $actors,
        ]);
    }

    /**
     * Getting an actor by id
     *
     * @Route("/show/{actor_id<^[0-9]+$>}", name="show")
     * @ParamConverter("actor", class="App\Entity\Actor", options={"mapping": {"actor_id": "id"}})
     * @param Actor $actor
     * @return Response
     */

    public function show(Actor $actor):Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render('actor/show.html.twig', [
            'actors' => $actor,
            'programs' => $program,
        ]);
    }
}
