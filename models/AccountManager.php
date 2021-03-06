<?php


declare(strict_types = 1);

// create model class 
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

    /**
     * get accounts
     *
     * @return array
     */
    public function getAccounts()
    {
        $arrayOfAccounts = [];
    
        $q = $this->getDb()->query('SELECT * FROM bank_account ORDER BY id');
        $dataAccounts = $q->fetchAll(PDO::FETCH_ASSOC);
        
        // 
        foreach ($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new Account($dataAccount);
        }
        
        return $arrayOfAccounts;
    }

    /**
     * Add new account in DB
     *
     * @param Account $account
     * @return void
     */
    public function add(Account $account)
    {
        $query = $this->getDb()->prepare('INSERT INTO bank_account(name, balance) VALUES (:name, :balance)');
        $query->bindValue('name', $account->getName(), PDO::PARAM_STR);
        $query->bindValue('balance', $account->getBalance(), PDO::PARAM_INT);

        $query->execute();
    }

    /**
     * Delete character from DB
     *
     * @param Account $account
     */
    public function delete(Account $account)
    {
        $query = $this->getDb()->prepare('DELETE FROM bank_account WHERE id = :id');
        $query->bindValue('id', $account->getId(), PDO::PARAM_INT);
        $query->execute();

        
    }

    /**
     * get one account by ID
     *
     * @param $infos_account
     * @return Account
     */
    public function getAccount($infos_account)
    {
        $query = $this->getDb()->prepare('SELECT * FROM bank_account WHERE id = :id');
        $query->bindValue('id', $infos_account, PDO::PARAM_INT);
        $query->execute();

        $dataAccount = $query->fetch(PDO::FETCH_ASSOC);

        return new Account($dataAccount);
    }

    /**
     * update account's data
     *
     * @param Account $account
     * @return void
     */
    public function update(Account $account)
    {
        $query = $this->getDb()->prepare('UPDATE bank_account SET balance = :balance WHERE id = :id');
        $query->bindValue('balance', $account->getBalance(), PDO::PARAM_INT);
        $query->bindValue('id', $account->getId(), PDO::PARAM_INT);
        $query->execute();
    }

}

    



    // public function checkIfExist(string $name)
    // {
    //     $query = $this->getDb()->prepare('SELECT * FROM bank_account WHERE name = :name');
    //     $query->bindValue('name', $name, PDO::PARAM_STR);
    //     $query->execute();

    //     // Si il y a une entrée avec ce nom, c'est qu'il existe
    //     if ($query->rowCount() > 0)
    //     {
    //         return true;
    //     }
        
    //     // Sinon c'est qu'il n'existe pas
    //     return false;
    //     echo 'ce type de compte existe déjà';
    // }




