<?php

declare(strict_types = 1);

class AccountManager
{

    private $_db;


    /**
     * constructor
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    /**
     * Get the value of _db
     */ 
    public function getDb()
    {
        return $this->_db;
    }

    /**
     * Set the value of _db
     *
     * @param PDO $db
     * @return  self
     */ 
    public function setDb(PDO $db)
    {
        $this->_db = $db;

        return $this;
    }


    public function getAccounts()
    {
        $arrayOfAccounts = [];
    
        $q = $this->getDb()->query('SELECT * FROM bank_account ORDER BY id');
        $dataAccounts = $q->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach ($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new Account($dataAccount);
        }
        
        return $arrayOfAccounts;
    }

    public function add($account)
    {
        $query = $this->getDb()->prepare('INSERT INTO bank_account(name, balance) VALUES (:name, :balance');
        $query->bindValue('name', $account->getName(), PDO::PARAM_STR);
        $query->bindValue('balance', $account->getBalance(), PDO::PARAM_INT);

        $query->execute();
    }


// propriétés et méthodes de votre manager ici

}
