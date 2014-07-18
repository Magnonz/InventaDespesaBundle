<?php

namespace Inventa\DespesasBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Expenses")
 */
class Expenses {
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

//------------External Id------------

    /**
     * @ORM\Column(type="string" , nullable=true)
     *
     */
    protected $external_id;



//-----------Supplier-------------

    /**
     *
     * @ORM\ManyToOne(targetEntity="Suppliers", inversedBy="expenses")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $supplier;


//-----------Company Id-------------

    /**
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * 
     */
    protected $company_id;

//---------------Author_id-------------------

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $author_id;

//---------------Date Billed-------------------

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_billed;

//---------------Date Due-------------------

    /**
     * @ORM\Column(type="datetime" ,nullable=true)
     */
    protected $date_due;


//---------------Date Closed-------------------

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $date_closed;

//-----------Status-------------

    /**
     * @ORM\Column(type="string" ,nullable=true)
     */
    protected $status;



//-----------Subtotal-------------

    /**
     *
     * @ORM\Column(type="float",nullable=true)
     */
    protected $subtotal;


//-----------Total-------------

    /**
     * @ORM\Column(type="float")
     */
    protected $total;

//-----------Paid Value------------

    /**
     * @ORM\Column(type="float")
     */
    protected $paid_value;



//-----------Paid-------------

    /**
     * @ORM\Column(type = "boolean" , nullable = false, name ="paid")
     * @var boolean
     */
    protected $paid;


//-------------Billable------------

    /**
     * @ORM\Column(type = "boolean" , nullable = false, name = "billable")
     * @var boolean
     */
    protected $billable;

//---------------Categories-------------

    /**
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumn(name="categories_id", referencedColumnName="id",nullable=false ,onDelete="CASCADE")
     */
    protected $categories_id;


//-----------Currency-------------

    /**
     *
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumn(name="currency", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * 
     */
    protected $currency;


//-----------Country-------------

    /**
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="countries", referencedColumnName="id",nullable=false ,onDelete="CASCADE")
     * 
     */
    protected $countries;


//-----------Note Public-------------

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $note_public;

//-----------Note Private-------------

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $note_private;

//---------------Date Added-------------------

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_added;



//----------------Date Start---------------

    /**
     *
     * @var datetime 
     */
    protected $datestart;
//-----------------Date End----------------
    /**
     *
     * @var datetime 
     */
    protected $dateend;
//---------------------Files-----------------
    /**
     * @var string $file
     * @Assert\File(
     * maxSize="6000000",
     * mimeTypes = {"application/pdf"})
     * @ORM\Column(name="file", type="string", length=255, nullable=true)
     */
    private $file;

//-----------------------------------Construtor----------------------------

    public function __construct() {
        $this->date_billed = new \DateTime("now");

        $this->date_added = new \DateTime("now");

        $more60 = new \DateTime();
        $more60->modify('+ 60 day');
        $this->date_due = $more60;

        $this->paid_value = 0;
    }

//-----------------------------------Metodos----------------------------
//-------------------To String------------------
    public function __toString() {
        
    }

    public function getDateBilledString() {
        return $this->date_billed->format('Y-m-d');
    }

    public function getDateDueString() {
        return $this->date_due->format('Y-m-d');
    }

    public function getDateAddedString() {
        return $this->date_added->format('Y-m-d');
    }

    public function getDateClosedString() {
        return $this->date_closed->format('Y-m-d');
    }

//-------------Id-----------
    public function getId() {
        return $this->id;
    }

//----------------External Id-----------------
    public function getExternal_Id() {
        return $this->external_id;
    }

    public function setExternal_Id($external_id) {
        $this->external_id = $external_id;
    }

//----------------Supplier-----------------
    public function getSupplierId() {

        return $this->supplier;
    }

    public function setSupplierId($supplier) {
        $this->supplier = $supplier;
    }

//---------------Author Id------------------
    public function getAuthor_Id() {
        return $this->author_id;
    }

    public function setAuthor($author_id) {
        $this->author_id = $author_id;
    }

//---------------Company Id------------------
    public function getCompanyId() {
        return $this->company_id;
    }

    public function setCompanyId($company_id) {
        $this->company_id = $company_id;
    }

//---------------Categories Id------------------
    public function getCategoriesId() {
        return $this->categories_id;
    }

    public function setCategoriesId($categories_id) {
        $this->categories_id = $categories_id;
    }

//----------------Date Billed-----------------
    public function getDateBilled() {
        return $this->date_billed;
    }

    public function setDateBilled($date_billed) {
        $this->date_billed = $date_billed;
    }

//----------------Date Due-----------------
    public function getDateDue() {
        return $this->date_due;
    }

