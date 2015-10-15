<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
    <p>
    <?php
        $courses = file("courses.tsv");
        $fileSize = fileSize("courses.tsv");
    ?>
        Course list has <?= count($courses)?> total courses
        and
        size of <?=$fileSize?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            $numberOfCourses = 3;
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
                $temp = $listOfCourses;
                $lineCounter = 0;
                shuffle($temp);
//                implement here.
                foreach ($temp as $line) {
                    $tokens = explode("\t", $line);
                    array_push($resultArray, $tokens[0]." - ".$tokens[1]);
                    $lineCounter++;
                }
                return array_slice($resultArray, $lineCounter - $numberOfCourses);
            }
            if (isset($_GET['number_of_courses'])) {
                $numberOfCourses = $_GET['number_of_courses'];
            } else {
                $numberOfCourses = 3;
            }
        ?>
        <ol>
            <?php
            $arrayToPrint = getCoursesByNumber($courses, $numberOfCourses);
            foreach ($arrayToPrint as $lines) {
                print "<li>$lines</li>";
            }
                ?>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            $startCharacter = "C";
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
                foreach ($listOfCourses as $line) {
                        if ($line[0] == $startCharacter) {
                            $tokens = explode("\t", $line);
                            array_push($resultArray, $tokens[0]." - ".$tokens[1]);
                        }
                    }

//                implement here.
                return $resultArray;
            }
        ?>
        <p>
            <?php
                $inputChar = "C";
                if (isset($_GET['character'])) {
                    $inputChar = $_GET['character'];
                } else {
                    $inputChar = "C";
                }
            ?>

            Courses that started by <strong><?=$inputChar?></strong> are followings :
        </p>
        <ol>
            <?php
            $arrayToPrint = getCoursesByCharacter($courses, $inputChar);
            foreach ($arrayToPrint as $lines) {
                print "<li>$lines</li>";
            }
                ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            $startCharacter = 0;
            function getCoursesByOrder($listOfCourses, $orderby) {
                $resultArray = array();
//                implement here.
                foreach ($listOfCourses as $line) {
                    $tokens = explode("\t", $line);
                    array_push($resultArray, $tokens[0]." - ".$tokens[1]);
                }
                if ($orderby == 1) {
                    asort($resultArray);
                } else if ($orderby == 0) {
                    arsort($resultArray);
                }
                return $resultArray;
            }
            if (isset($_GET['orderby'])) {
                $startCharacter = $_GET['orderby'];
            } else {
                $startCharacter = 0;
            }

        ?>
        <p>
            All of courses ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
            <?php
                $array = getCoursesByOrder($courses, $startCharacter);
                foreach($array as $line) {
                    if (strlen($line) > 30) {
                        print "<li class=\"long\">$line</li>";
                    } else {
                        print "<li>$line</li>";
                    }
                }
            ?>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <?php
            if (isset($_GET['new_course']) && isset($_GET['code_of_course'])) {
                $newCourse = $_GET['new_course'];
                $codeOfCourse = $_GET['code_of_course'];
                $courseAdd = $newCourse."\t".$codeOfCourse."\n";
                file_put_contents("courses.tsv", $courseAdd, FILE_APPEND);
                print "<p>Adding a course is success!</p>";
            }
            else {
                print "<p>Input course or code of the course doesn't exist.</p>";
            }
        ?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>