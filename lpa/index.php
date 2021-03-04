
<?php 
require_once "inc/connect.php"; 
require_once "inc/connectEMP.php"; 
error_reporting(0);
session_start();


$net_id = $_POST['net_id'];
$pass = $_POST['lozinka'];
$nivo = $_POST['nivo'];
$lokacija = $_POST['lokacija'];
$audit = $_POST['audit'];


$sql = "SELECT * FROM ankete.employee_db WHERE ID_CARD= '$net_id' AND pass='$pass'";


$query = mysqli_query($conn, $sql);
if(isset($_POST['btn_log'])){

    
    if($res = mysqli_num_rows($query) > 0){

        $_SESSION['status'] = 1;
        $_SESSION['net_id'] = $net_id;
        $_SESSION['pass'] = $pass;
        $_SESSION['lokacija'] = $lokacija;


        header("Location: http://10.239.172.30/lpa/layer/first_page.php?NIV=$nivo&LOC=$lokacija&AU=$audit");
    }
    else{
        $msg = "Pogrešno ste uneli ID ili šifru!";
    }

    if($net_id == "" AND $pass == ""){
        $msg = "Niste popunili sva polja!";
        } 
}
?>


<?php include 'layer/header_log.php' ?> <br><br><br><br><br>
<link rel="stylesheet" href="log.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ HEAD tag ---------->



        <div id="main">
        <div class="container">
            <form action="" method="POST"> 

            <div id="errors">
            <?php include 'inc/insert.php'; ?>
            </div> 

            <h2 class="text-center">LPA Cutting</h2>
		    <form class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <?php echo "<h2 class='text-danger'>".$msg."</h2>"; ?>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text">ID broj:</label>
                <input type="text" name="net_id" class="form-control" placeholder="Unesite Vaš ID broj">  
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="text">Lozinka:</label>
                <input type="password" name="lozinka" class="form-control" placeholder="Lozinka">  
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Izaberite nivo:</label>
                <select class="form-control" name="nivo" id="exampleFormControlSelect1">
                <option value="Nivo1">Nivo 1</option>
                <option value="Nivo2">Nivo 2</option>
                <option value="Nivo3">Nivo 3</option>
                </select>
                <!-- <small><i>Izaberite nivo</i></small> -->
           
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Lokacija:</label>
                <select class="form-control" name="lokacija" id="exampleFormControlSelect1" id="s1">
                <option value="NS1">NS1</option>
                <option value="NS2">NS2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Odabir zone audita:</label>
                <select class="form-control" name="audit" id="exampleFormControlSelect1" id="s2"> 
                <option value="Cutting&LP">Cutting-LP</option>
                <option value="Assembling">Assembling</option>
                <option value="Logistic">Logistic</option>
                <option value="LP">LP</option>
                </select>
            </div>

            <input type="submit" class="btn btn-primary" name="btn_log" value="Login">
            </form>
        </div>

</body>
</html>
<?php include 'layer/footer.php'; ?> 
