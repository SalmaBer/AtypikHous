<?php

namespace App\Controller;
use App\Entity\Admin\Messages;
use App\Entity\Hotel ;
use App\Entity\Setting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SitemapControllerPhpController extends AbstractController
{
    /**
     * @Route("/sitemap", name="sitemap", defaults={"_format"="xml"})
     */
    public function showAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $urls = array();
        $hostname = $request->getSchemeAndHttpHost();

        // add static urls
        $urls[] = array('loc' => $this->generateUrl('home'));
        $urls[] = array('loc' => $this->generateUrl('home_contact'));
        $urls[] = array('loc' => $this->generateUrl('activites'));
        $urls[] = array('loc' => $this->generateUrl('home_about'));
        $urls[] = array('loc' => $this->generateUrl('habitat'));
        $urls[] = array('loc' => $this->generateUrl('user_chambre'));
        $urls[] = array('loc' => $this->generateUrl('user_index'));
        $urls[] = array('loc' => $this->generateUrl('user_comments'));
        $urls[] = array('loc' => $this->generateUrl('user_hotels'));
        $urls[] = array('loc' => $this->generateUrl('user_reservations'));
        // add dynamic urls, like blog posts from your DB
        foreach ($em->getRepository(Hotel::class)->findAll() as $post) {
            $urls[] = array(
                'loc' => $this->generateUrl('user_hotel_show', array('id' => $post->getId()))
            );
        }



        // return response in XML format
        $response = new Response(
            $this->renderView('sitemap/sitemap.html.twig', array( 'urls' => $urls,
                'hostname' => $hostname)),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;

    }

}
