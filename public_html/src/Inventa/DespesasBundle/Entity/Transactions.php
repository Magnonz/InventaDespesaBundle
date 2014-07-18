<?php

namespace Inventa\DespesasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Transactions")
 */
class Transactions {

//----------------Atributos----------------
    //------------Id-------------
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;

    //------------Supplier Id--------------

    /**
     * @ORM\ManyToOne(targetEntity="Suppliers")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    protected $supplier_id;

    //-------------Amount-------------

    /**
     * @ORM\Column(type="float")
     */
    protected $amount;

    //-------------Currency--------------

    /**
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumn(name="Currency", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    protected $currency;

    //-----------------Type---------------

    /**
     * @ORM\ManyToOne(targetEntity="TransactionType")
     * @ORM\JoinColumn(name="type", referencedColumnName="id", nullable=false,onDelete="CASCADE")
     */
    protected $type;

    //----------------Status-----------------

    /**
     * @ORM\Column(type="string")
     */
    protected $status;

    //------------Date Added------------------

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $date_added;

//-----------------------------------Construtor----------------------------

    public function __construct() {

        $this->date_added = new \DateTime("now");
    }

//-----------------------------------Metodos----------------------------
    public function __toString() {

        return $this->supplier_id;
    }

    //-------------Id-----------
    public function getId() {
        return $this->id;
    }

    //----------------Supplier Id-----------------
    public function getSupplierId() {

        return $this->supplier_id;
    }

    public function setSupplierId($supplier_id) {
        $this->supplier_id = $supplier_id;
    }

    //----------------Amount-----------------
    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    //---------------Currency------------------
    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    //--------------Type---------------------

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    //----------------Status -----------------
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    //----------------Date Added-----------------
    public function getDateAdded() {
        return $this->date_added;
    }

}
