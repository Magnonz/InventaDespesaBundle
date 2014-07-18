<?php
namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Taxes")
 */


class Taxes
{	

//--------------------------Atributos---------------------

//-------------Id----------------


/**
*
 * @ORM\Column(type="integer")
 * @ORM\id
 * @ORM\GeneratedValue(strategy="AUTO")
 * 
 */
protected $id;

//-------------Company Id----------------------


/**
*
* @ORM\ManyToOne(targetEntity="Company")
* @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false)
* 
*/

protected $company_id;


//---------------Name-----------------

/**
* @ORM\Column(type="string")
*/

protected $name;

//--------------Amount-----------

/**
* @ORM\Column(type="float")
*/
protected $amount;


//----------------Type---------------


/**
* @ORM\Column(type="string")
*/

protected $type;


//------------Country---------------


/**
* @ORM\ManyToOne(targetEntity="Country")
* @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
*/

protected $country_id;



//-----------------------------------Metodos----------------------------


//-------------Id-----------
public function getId()
{
	return $this->id;
}

//----------------Company Id-----------------
public function getCompany_Id()
{
	return $this->company_id;
}
public function setCompany_Id($Company_id)
{
	$this->company_id=$company_id;
}

//----------------Name-----------------
public function getName()
{
	return $this->name;
}
public function setName($name)
{
	$this->name=$name;
}

//----------------Amount-----------------
public function getAmount()
{
	return $this->amount;
}
public function setAmount($amount)
{
	$this->amount=$amount;
}

//--------------Type---------------------

public function getType()
{
	return $this->type;
}
public function setType($type)
{
	$this->type=$type;
}

//-----------------Country-----------------

public function getCountry()
{
	return $this->country;
}
public function setCountry($country)
{
	$this->country->$country;
}

}



