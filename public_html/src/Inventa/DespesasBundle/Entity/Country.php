<?php
namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Country")
 */


class Country
{

//------------------------Atributos-----------------



	//------------Id-------------
	/**
	*
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 */
	protected $id;


	//---------------Alpha 2----------


	/**
	* @ORM\Column(type="string" , length=2) 
	*/
	protected $alpha2;	

	//---------------Alpha 3----------


	/**
	* @ORM\Column(type="string" , length=3) 
	*/
	protected $alpha3;	


	//---------------Name----------


	/**
	* @ORM\Column(type="string" , length=100) 
	*/
	protected $name;	

	//---------------Nome Alternativo----------


	/**
	* @ORM\Column(type="string" , nullable=true) 
	*/
	protected $n_alternative;






	//---------------------------Metodos----------------------------


	//----------------Id------------------
	public function getId()
	{
		return $this->id;
	}	

	//------------Alpha 2-----------------

	public function getAlpha2()
	{
		return $this->alpha2;

	}
	public function setAlpha2($alpha2)
	{
		$this->alpha2=$alpha2;	
	}

	//------------Alpha 3-----------------

	public function getAlpha3()
	{
		return $this->alpha3;

	}
	public function setAlpha3($alpha3)
	{
		$this->alpha3=$alpha3;	
	}

	//------------Nome-----------------

	public function getName()
	{
		return $this->name;

	}
	public function setName($name)
	{
		$this->name=$name;	
	}

	//------------Nome Alternativo-----------------

	public function getNAlternative()
	{
		return $this->n_alternative;

	}
	public function setNAlternative($n_alternative)
	{
		$this->n_alternative=$n_alternative;	
	}

	//----------------__toString()----------------

	public function __toString()
	{

		return $this->name;

	}
}