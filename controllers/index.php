<?php

// On enregistre notre autoload.
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


// Votre code ici 


if(isset($_POST['new'])){
    $name = $_POST['name'];
    $balance = 80;
    
    $account = new Account([
        'name'=>$name,
        'balance'=>$balance
        ]);
        
        $manager->add($account);    
    }
    
    
    if(isset($_POST['delete']))
    {
        $id = $_POST['id'];
        $account = $manager->getAccount($id);
        $manager->delete($account);
        header('Location: index.php');
    }
    $accounts = $manager->getAccounts();

include "../views/indexView.php";