    public function setDateDue($date_due) {
        $this->date_due = $date_due;
    }

//----------------Date Closed-----------------
    public function getDateClosed() {
        return $this->date_closed;
    }

    public function setDateClosed($date_closed) {
        $this->date_closed = $date_closed;
    }

//----------------Status -----------------
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setStatusbyPaid() {
        if ($this->paid == 1) {
            $this->status = "Inactive";
        } else {
            $this->status = "Active";
        }
    }

//---------------Subtotal------------------
    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

//---------------Total------------------
    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

//---------------Paid------------------
    public function isPaid() {
        return $this->paid;
    }

    public function setPaid($paid) {
        $this->paid = $paid;

        if ($this->paid == true) {
            $this->date_closed = new \DateTime("now");
            $this->paid_value = $this->total;
        }
    }

    public function yesornoPaid() {
        if ($this->paid == 0) {
            echo "Não";
        } else {
            echo "Sim";
        }
    }

    public function sePaid() {
        if ($this->paid == 1) {

            return "Sim";
        } else {
            return "Não";
        }
    }

//--------------Paid  Value----------------------

    public function getPaidValue() {
        return $this->paid_value;
    }

    public function setPaidValue($paid_value, $total) {
        if ($this->isPaid) {
            return;
        } else if ($paid_value > $this->total) {
            $paid_value = $total;
        }
        $this->paid_value = $paid_value;
    }

    public function getOwedValue() {
        return $this->total - $this->paid_value;
    }

    public function expensesClosed(&$value) {

        $this->paid_value = $this->paid_value + $value;

        if ($this->paid_value >= $this->total) {

            $rest = $this->paid_value - $this->total;
            $r_amount = $value - $rest;
            $this->paid = true;
            $this->paid_value = $this->total;
            $this->date_closed = new \DateTime("now");
            $this->status = "Inactive";
            $value = $rest;
            return $r_amount;
        } else {
            $n_value = $value;
            $value = 0;
            return $n_value;
        }
    }

//---------------Billable------------------
    public function getBillable() {
        return $this->billable;
    }

    public function yesornoBillable() {
        if ($this->billable == 0) {
            echo "Não";
        } else {
            echo "Sim";
        }
    }

    public function setBillable($billable) {
        $this->billable = $billable;
    }

//---------------Currency------------------
    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

//---------------Note Public------------------
    public function getNotePublic() {
        return $this->note_public;
    }

    public function setNotePublic($note_public) {
        $this->note_public = $note_public;
    }

//---------------Note Private------------------
    public function getNotePrivate() {
        return $this->note_private;
    }

    public function setNotePrivate($note_private) {
        $this->note_private = $note_private;
    }

//----------------Date Added-----------------
    public function getDate_Added() {
        return $this->date_added;
    }

//---------------Countries------------------
    public function getCountries() {
        return $this->countries;
    }

    public function setCountries($countries) {
        $this->countries = $countries;
    }

//----------------Date Start-----------------
    public function getDateStart() {
        return $this->datestart;
    }

    public function setDateStart($datestart) {
        $this->datestart = $datestart;
    }

//----------------Date End-----------------

    public function getDateEnd() {
        return $this->dateend;
    }

//---------------File----------------------
    public function getFile() {

        return $this->file;
    }

    public function setFile($file) {

        $this->file = $file;
    }

//---------------------------Uploading Files------------------------------------
    //-------------------------Upload/Criar--------------------------------
    public function upload() {

        if ($this->getFile() === NULL) {
            return;
        }
        $this->route = __DIR__ . '/../../../../web/expenses/';


        //Original Name

        $this->files = $this->getFile()->getClientOriginalName();

        $this->other = hash('ripemd160', $this->files) . '.pdf';

        $this->getFile()->move($this->route, $this->other);

        $this->file = $this->other;
    }

    //-------------------------Update/Modificar--------------------------------
    public function updateFile() {

        $this->route = __DIR__ . '/../../../../web/expenses/' . $this->file;

        if ($this->getFile() === NULL) {
            return;
        }

        $this->files = $this->getFile()->getClientOriginalName();

        $this->other = hash('ripemd160', $this->files) . '.pdf';

        $this->getFile()->move($this->route, $this->other);

        $this->file = $this->other;
    }

    //-------------------------Apagar/Remover----------------------------------
    public function removeFile() {

        $fs = new Filesystem();

        $this->route = __DIR__ . '/../../../../web/expenses/' . $this->file;

        $fs->remove(array('symlink', $this->route, $this->file));
    }

}
