<?php
namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Expenses_Lines")
 */


class Expenses_Lines
{	

//--------------------------Atributos---------------------

//-------------Id----------------


 /**
 *
 * @ORM\ManyToMany
 * @ORM\Column(type="integer")
 * @ORM\id
 * @ORM\GeneratedValue(strategy="AUTO")
 * 
 */
protected $id;


//----------Expense Id------------

/**
*
* @ORM\ManyToOne(targetEntity="Expenses")
* @ORM\JoinColumn(name="expense_id", referencedColumnName="id",nullable=false)
* 
*/
protected $expense_id;

//---------------Description-----------------

/**
* @ORM\Column(type="text")
*/

protected $description;

//--------------Quantity--------------

/**
* @ORM\Column(type="integer")
*/

protected $qty;

//--------------Value--------------

/**
* @ORM\Column(type="string")
*/

protected $value;

//--------------Date Added--------------

/**
* @ORM\Column(type="datetime")
*/

protected $date_added;


//-------------->Expenses Lines Taxes<---------------

	 /**
     * @ORM\ManyToMany(targetEntity="Taxes")
     * @ORM\JoinTable(name="Expenses_Line_Taxes",
     *      joinColumns={@ORM\JoinColumn(name="line_id", referencedColumnName="id",nullable=false)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tax_id", referencedColumnName="id",nullable=false)}
     *      )
     */

 protected $tax;



//----------------------------------Construtor-------------------------

	
	public function __construct() {


		//------------------Tax(Expenses Line Taxes)--------------------

        $this->tax = new \Doctrine\Common\Collections\ArrayCollection();
        

        //------------------------Date Added---------------------------

        $this->date_added= new \DateTime("now");



    }



//-----------------------------------Metodos----------------------------


	//-------------Id-----------
	public function getId()
	{
		return $this->id;
	}

	//----------------Expense Id -----------------
	public function getExpense_Id()
	{
		return $this->expense_id;
	}
	public function setExpense_Id($expense_id)
	{
		$this->expense_id=$expense_id;
	}

	//----------------Description-----------------
	public function getDescription()
	{
		return $this->description;
	}
	public function setDescription($description)
	{
		$this->description=$description;
	}

	//----------------Quantity-----------------
	public function getQuantity()
	{
		return $this->qty;
	}
	public function setQuantity($qty)
	{
		$this->qty=$qty;
	}


	//----------------Value-----------------
	public function getValue()
	{
		return $this->value;
	}
	public function setValue($value)
	{
		$this->value=$value;
	}

	//----------------Date Added-----------------
	public function getDate_Added()
	{
		return $this->date_added;
	}







}