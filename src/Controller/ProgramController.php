<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/programs", name="program_")
 */
Class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * Getting a program by id
     *
     * @Route("/show/{id<^[0-9]+$>}", name="show")
     * @param int $id
     * @return Response
     */
    public function show(int $id):Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $id]);

        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findAll();

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    /**
     * Getting a program and season by id
     *
     * @Route("/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}", methods={"GET"}, name="season_show")
     * @return Response
     */

    public function showSeason(int $programId, int $seasonId): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $programId]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$programId.' found in program\'s table.'
            );
        }

        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['program' => $programId, 'id' => $seasonId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : '.$seasonId.' found for program with id ' .$programId.' in season\'s table.'
            );
        }

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }
}
