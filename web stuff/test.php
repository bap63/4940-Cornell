<?php
    $page = ' - Test Page';//Set title of page
    //This is how you add javascript or styles to a page
    $styles[] = 'styles/reset.css';
    $styles[] = 'http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css';
    $scripts[] = 'http://code.jquery.com/jquery-1.8.3.js';
    $scripts[] = 'http://code.jquery.com/ui/1.9.2/jquery-ui.js';
    $scripts[] = 'scripts/autocomplete.js';
    include 'header.php';
?>
    <h1>Page for Testing</h1>
    
<?php
    /*
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
    */
    $sql = "SELECT  name FROM course WHERE term = 'Spring-2013'";//Fetches top ten courses
    $ctl = $dbh->prepare($sql);
    $ctl->execute();
    $courses = $ctl->fetchAll(PDO::FETCH_ASSOC);
    

?>
    <div class="ui-widget">
        <label for="courses">Courses</label>
        <input id="courses" />
    </div>
    
<?php
    include 'footer.php';
?>