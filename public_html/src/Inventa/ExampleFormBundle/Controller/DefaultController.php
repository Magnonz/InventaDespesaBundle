<?php

namespace Inventa\ExampleFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Inventa\ExampleFormBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    //Pagina Principal
    public function indexAction()
    {

         $select = $this->getDoctrine()->getRepository('InventaExampleFormBundle:Task');
         
         $tarefa=$select->findAll();



        return $this->render('InventaExampleFormBundle:Default:index.html.twig',array ('tarefa'=>$tarefa));
    }
    
    //Pagina Insert(Fazer registos)
    public function insertAction(Request $request)
    {
    	
        //Cria um objecto da Classe "Task"
        $task = new Task();
       
        //Cria uma form
        $form = $this->createFormBuilder($task)
            ->add('task', 'text', array('label'=>'Tarefa'))//Cria uma textbox para texto
            ->add('dueDate', 'datetime', array('label'=>'Para o Dia:'))//Vai criar  dropodown boxs para a data e hora
            ->add('save', 'submit')//Vai Criar Um butão submit
            ->getForm();
            


            $form->handleRequest($request);

            //Se a Form for Valida
            if ($form->isValid())
            {

            //Vai fazer um fetch ?Duvida
		        $em = $this->getDoctrine()->getManager();

            //Prepara a query? duvida
   			    $em->persist($task);

            //Executa a querie, ou seja, vai fazer um insert do objecto Task
   			    $em->flush();

            exit('Sucesso!!');

   			}

        return $this->render('InventaExampleFormBundle:Default:insert.html.twig', array('form' => $form->createView(),

        ));

   			    

    }
    //Pagina do Delete
    public function deleteAction(Request $request)
    {

    }

    //Pagina do Update
      public function updateAction(Request $request)
    {
      
    }
    
}
