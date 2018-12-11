<?php

include('includes/header.php');

?>

<div class="container">

	<header class="flex">
		<p class="margin-right">Bienvenue sur l'application Comptes Bancaires</p>
	</header>

	<h1>Mon application bancaire</h1>

	<form class="newAccount" action="index.php" method="post">
		<label>Sélectionner un type de compte</label>
		<select class="" name="name" required>
			
			<option value="PEL">PEL</option>
			<option value="Compte courant">Compte courant</option>
			<option value="Compte joint">Compte joint</option>
			<option value="Livret A">Livret A</option>	 

		
		</select>
		<input type="submit" name="new" value="Ouvrir un nouveau compte">
	</form>

	<hr>

	<div class="main-content flex">

	<!-- for each account saved -->

	<?php // 
	foreach($accounts as $account)
	{
	  
		######### start of generated code for each loop round ######### ?>

		<div class="card-container">

			<div class="card">
				<h3><strong>
				<?php	
				  // display account name
				    echo $account->getName(); 
				?>
				</strong></h3>
				<div class="card-content">
					<p 
					<?php 
						if($account->getBalance() <= 0)
						{
							echo 'class="red"';
						}
						?>
						>Somme disponible : 
					<?php 
					// display account balance

					echo $account->getBalance(); 
					?> €</p>

					<!-- Form for credit/debit -->
					<h4>Dépot / Retrait</h4>
					<form action="index.php" method="post">
						<input type="hidden" name="id" value="<?php 
						
						// display account ID 
						echo $account->getId();?>
						"  required>
						<label>Entrer une somme à débiter/créditer</label>
						<input type="number" name="balance" placeholder="Ex: 250" required>
						<input type="submit" name="payment" value="Créditer">
						<input type="submit" name="debit" value="Débiter">
					</form>


					<!-- Form for transfer -->
			 		<form action="index.php" method="post">

						<h4>Transfert</h4>
						<label>Entrer une somme à transférer</label>
						<input type="number" name="balance" placeholder="Ex: 300"  required>
						<input type="hidden" name="idDebit" value="<?php
						// display account ID 
						echo $account->getId();
						?>" required>
						<label for="">Sélectionner un compte pour le virement</label>
						<select name="idPayment" required>
							<option value="" disabled>Choisir un compte</option>
							<?php 
							// display accounts whose we can credit  
							foreach($accounts as $accountTransfer)
							{
								if($account->getId() != $accountTransfer->getId())
								{
								?>
									<option value="<?php echo $accountTransfer->getId();?>"><?php echo $accountTransfer->getName();?></option>
							<?php
								}
							
							}
							?>
							
						</select>
						<input type="submit" name="transfer" value="Transférer l'argent">
					</form>

					<!-- Form to delete-->
			 		<form class="delete" action="index.php" method="post">
						 <input type="hidden" name="id" value="<?php 
						 echo $account->getId();
						 // display account ID ?>"  required>
				 		<input type="submit" name="delete" value="Supprimer le compte">
			 		</form>

				</div>
			</div>
		</div>

	
	<?php }
	
	// ######### end of generated code for each loop round ######### 
	?>

	</div>

</div>

<?php

include('includes/footer.php');

 ?>