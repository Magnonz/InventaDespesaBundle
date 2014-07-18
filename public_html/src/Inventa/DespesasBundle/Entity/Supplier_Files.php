<?php
namespace Inventa\DespesasBundle\Entity;



use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Supplier_Files")
 */


class Supplier_Files
{	

	//-----------------------Atributos-------------------



	//-----------------ID--------------


	/**
	*
	 * @ORM\Column(type="integer")
	 * @ORM\id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 */
	protected $id;



	//------------Supplier Id--------------

	/**
	* @ORM\ManyToOne(targetEntity="Suppliers")
    * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", nullable=false)
	*/
	protected $supplier_id;


	//----------------Type---------------


	/**
	* @ORM\Column(type="string", nullable=true)
	*/
	protected $type;

	//---------------Name-----------------

	/**
	* @ORM\Column(type="string")
	*/

	protected $name;

	//------------------Date Added-------------------
	

	/**
	* @ORM\Column(type="string")
	*/


	protected $date_added;

	/**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }




	//-----------------------------------Construtor----------------------------

	public function __construct()
	{

          $this->date_added= new \DateTime("now");

    }


	//-----------------------------------Metodos----------------------------


	//-------------Id-----------
	public function getId()
	{
		return $this->id;
	}

	//----------------Supplier Id -----------------
	public function getSupplier_Id()
	{
		return $this->Supplier_id;
	}
	public function setSupplier_Id($supplier_id)
	{
		$this->supplier_id=$supplier_id;
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

	//----------------Name-----------------
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name=$name;
	}


	//----------------Date Added-----------------
	public function getDate_Added()
	{
		return $this->date_added;
	}


}



