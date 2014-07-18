<?php

namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Suppliers")
 */
class Suppliers {

    //-------------------------------------Atributos----------------------------
    //------------Id-------------
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;

    //----------Myinventa Id----------

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $myinventa_id;


    //-----------Status-------------

    /**
     * @ORM\Column(type="string")
     */
    protected $status;

    //----------Name--------

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    //-----------E-mail------------
    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    //----------Phone--------------

    /**
     * @ORM\Column(type="string")
     */
    protected $phone;


    //---------Notes-----------

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $notes;

    //-----------Default_Currency------------

    /**
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumn(name="default_currency", referencedColumnName="id" ,nullable=false,onDelete="CASCADE")
     */
    protected $default_currency;

    //------------Date Added------------------

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_added;
    //-----------Author Id------------
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $author_id;


    //------------Country---------------

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false,onDelete="CASCADE")
     */
    protected $country_id;

    /**
     * @ORM\OneToMany(targetEntity="Expenses", mappedBy="supplier",cascade={"all"})
     */
    protected $expenses;

    //-----------------------------------Construtor----------------------------

    public function __construct() {

        $this->expenses = new ArrayCollection();
        $this->date_added = new \DateTime('now');
    }

    //----------------------------------Metodos--------------------------------

    public function __toString() {
        return $this->expenses;
    }

    //-------------Id-----------
    public function getId() {
        return $this->id;
    }

    //----------------Myinventa Id -----------------
    public function getMyinventaId() {
        return $this->myinventa_id;
    }

    public function setMyinventaId($myinventa_id) {
        $this->myinventa_id = $myinventa_id;
    }

    //----------------Status -----------------
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    //----------------Name-----------------
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    //----------------E-mail-----------------
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    //----------------Phone-----------------
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    //----------------Notes-----------------
    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

    //----------------Default Currency-----------------
    public function getDefaultCurrency() {
        return $this->default_currency;
    }

    public function setDefaultCurrency($default_currency) {
        $this->default_currency = $default_currency;
    }

    //----------------Date Added-----------------
    public function getDateAdded() {
        return $this->date_added;
    }

    //----------------Author Id-----------------
    public function getAuthorId() {
        return $this->author_id;
    }

    public function setAuthorId($author_id) {
        $this->author_id = $author_id;
    }

    //-----------------Country-----------------

    public function getCountryId() {
        return $this->country_id;
    }

    public function setCountryId($country_id) {

        $this->country_id = $country_id;
    }

    //-----------------Expenses-----------------

    public function getExpenses() {
        return $this->expenses->toArray();
    }

    public function addExpense($expense) {
        $this->expenses->add($expense);
    }
    
    public function removeExpense($key) {
        $this->expenses->remove($key);
    }

}
