<?php require "scripts/script_MFA_LogIn.php"; ?>

<?php if($url_valid == false OR ($mfa != "300" AND $mfa != "310" AND $mfa != "320")):  //if cell not exist, LogIn not allowed ?>
		<?php require "inc/header.php";  ?>
		   <h1 class='text-danger text-center' style="margin-top:10%">Ovaj link nije validan. Ćelija ne postoji u bazi, unesite validnu URL adresu.</h1>
		<?php require "inc/footer.php";  ?>

<?php else: //if cell exist, LogIn allowed ?>
        <?php require "inc/header.php"; ?>
        
        <div class="container">
           <h2 class="text-center mfa-log"><span class="text-warning">MFA<?php echo $mfa; ?></span> ĆELIJA <span class="text-warning"><?php echo $cell; ?></span> <br> PRIJAVA KORISNIKA</h2>
         
           <div class="card-logIn text-center">
               <h5 class="text-warning text-center">Molimo Vas skenirajte Vašu ID karticu.</h5>
              <form action="<?php echo $_SERVER['PHP_SELF']."?BR=$mfa&CELL=$cell"; ?>" method="POST">
                  <input class="text-center form-control" type="password" name="RF_TAG" autofocus required placeholder="******">
              </form>
        	  <h5 class="text-danger"><?php echo $msg; ?></h5>
           </div>
        </div>
        
        <?php require "inc/footer.php"; ?>
<?php endif; ?>
