<?php
namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Company")
 */


class Company
{	

//----------------Atributos----------------

	//------------Id-------------
	/**
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 */
	protected $id;

	//---------------Name----------


	/**
	 * @ORM\Column(type="string" , length=100) 
	 */
	protected $name;


//----------------Metodos--------------------

	//-------------ID------------
	public function getId()
    {
        return $this->id;
    }

    //--------------Name---------
    public function getName()
    {
    	return $this->name;
    }
    public function setName($name)
    {
    	$this->name = $name;
    }

    public function __toString()
    {
    	return $this->name;
    }

}