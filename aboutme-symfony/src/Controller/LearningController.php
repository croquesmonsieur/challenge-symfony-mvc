<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LearningController extends AbstractController
{

    private string $name;
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {

        $this->session = $session;
        $session->start();
    }


    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'name' => 'Unknown',
        ]);
    }

    #[Route('/about-becode', name: 'aboutMe')]
    public function aboutMe(): Response
    {
        $this->name = $this->session->get('user_name', 'Unknown');
        return $this->render('learning/index.html.twig', [
            'name' => $this->name,
        ]);
    }

    #[Route('/', name: 'showMyName')]
    public function showMyName(): Response
    {
        $this->name = $this->session->get('user_name', 'Unknown');
        return $this->render('learning/showMyName.html.twig', [
            'name' => $this->name,
        ]);
    }

    #[Route('/changeMyName', name: 'changeMyName')]
    public function changeMyName(): Response
    {
        if (isset($_POST['input_user_name'])) {
            $this->name = $_POST['input_user_name'];
            $this->session->set('user_name', $this->name);
        }


        return $this->redirectToRoute('showMyName');
    }

}
