<?php
    $page = ' - Course Listing';
    $styles[] = 'styles/reset.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
    $styles[] = 'styles/bookDisplay.css';
    $scripts[] = 'http://code.jquery.com/jquery-1.8.3.js';
    $scripts[] = 'http://code.jquery.com/ui/1.9.2/jquery-ui.js';
    $scripts[] = 'scripts/autocomplete.js';
    include 'header.php';
    if( !isset($_GET['courseSearch']) ){
        include 'footer.php';
	exit;
    }
    $courseQuery = split(" ",$_GET['courseSearch']);
    $cN = str_replace('-','',$courseQuery[0]);
    $cT = $courseQuery[1];
    $sql = "SELECT  * FROM book where courseName = '$cN' AND term = '$cT'";
    $ctl = $dbh->prepare($sql);
    $ctl->execute();
    $books = $ctl->fetchAll(PDO::FETCH_ASSOC);
?>
    <h1>Book Listing</h1>
    <table id="booktable">
<?php
    if (count($books) == 0){
        print "<p>No Books listed for this course</p>";
    }
    else{
	print "<h1>$cN</h1>";
        foreach($books as $book)
        {
	    $b = $book['bid'];
            $out = array();
            $out[] = "<td>".$book['isbn']."</td>";
            $out[] = "<td>".$book['title']."</td>";
            $out[] = "<td>".$book['authr']."</td>";
            $out[] = "<td>".$book['publisher']."</td>";
            $out[] = "<td>".$book['price']."</td>";
            $out[] = "<td><a href='showBooks.php?bid=$b'>Buy</a></td>";
	    $out[] = "<td><a href='addBook.php?bid=$b'>Sell</a></td>";
            print "<tr>".join('',$out)."</tr>";
        }
    }
?>
    </table>
<?php
    include 'footer.php';
?>