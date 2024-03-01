<?php
    $pageTitle = "Course Page"; 
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/courses/coursefunctions.php");
?>


<?php
//courses/view.php?c=00000
//view.php will view course contents
// Check if the ID parameter is present in the URL

//genCourseInvite(1);

if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
    echo ("<br> <br> Please login");
    return;
}
if(isset($_GET['c'])) {
    // Retrieve the ID from the URL
    $course = $_GET['c'];
    // Use the ID in your script
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM courses
            WHERE id='$course'
            ";
    $data = mysqli_query($conn, $sql);
    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }
    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        return;
    }
    while ($row = mysqli_fetch_assoc($data)) {
        $coursetitle = $row['title'];
        // Add other columns as needed
    }
} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
    return;
}
    //check if user can access course
    $Coursedata = getCourses();
    $canAccess = false;
    foreach ($Coursedata as $row) {
        if ($row['id'] == $course) {
            $canAccess = true;
            break;
        }
    }
    if (!$canAccess) {
        echo "access denied";
        return;
    }
    //$expiretime = "5";
    //genCourseInvite($course, $expiretime);
?>

    


    <div id="page-contents">
        <div id="page-header">
        <?php echo '<h1 id="page-title">' . $coursetitle . '</h1>'?>
        </div>

        <div id="course-description">
            <?php
                $data = getAssignments($course);
                foreach ($data as $row) {
                    echo $row["description"];
                }

            ?>
        </div>


        <div class="card-container-courses">
            <?php
            echo '<a href= ../Assignment/newAssignment.php?c=>
						<div class="courses-card" id="0	"> 
						
						<h2 class="card-title">New Assignment</h2>
                        </div>
					</a>
                ';


        
            
            foreach ($data as $row) {
                echo '


                    <div class="courses-card" id="' . $row["id"] . '"> 

                        <div class="card-contents">
                            <h2 class="card-title">' . $row['title'] . '</h2>
                            
                        </div>

                        

                        <div class="card-contents card-body">
                            ' . $row["description"] . '
                        </div>

                        <div class="card-contents card-info">
                            <p id="posted">Posted: </p>
                            <p id="due">Due: </p>
                            <p id="from">From ID: </p>
                            <p id="files">Files: </p>
                        </div>
                    </div>
                    
                ';
            }
            ?>
        </div>
    </div>


    <script>
        $(document).ready(function() {


        $('.courses-card').each(function() {
            const assignmentID = $(this).attr('id');
            


            var img = $('<img>', {
                src: '/resources/assignments/' + assignmentID + '/splash.png', 
                alt: 'Image for card: ' + assignmentID
            });
            var settingsbar = $('<div class="courses-bar">	</div>');


            $.getJSON('/resources/assignments/' + assignmentID + '/data.json', function(data) {
                var date = new Date(data.start_date);
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var formattedDate = day + "/" + month;
                $("#posted").append(formattedDate);

                var date = new Date(data.end_date);
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var formattedDate = day + "/" + month;
                $("#due").append(formattedDate);

                $("#from").append(data.instructor_id);

                $("#files").append("0");


                $.each(data, function(index, item) {
                    console.log(index); // Access each item
                    console.log(item);
                    // Do something with each item
                });
            });

        });



        });
    </script>

    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/postamble.php");
    ?>