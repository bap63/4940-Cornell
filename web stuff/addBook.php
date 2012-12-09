<?php
    $page = ' - Add Book';//Set title of page
    $styles[] = 'styles/reset.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
    $scripts[] = 'http://code.jquery.com/jquery-1.8.3.js';
    $scripts[] = 'http://code.jquery.com/ui/1.9.2/jquery-ui.js';
    $scripts[] = 'scripts/autocomplete.js';
    include 'header.php';
    
    $e = isset($_POST['email']);
    $b = isset($_POST['bid']);
    $p = isset($_POST['price']);
    $n = isset($_POST['notes']);
    $error = '';
    //Checks if fields are set
    if($e && $b && $p){
        $bid = $_POST['bid'];
        
        //Valids Price Input
        $price = str_replace('$','',$_POST['price']);
        if(!is_numeric($price)){
            $error = $error."Invalid Price <br />";
        }elseif($price > 200 || $price < 0){
            $error = $error."Invalid Price. Must me between $0 and $200 USD. <br />";  
        }
        
        //Strips junk out of the notes field
        $notes = '';
        if(n){
            $notes = $_POST['notes'];
            if(strlen($notes) < 300){
                $notes = preg_replace('/[^a-zA-Z0-9. ]/', '', $notes);
            }else{
                $error = $error."Notes must be under 300 characters. <br />";   
            }
        }
        
        $email = $_POST['email'];
        if(!checkEmail($email)){
            $error = $error."Invalid Email <br />";
        }
        
        if($error == ''){
            $_POST['email'] = "";
            $_POST['bid'] = "";
            $_POST['price'] = "";
            
            $hD = getHash();
            $hash = $hD['hash'];
            $salt = $hD['salt'];
            $code = $hD['code'];
            $date = 'CURDATE()';
        
            $insertValues = "null,$bid,'$email',$price,'$hash','$salt','$notes',$date";
            $sql = "INSERT INTO post VALUES($insertValues)";            
            $ctl = $dbh->prepare($sql);
            $ctl->execute();
            $success = "Submission successfully posted. Check your email for additional instructions.";
            $pid = $dbh->lastInsertId();
                        
            $message = "You have successfully posted a book on BookScore. <br />";
            $message = $message. " It is import you do not delete this email:<br />";
            $message = $message." Unique <br />";
            $message = $message."Access Code: $code<br />";
            sendPost($email,$pid,$code);
        }
    }
?>
    <form action="addBook.php" method="post">
        <p id="errors"><?php echo $error ?></p>
        <p id="success"><?php echo $success ?></p>
	Email<input type="text" name = "email" id="emailInput"/><br />
        Price $<input type="text" name = "price" id="priceInput"/><br />
        Notes<input type="text" name="notes" id="noteInput"/>
        <input type="hidden" name = "bid" value='1' /><br />
	<input type="submit" value="Add" />
    </form>
    
<?php
    include 'footer.php';
?>