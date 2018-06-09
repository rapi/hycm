<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // get user language
        $entityManager = $this->getDoctrine()->getManager();
        $lastUser=$entityManager->getRepository('AppBundle\Entity\User')->findBy(['username'=>$lastUsername]);
        if(count($lastUser)>0)
            $this->get('translator')->setLocale($lastUser[0]->getLanguage());
        if($lastUsername)    
             $error= $this->get('translator')->trans('Wrong details');
        else
            $error=false;
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}