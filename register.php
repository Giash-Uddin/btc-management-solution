<?php
$project_folder = explode("/", str_replace($_SERVER["DOCUMENT_ROOT"], "", $_SERVER["SCRIPT_FILENAME"]));
include ($_SERVER["DOCUMENT_ROOT"] . "/" . $project_folder[1] . "/database/DataAccess.php");

$db = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register = [];
    $register['name'] = $_POST['name'];
    $register['blood_group'] = $_POST['blood_group'];
    $register['contact_no'] = $_POST['contact_no'];
    $register['email_id'] = $_POST['email_id'];
    $register['designation'] = $_POST['designation'];
    $register['joining_date'] = $_POST['joining_date'];
    $register['branch_name'] = $_POST['branch_name'];
    $register['controlling_office'] = $_POST['controlling_office'];
    $register['area'] = $_POST['area'];
    $register['district'] = $_POST['district'];
    $register['dob'] = $_POST['dob'];
    $register['user_name'] = $_POST['user_name'];
    $register['index_no'] = $_POST['index_no'];
    $register['password'] = $_POST['password'];
    $result = $db->insert('tbl_course', $course);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
    </head>
    <body id="login" style="background: linear-gradient(to right, #f0f2f0 0%, #303939 100%);">

        <div class="container">

            <form class="form-signin">
                <h2 class="form-signin-heading">Registration</h2>
                <div class="form-inline">
                    <input type="text" class="input-block-level" name="name" placeholder="Full Name">		
                    <select class="input-block-level" name="blood_group" placeholder="Blood Group">
                        <option value="">-- Select Blood Group --</option>
                        <option value="A Positive">A+</option>
                        <option value="B Positive">B+</option>
                        <option value="O Positive">O+</option>
                        <option value="AB Positive">AB+</option>
                        <option value="A Negative">A-</option>
                        <option value="B Negative">B-</option>
                        <option value="O Negative">O-</option>
                        <option value="AB Negative">AB-</option>
                    </select>
                </div>
                <div>
                    <input type="text" class="input-block-level" name="contact_no" placeholder="Contact No"/>
                </div>
                <div>
                    <input type="text" class="input-block-level" name="email_id" placeholder="Email ID"/>
                </div>
                <div>
                    <input type="text" class="input-block-level" name="designation" placeholder="Designation">
                    <input type="text" class="input-block-level" name="joining_date" placeholder="Joining Date">
                </div>
                <div>
                    <input type="text" class="input-block-level" name="branch_name" placeholder="Branch Name">
                    <input type="text" class="input-block-level" name="controlling_office" placeholder="Controlling Office">
                </div>
                <div>
                    <input type="text" class="input-block-level" name="area" placeholder="Area">
                    <input type="text" class="input-block-level" name="district" placeholder="District">
                </div>
                <div>
                    <input type="text" class="input-block-level" name="dob" placeholder="Date of Birth">
                    <input type="text" class="input-block-level" name="user_name" placeholder="User Name">
                </div>
                <div>
                    <input type="text" class="input-block-level" name="index_no" placeholder="Index No">
                    <input type="password" class="input-block-level" name="password" placeholder="Password">
                </div>
                <div>
                    <button class="btn btn-large btn-success" type="submit">Submit</button>
                </div>
            </form>

        </div> <!-- /container -->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>