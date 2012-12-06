<?php
    $page = ' - Test Page';//Set title of page
    
    //This is how you add javascript or styles to a page
    $styles[] = 'Styles/reset.css';
    //$scripts[] = 'https://www.google.com/jsapi';
    //$scripts[] = 'Scripts/index_1.js';
    //$scripts[] = 'Scripts/index_2.js';
    //$scripts[] = 'Scripts/index_3.js';
    include 'header.php';
?>
    <!- Page content goes here -->
    <h1>Page for Testing</h1>
    
<?php
    $sql = "SELECT  * FROM course LIMIT 0,10";//Fetches top ten courses
    $ctl = $dbh->prepare($sql);
    $ctl->execute();
    $courses = $ctl->fetchAll(PDO::FETCH_ASSOC);
    foreach($courses as $course)
    {
        $name = $course['name'];
        $term = $course['term'];
        $instructor = $course['instructor'];
        $lineOut = "<p>$name  $term  $instructor</p>";
        print $lineOut;
    }
    
?>
    <p>More html and junk</p>
    
<?php
    include 'footer.php';
?>