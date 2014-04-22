<?php

namespace TGC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TGC\AdminBundle\Entity\User;

use TGC\AdminBundle\Entity\Project;
use TGC\AdminBundle\Form\ProjectType;
use TGC\AdminBundle\Form\ProjectsearchType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Dashboard controller.
 *
 */

class DashboardController extends Controller
{

    /**
     * Generates a Dashboard view for Consultants and Businesses
     *
     */
    public function indexAction()
    {

        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            
            // show stuff for consultant
            return $this->redirect($this->generateUrl('user'));

        } elseif ($this->get('security.context')->isGranted('ROLE_BUSINESS')) {
        	
            // show stuff for business
            return $this->redirect($this->generateUrl('project'));

        } elseif ($this->get('security.context')->isGranted('ROLE_CONSULTANT') || 
                  $this->get('security.context')->isGranted('ROLE_CLUB')) {

            // show stuff for consultant
            return $this->redirect($this->generateUrl('fos_user_profile_show'));

        } else {
			
            // logout & show login view
            return $this->redirect($this->generateUrl('logout'));
    	
        }
    }
}