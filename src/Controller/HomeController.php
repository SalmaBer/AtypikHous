<?php

namespace App\Controller;

use App\Entity\Admin\Messages;
use App\Entity\Hotel;
use App\Entity\Setting;
use App\Form\Admin\MessagesType;
use App\Repository\Admin\CommentRepository;
use App\Repository\Admin\RoomRepository;
use App\Repository\HotelRepository;
use App\Repository\ImageRepository;
use App\Repository\SettingRepository;
use Symfony\Component\HttpFoundation\Request;
use PhpParser\Node\Expr\BinaryOp\NotEqual;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Bridge\Google\Smtp\GmailTransport;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, SettingRepository $settingRepository,HotelRepository $hotelRepository)
    {
        $setting=$settingRepository->findAll();
        $slider=$hotelRepository->findBy(['status'=>'True'],['title'=>'ASC'] ,3);
        $hotels=$hotelRepository->findBy(['status'=>'True'],['title'=>'DESC'] ,6);
        $newhotels=$hotelRepository->findBy(['status'=>'True'],['title'=>'DESC'] ,10);
        // array findBy(array $criteria, array $orderBy = null, int|null $limit = null, int|null $offset = null)
        //dump($slider);
        //die();

        $session = $request->getSession();

       $id= $session->get('idC');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'setting'=>$setting,
            'slider'=>$slider,
            'hotels'=>$hotels,
            'cook'=>$id,
            'newhotels'=>$newhotels,
        ]);
    }

    /**
 * @Route("/hotel/{id}", name="hotel_show", methods={"GET"})
 */
    public function show(Hotel $hotel,$id,ImageRepository $imageRepository,CommentRepository $commentRepository, RoomRepository $roomRepository): Response
    {
        $images=$imageRepository->findBy(['hotel'=>$id]);
        $comments=$commentRepository->findBy(['hotelid'=>$id, 'status'=>'True']);
        $rooms =$roomRepository->findBy(['hotelid'=>$id, 'status'=>'True']);

        return $this->render('home/hotelshow.html.twig', [
            'hotel' => $hotel,
            'images' => $images,
            'rooms' => $rooms,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/about", name="home_about")
     */
    public function about(SettingRepository $settingRepository): Response
    {
        $setting=$settingRepository->findAll();
        return $this->render('home/aboutus.html.twig', [
            'setting'=>$setting,

        ]);
    }
    /**
     * @Route("/activites", name="activites")
     */
    public function activites(SettingRepository $settingRepository): Response
    {
        return $this->render('home/activites.html.twig', [
            'setting'=>$setting,

        ]);
    }

    /**
     * @Route("/contact", name="home_contact", methods={"GET","POST"})
     */
    public function contact(SettingRepository $settingRepository,Request $request): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');

        $setting=$settingRepository->findAll(); // Get setting data
       // echo $setting[0]->getTitle();
       // dump($setting);
       // die();

        if ($form->isSubmitted()) {
            // if ($this->isCsrfTokenValid('form-reservation', $submittedToken)) {
                $entityManager = $this->getDoctrine()->getManager();
                $message->setStatus('New');
                $message->setIp($_SERVER['REMOTE_ADDR']);
                $entityManager->persist($message);
                $entityManager->flush();
                $this->addFlash('success', '');

                //********** SEND EMAIL ***********************>>>>>>>>>>>>>>>
                // $email = (new Email())
                //     ->from($setting[0]->getSmtpemail())
                //     ->to($form['email']->getData())
                //     //->cc('cc@example.com')
                //     //->bcc('bcc@example.com')
                //     //->replyTo('fabien@example.com')
                //     //->priority(Email::PRIORITY_HIGH)
                //     ->subject('AllHoliday Your Request')
                //     //->text('Simple Text')
                //     ->html("Dear ". $form['name']->getData() ."<br>
                //                  <p>We will evaluate your requests and contact you as soon as possible</p> 
                //                  Thank You for your message<br> 
                //                  =====================================================
                //                  <br>".$setting[0]->getCompany()."  <br>
                //                  Address : ".$setting[0]->getAddress()."<br>
                //                  Phone   : ".$setting[0]->getPhone()."<br>"
                //     );

                // $transport = new GmailTransport($setting[0]->getSmtpemail(), $setting[0]->getSmtppassword());
                // $mailer = new Mailer($transport);
                // $mailer->send($email);

                //<<<<<<<<<<<<<<<<********** SEND EMAIL ***********************
                return $this->redirectToRoute('home_contact');
            // }
        }

        return $this->render('home/contact.html.twig', [
            'setting'=>$setting,
            'form' => $form->createView(),
        ]);
    }
    /**
      * @Route("/sitemap", name="sitemap", defaults={"_format"="xml"})
     */
    public function sitemap(Request $request ): Response
    {
        // Récupérer le nom d'hôte
        $hostname = $request->getSchemeAndHttpHost();
        
        // On initialise un tableau pour lister les URL
        $urls = [];
        
        // On ajoute les URLs statiques
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('home_contact')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        
        // On ajoute les URLs dynamiques
        

        // Fabriquer la réponse
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname
                ]),
                200
            );
            
            
            // Ajout des entêtes
            $response->headers->set('Content-Type', 'text/xml');
            
            // Envoyer la réponse
            return $response;
        }
 }
