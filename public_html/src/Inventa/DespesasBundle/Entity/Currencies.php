<?php

namespace Inventa\DespesasBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Currencies")
 */
class Currencies {

//----------------Atributos----------------
    //------------Code-------------
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    //---------------Company Id----------

    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id" ,nullable=false,onDelete="CASCADE")
     */
    public $company_id;

    //-------------Name------------------

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    //-------------Prefix------------------

    /**
     * @ORM\Column(type="string")
     */
    protected $prefix;
    //-------------Suffix-----------------
    /**
     * @ORM\Column(type="string")
     */
    protected $suffix;
    //----------Exchange Rate--------------
    /**
     * @ORM\Column(type="float")
     */
    protected $exchange_rate;
    //----------Exchange Update-------------
    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $exchange_update;

//-----------------------Contrutor-------------------

    public function __construct() {

        $this->setExchangeUpdate();
    }

//----------------Metodos--------------------

    public function __toString() {

        return $this->name;
    }

    //--------------------Id-----------------
    public function getId() {
        return $this->id;
    }

    //-----------------Id_Company----------------
    public function getIdCompany() {
        return $this->id_company;
    }

    public function setIdCompany($id_company) {
        $this->id_company = $id_company;
    }

    //--------------------Name-----------------

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    //-------------------Prefix---------------
    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    //----------------Suffix---------------
    public function getSuffix() {
        return $this->suffix;
    }

    public function setSuffix($suffix) {
        $this->suffix = $suffix;
    }

    //--------------Exchange Rate-----------
    public function getExchangeRate() {
        return $this->exchange_rate;
    }

    public function setExchangeRate($exchange_rate) {
        $this->exchange_rate = $exchange_rate;
        $this->setExchangeUpdate();
    }

    //---------------Exhange Update-----------
    public function getExchangeUpdate() {
        return $this->exchange_update;
    }

    protected function setExchangeUpdate() {
        $this->exchange_update = new \DateTime();
    }

}
