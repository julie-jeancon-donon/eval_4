<?php

declare(strict_types = 1);

class Account
{
    protected   $id,
                $name,
                $balance;


/**
     * constructor
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    /**
     * Hydratation
     *
     * @param array $donnees
     */
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                
                $method = 'set'.ucfirst($key);
                    
                // if setter exists.
                if (method_exists($this, $method))
                {
                    
                    $this->$method($value);
                }
            }
        }





    /**
     * Set the value of id
     * @param int $id
     * @return  self
     */ 
    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

        /**
         * Set the value of name
         * @param string $name
         * @return  self
         */ 
        public function setName(string $name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of name
         * @return string
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of balance
         * @param int $balance
         * @return  self
         */ 
        public function setBalance($balance)
        {
                $balance = (int) $balance;
                $this->balance = $balance;

                return $this;
        }

        /**
         * get the value of the balance
         *
         * @return int
         */
        public function getBalance()
        {
                return $this->balance;
        }
        
        /**
         * get balance when its debited
         *
         * @param int $debit
         * @return int
         */
        public function calculDebit($debit)
        {
            $newBalance = $this->getBalance() - $debit;
            $this->setBalance($newBalance);

        }

        /**
         * get balance when its credited
         *
         * @param int $credit
         * @return int
         */
        public function calculCredit($credit)
        {
            $newBalance = $this->getBalance() + $credit;
            $this->setBalance($newBalance);
        }
}
