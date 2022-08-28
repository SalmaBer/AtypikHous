<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Reservation;
use App\Form\Admin\ReservationType;
use App\Repository\Admin\ReservationRepository;
use App\Repository\Admin\RoomRepository;
use App\Repository\HotelRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/{slug}", name="admin_reservation_index", methods={"GET"})
     */
    public function index($slug,ReservationRepository $reservationRepository,RoomRepository $roomRepository, UserRepository $userRepository,HotelRepository $hotelRepository): Response
    {
        $users=$userRepository->findAll();
        $hotels=$hotelRepository->findAll();
        $rooms=$roomRepository->findAll();
        $reservations=$reservationRepository->findBy(array('status' => $slug),['id'=>'DESC']);
        return $this->render('admin/reservation/index.html.twig', [
            'reservations' => $reservations,
            'users' => $users,
            'hotels' => $hotels,
            'rooms' => $rooms,
        ]);
    }

    /**
     * @Route("/new", name="admin_reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_reservation_index');
        }

        return $this->render('admin/reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="admin_reservation_show", methods={"GET"})
     */
    public function show($id, ReservationRepository  $reservationRepository,RoomRepository $roomRepository, UserRepository $userRepository,HotelRepository $hotelRepository): Response
    {
        $users=$userRepository->findAll();
        $hotels=$hotelRepository->findAll();
        $rooms=$roomRepository->findAll();
        $reservation=$reservationRepository->findBy(array('id' => $id));
        return $this->render('admin/reservation/show.html.twig', [
            'reservation' => $reservation,
            'users' => $users,
            'hotels' => $hotels,
            'rooms' => $rooms,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $status = $form['status']->getData();
            return $this->redirectToRoute('admin_reservation_index',['slug'=>$status]);
        }

        return $this->render('admin/reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_reservation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_reservation_index');
    }
}
