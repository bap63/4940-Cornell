<?php
    $page = ' - Book Listing';
    $styles[] = 'styles/reset.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
    $styles[] = 'styles/bookDisplay.css';
    $scripts[] = 'http://code.jquery.com/jquery-1.8.3.js';
    $scripts[] = 'http://code.jquery.com/ui/1.9.2/jquery-ui.js';
    $scripts[] = 'scripts/autocomplete.js';
    include 'header.php';

    $p = isset($_GET['pid']);
    $e = isset($_POST['email']);
    $error = '';
    $success = '';
    
    if(!$p){
        include 'footer.php';
	exit;
    }
    
    $pid = $_GET['pid'];
    $post = getPost($dbh,$pid);
    $title = $post['title'];
    $price = $post['price'];
    
    
    if($p & $e){
        //Makes sure email is valid
        $emailBuyer = $_POST['email'];
        if(!checkEmail($emailBuyer)){
            $error = $error."Invalid Email <br />";
        }else{
            
            $emailSeller = $post['email'];
	    $success = "The seller has been contacted. Please wait for them to email you.";
	    sendBuy($emailSeller,$emailBuyer,$pid,$title);
            
        }
    }
    
    
?>
    <h1>Book Listing</h1>
    <table id="booktable">
    <h1><?php echo $title. " - $".$price;?></h1>
    <form action="buyBook.php?pid=<?php echo $pid;?>" method="post">
        <p id="errors"><?php echo $error ?></p>
        <p id="success"><?php echo $success ?></p>
	Email<input type="text" name = "email" id="emailInput"/>
	<input type="submit" value="Contact Seller" />
    </form>

    </table>
<?php
    include 'footer.php';
?>