<?php

namespace Teste\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Exe_formController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('TesteBundle:Exe_form:index.html.twing');


    }
}	
