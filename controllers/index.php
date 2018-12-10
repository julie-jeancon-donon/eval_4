<?php

// autoload classes
function chargerClasse($classname)
{
    if(file_exists('../models/'. $classname.'.php'))
    {
        require '../models/'. $classname.'.php';
    }
    else 
    {
        require '../entities/' . $classname . '.php';
    }
}
spl_autoload_register('chargerClasse');

$db = Database::Db();

$manager = new AccountManager($db);



// if we click on "ouvrir un nouveau compte", we create a new object Account and add in DB
if(isset($_POST['new']))
{
    $name = $_POST['name'];
    $balance = 80;
    
    
    $account = new Account([
        'name'=>$name,
        'balance'=>$balance,
        
        ]);
        
        $manager->add($account);    
}
    
// if we click on "supprimer", we delete account from DB
if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $account = $manager->getAccount($id);
    $manager->delete($account);
    header('Location: index.php');
}


// if we click on "crediter", we credit balance of the account and we update balance in DB
if (isset($_POST['payment']))
{
    $id = $_POST['id'];
    $payment = $_POST['payment'];
    $balance = $_POST['balance'];
    $account = $manager->getAccount($id);
    $account->calculCredit($balance);
    $manager->update($account);
    
}

// if we click on "debiter", we debit balance of the account and update balance in DB
if (isset($_POST['debit']))
{
    $id = $_POST['id'];
    $debit = $_POST['debit'];
    $balance = $_POST['balance'];
    $account = $manager->getAccount($id);
    $account->calculDebit($balance);
    $manager->update($account);
    
}

// if we click on "transferer l'argent", we debit the account, credit the receiver and update in DB
if (isset($_POST['transfer']))
{
    $idDebit = $_POST['idDebit'];
    $idPayment = $_POST['idPayment'];
    $balance = $_POST['balance'];
    $account = $manager->getAccount($idDebit);
    $accountTransfer = $manager->getAccount($idPayment);
    $account->calculDebit($balance);
    $accountTransfer->calculCredit($balance);
    $manager->update($account);
    $manager->update($accountTransfer);
    header('Location: index.php');
}


// get accounts after all updates
$accounts = $manager->getAccounts();

include "../views/indexView.php";
