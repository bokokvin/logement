<?php

namespace BK\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BKPlatformBundle:Default:index.html.twig');
    }
}
