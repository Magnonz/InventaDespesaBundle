<?php

namespace Inventa\DespesasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inventa\DespesasBundle\Entity\Expenses;
use Inventa\DespesasBundle\Entity\Transactions;

/**
 * @ORM\Entity
 * @ORM\Table(name="TransactionApplied")
 */
class TransactionApplied {

//-------------------------------Atributos------------------------
    //------------Id-------------
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;


    //------------Transaction Id--------------

    /**
     * @ORM\ManyToOne(targetEntity="Transactions")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id",nullable=false)
     */
    protected $transaction_id;

    //------------Expense Id--------------

    /**
     * @ORM\ManyToOne(targetEntity="Expenses")
     * @ORM\JoinColumn(name="expenses_id", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    protected $expense_id;

    //------------Amount--------------

    /**
     * @ORM\Column(type="float")
     */
    protected $amount;

    //------------Date Added--------------

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_added;

//-----------------------------------Construtor----------------------------

    public function __construct() {

        $this->date_added = new \DateTime("now");
    }

    public function getDateAddedString() {
        return $this->date_added->format('Y-m-d');
    }

//-----------------------------------Metodos----------------------------
    //-------------Id-----------
    public function getId() {
        return $this->id;
    }

    //-------------Transaction Id-----------


    public function getTransactionId() {
        return $this->transaction_id;
    }

    public function setTransactionId($transaction_id) {
        $this->transaction_id = $transaction_id;
    }

    //-------------Expensive Id-----------


    public function getExpensesId() {
        return $this->expense_id;
    }

    public function setExpensesId($expense_id) {
        $this->expense_id = $expense_id;
    }

    //---------------Amount----------------

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {

        $this->amount = $amount;
    }

    //--------------------Date Added------------

    public function getDate_Added() {
        return $this->date_added;
    }

    public function applyTransaction(Transactions $trans, Expenses $expe) {

        $this->setTransactionId($trans);

        $this->setExpensesId($expe);

        $value = $trans->getAmount();

        $this->setAmount($expe->expensesClosed($value));
        if ($value == 0) {
            $trans->setStatus("Inactive");
        }

        $trans->setAmount($value);
    }

}
