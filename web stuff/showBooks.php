<?php
    $page = ' - Book Listing';
    $styles[] = 'styles/reset.css';
    $styles[] = 'styles/main.css';
    $styles[] = 'styles/table.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
    $styles[] = 'styles/bookDisplay.css';
    $scripts[] = 'http://code.jquery.com/jquery-1.8.3.js';
    $scripts[] = 'http://code.jquery.com/ui/1.9.2/jquery-ui.js';
    $scripts[] = 'scripts/autocomplete.js';
    include 'header.php';

    if( !isset($_GET['bid']) ){
        include 'footer.php';
	exit;
    }
    $bid = $_GET['bid'];
    $posts = getPosts($dbh,$bid);
    $title = getBookTitle($dbh,$bid);
    
?>
    <h1>Book Listing</h1>
    <table id="booktable">
<?php
    if (count($posts) == 0){
        print "<p>No Books being currently sold for this course</p>";
    }
    else{
	print "<h1>$title</h1>";
        foreach($posts as $post)
        {
	    
            $out = array();
	    $pid = $post['pid'];
            $out[] = "<td>$".$post['price']."</td>";
            $out[] = "<td>".$post['notes']."</td>";
            $out[] = "<td>".$post['date']."</td>";
	    $out[] = "<td><a href='buyBook.php?pid=$pid'>Buy Now</a></td>";
            print "<tr>".join('',$out)."</tr>";
        }
    }
?>
    </table>
<?php
    include 'footer.php';
?>