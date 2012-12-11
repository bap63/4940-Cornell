<?php
    include 'api/main.php';
    $bot = $_SERVER['HTTP_USER_AGENT'];
    if($bot == 'Googlebot' || $bot == 'Googlebot-richsnippets'){
    //Added so google can view microdata and so they can't use our api
	
    }elseif(!(key($request_headers) == 'text/html')){
    	//if requested content other than HTML

	include 'util/functions.php';
	
	$courseQuery = split(" ",$_GET['courseSearch']);
	$cN = str_replace('-','',$courseQuery[0]);
	$cT = $courseQuery[1];
	$sql = "SELECT  * FROM book where courseName = '$cN' AND term = '$cT'";
	$ctl = $dbh->prepare($sql);
	$ctl->execute();
	$books = $ctl->fetchAll(PDO::FETCH_ASSOC);

    	returnMimeType($request_headers, $books);
    	exit;
    }
    $page = ' - Course Listing';
    $styles[] = 'styles/reset.css';
    $styles[] = 'styles/main.css';
    $styles[] = 'styles/table.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
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
    $mD ="itemscope itemtype='http://schema.org/Book'";
?>
    <table id="booktable">
<?php
    if (count($books) == 0){
        print "<p>No Books listed for this course</p>";
    }
    else{
	print "<h2>$cN</h2>";
        foreach($books as $book)
        {
	    $ds = '$';
	    $b = $book['bid'];
            $out = array();
            $out[] = "<td itemprop='isbn'>".$book['isbn']."</td>";
            $out[] = "<td itemprop='name'>".$book['title']."</td>";
            $out[] = "<td itemprop='author'>".$book['author']."</td>";
            $out[] = "<td itemprop='publisher'>".$book['publisher']."</td>";
            $out[] = "<td>$ds".$book['price']."</td>";
            $out[] = "<td><a href='showBooks.php?bid=$b'>Buy</a></td>";
	    $out[] = "<td><a href='addBook.php?bid=$b'>Sell</a></td>";
            print "<tr $mD>".join('',$out)."</tr>";
        }
    }
?>
    </table>
<?php
    include 'footer.php';
?>