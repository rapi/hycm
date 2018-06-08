<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function adminAction(Request $request)
    {
        $usr= $this->get('security.context')->getToken()->getUser();
        $language=$usr->getLanguage();;
        $this->get('translator')->setLocale($language);
        $text= $this->get('translator')->trans('Hello');
        return new Response($text);
    }
}