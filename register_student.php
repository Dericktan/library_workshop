<?php
	include 'core/config.php';
	include 'core/faculty.php';
    include 'core/course.php';
    include 'core/user.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="box-shadow text-center register-container">
            <div class="container">
                <form action="" method="post">
                    <h2 class="text-muted">Register with us!</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" name="student_no" placeholder="Student No">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <select name="faculty_id" class="form-control" onchange="filterCourses()" id="selectFaculty">
                            <?php
                                $result = getAllFaculty();
                                $no = 0;
                                if ($result != false)
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        $no++;
                                        $id = $row["id"];
                                        $faculty_name = $row["faculty_name"];
                            ?>
                                <option value="<?php echo $id; ?>" ><?php echo $faculty_name; ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="course_id" class="form-control" id="selectCourse">
                            <option value="" id="0-0" faculty_id="0" selected>Select course</option>
                            <?php
                                $result = getAllCourse();
                                $no = 0;
                                if ($result != false)
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        $no++;
                                        $id = $row["id"];
                                        $course_name = $row["course_name"];
                                        $faculty_id = $row['faculty_id'];
                            ?>
                                <option value="<?php echo $id; ?>" id="<?php echo $id."-".$faculty_id; ?>" faculty_id="<?php echo $faculty_id; ?>"><?php echo $course_name; ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>  
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="contact_no" placeholder="Contact no">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter your password ...">
                    </div>
                    <button type="submit" class="btn btn-primary" name="student_register">Register</button>
                    <div style="margin-top: 20px; margin-bottom: 20px;">
                        <a href="login.php">I have an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function filterCourses() {
            var selectedFaculty = document.getElementById("selectFaculty").value;
            var selectCourse = document.getElementById("selectCourse");
            selectCourse.selectedIndex = "";
            var options = selectCourse.options;
            for (var i = 0; i < options.length; i++) {
                var uniqId = options[i].id;
                var element = document.getElementById(uniqId);
                var faculty_id_val = element.attributes.faculty_id.value;
                if (faculty_id_val == selectedFaculty)
                {
                    element.setAttribute("style", "display: block;");
                } else {
                    element.setAttribute("style", "display: none;");
                }
            }
        }
        filterCourses();
    </script>
</body>
</html>