<?php
    $page = ' - Book Listing';
    $styles[] = 'styles/reset.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
    $styles[] = 'styles/bookDisplay.css';
    $scripts[] = 'http://code.jquery.com/jquery-1.8.3.js';
    $scripts[] = 'http://code.jquery.com/ui/1.9.2/jquery-ui.js';
    $scripts[] = 'scripts/autocomplete.js';
    include 'header.php';
    if( !isset($_POST['courseSearch']) ){
        include 'footer.php';
	exit;
    }
    $courseQuery = split(" ",$_POST['courseSearch']);
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
        foreach($books as $book)
        {
            $out = array();
            $out[] = "<td>".$book['isbn']."</td>";
            $out[] = "<td>".$book['title']."</td>";
            $out[] = "<td>".$book['authr']."</td>";
            $out[] = "<td>".$book['publisher']."</td>";
            $out[] = "<td>".$book['price']."</td>";
            
            print "<tr>".join('',$out)."</tr>";
        }
    }
?>
    </table>
<?php
    include 'footer.php';
?>