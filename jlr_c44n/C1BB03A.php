<?php
error_reporting(0);

if($_POST['IMG_INSERT'] == ""){
    $msg = "Skenirajte bar kod.";
}

if(isset($_POST['IMG_INSERT'])){

    if($_POST['IMG_INSERT'] == ""){
        $msg = "Niste skenirali bar kod.";
    }
else{
    $msg = "";
    
    $img_name = $_POST['IMG_INSERT'];

    $img_name =  "C1BB03A/".$img_name.".jpg";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>C1BB03A</title>



   <!--bootstrap-->
   <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
   <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
              <h2 class="text-white text-start float-right">C1BB03A</h2>
            </div>
            <div class="col">
               <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                      <div class="form-group">
                         <input type="text" class="form-control float-left" name="IMG_INSERT" placeholder="Skenirajte bar kod.." autofocus autocomplete="off"><br><br>
                      </div>
                  <?php echo "<h4 class='text-danger scan'>" .$msg. "</h4>"; ?>
               </form>
            </div>
            <div class="col">
                <?php if(isset($_POST['IMG_INSERT'])){ echo "<h2 class='text-white text-end'>" .$_POST['IMG_INSERT']. "</h2>"; } ?><br>
            </div>
        </div>
        <?php if(!empty($_POST['IMG_INSERT'])): ?>
                 
			<div class="text-center">
                    <img src="<?php echo $img_name; ?>" class="img-fluid img-single" alt="C1BB03A">
			</div>
			
        <?php endif; ?>
    </div>

</body>
</html>