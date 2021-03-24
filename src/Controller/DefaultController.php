<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MessageRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findAll();

        $template = 'default/index.html.twig';
        $args = [
            'messages' => $messages
        ];
        return $this->render($template, $args);
    }


    /**
     * @Route("/about", name="about_page")
     */
    public function about(): Response
    {
        $template = 'default/about.html.twig';
        $args = [];
        return $this->render($template, $args);
    }


    /**
     * @Route("/my_messages", name="my_messages")
     */
    public function myMessages(MessageRepository $messageRepository): Response
    {
        $author = $this->getUser();
        $messages = $messageRepository->findByAuthor($author);

        $template = 'default/mymessages.html.twig';
        $args = [
            'messages' => $messages
        ];
        return $this->render($template, $args);
    }


}
