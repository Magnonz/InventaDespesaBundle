<?php
namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;



/**
 * @ORM\Entity
 * @ORM\Table(name="ExpensesFiles")
 */


class ExpensesFiles
{	

//--------------------------Atributos---------------------


//-------------Id----------------


/**
*
 * @ORM\Column(type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 * 
 */

protected $id;




private $temp;


/**
 * @var string $file
 * @Assert\File(maxSize="6000000")
 * @ORM\Column(name="file", type="string", length=255)
 */

private $file;

//----------Expense Id------------

/**
*
* @ORM\ManyToOne(targetEntity="Expenses")
* @ORM\JoinColumn(name="expense_id", referencedColumnName="id",nullable=false)
* 
*/
protected $expense_id;

//----------------Type---------------


/**
* @ORM\Column(type="string", nullable=true)
*/
protected $type;

//---------------Description-----------------

/**
* @ORM\Column(type="text" , nullable=true)
*/

protected $description;

//------------------Date Added-------------------


/**
* @ORM\Column(type="datetime")
*/


protected $date_added;


	//-----------------------------------Construtor----------------------------

	public function __construct()
	{
              

          $this->date_added= new \DateTime("now");

  }

	//-----------------------------------Metodos----------------------------

/**
 * Get file.
 *
 * @return UploadedFile
 */
public function getFile()
{
    return $this->file;
}
/**
 * Sets file.
 *
 * @param UploadedFile $file
 */


public function setFile(UploadedFile $file = null)
{
    $this->file = $file;
    // check if we have an old image path
    if (isset($this->path)) {
        // store the old name to delete after the update
        $this->temp = $this->path;
        $this->path = null;
    } else {
        $this->path = 'initial';
    }




}

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */

    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        
        
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload($file)
    {
        
        if ($file === $this->getAbsolutePath())
        {
            unlink($file);
        }
    }
    
    public function getClientOriginalName($file)
    {
    
    }

	//-------------Id-----------
	public function getId()
	{
		return $this->id;
	}

	//----------------Expense Id -----------------
	public function getExpenseId()
	{
		return $this->expense_id;
	}
        
	public function setExpenseId($expense_id)
	{
		$this-> expense_id= $expense_id;
	}

	//--------------Type---------------------

	/*public function getType()
	{
		
        return $this-> type=pathinfo($this->path,PATHINFO_EXTESION);
        
    
	}
        */
	public function getType()
	{
	 	return $this->type ;
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


	//----------------Date Added-----------------
	public function getDateAdded()
	{
		return $this->date_added;
	}


}



