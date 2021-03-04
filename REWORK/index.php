<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA</title>
</head>
<body style="background: lightyellow">
<center>
    <h1>MFA LINKOVI</h1>
    <?php 
    $xml = simplexml_load_file("mfa.xml") or die("Error: Cannot create object");
    
    echo "<p style='font-size: 20px;'>MFA300</p>";

    echo "<select onChange='window.location.href=this.value' style='font-size: 20px;'>";
    foreach($xml->mfa[0]->mfa300 as $mfa){
        $cell_mfa300 = $mfa->celija;
        echo "<option value='/REWORK/MFA_LogIn?BR=300&CELL=".$cell_mfa300."'>".$_SERVER['HTTP_HOST']."/REWORK/MFA_LogIn?BR=300&CELL=$cell_mfa300</option>";
        echo "<button>ee</button>";
    }
    echo "</select>";

    echo "<p style='font-size: 20px;'>MFA310</p>";
    
    echo "<select onChange='window.location.href=this.value' style='font-size: 20px;'>";
    foreach($xml->mfa[1]->mfa310 as $mfa){
        $cell_mfa310 = $mfa->celija;
        echo "<option value='/REWORK/MFA_LogIn?BR=310&CELL=".$cell_mfa310."'>".$_SERVER['HTTP_HOST']."/REWORK/MFA_LogIn?BR=310&CELL=$cell_mfa310</option>";
    }
    echo "</select>";

    echo "<p style='font-size: 20px;'>MFA320</p>";

    echo "<select onChange='window.location.href=this.value' style='font-size: 20px;'>";
    foreach($xml->mfa[2]->mfa320 as $mfa){
        $cell_mfa320 = $mfa->celija;
        echo "<option value='/REWORK/MFA_LogIn?BR=320&CELL=".$cell_mfa320."'>".$_SERVER['HTTP_HOST']."/REWORK/MFA_LogIn?BR=320&CELL=$cell_mfa320</option>";
    }
    echo "</select>";
    ?>
    </center>
</body>
</html>