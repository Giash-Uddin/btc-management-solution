<?php
$project_folder = explode("/", str_replace($_SERVER["DOCUMENT_ROOT"], "", $_SERVER["SCRIPT_FILENAME"]));
include ($_SERVER["DOCUMENT_ROOT"] . "/" . $project_folder[1] . "/Head.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/" . $project_folder[1] . "/database/DataAccess.php");

$db = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register = [];
    $register['name'] = $_POST['name'];
    $register['bloodlist'] = $_POST['blood_group'];
    $register['cont'] = $_POST['contact_no'];
    $register['email'] = $_POST['email_id'];
    $register['desig'] = $_POST['designation'];
    $register['joindate'] = $_POST['joining_date'];
    $register['branch'] = $_POST['branch_name'];
    $register['gmo'] = $_POST['controlling_office'];
    $register['area'] = $_POST['area'];
    $register['polist'] = $_POST['district'];
    $date = date_create($_POST['dob']);
    $register['dob'] = date_format($date, 'Y/m/d');
    $register['username'] = $_POST['user_name'];
    $register['indx'] = $_POST['index_no'];
    $register['passwd'] = $_POST['password'];
    $register['usertype'] = "donor";
    $register['status'] = 1;
    $result = $db->insert('infor', $register);
    if ($result > 0) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Greate!","Data Saved Successfully !","success");';
        echo '}, 1000);</script>';
    }else{
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("OOPs! ...","Data Not Saved !","warning");';
        echo '}, 1000);</script>';
    }
}
?>


<body id="login" style="background: linear-gradient(to right, #f0f2f0 0%, #303939 100%);">
    <script>
        var mainApp = angular.module("mainApp", []);

        mainApp.controller('registerController', function($scope) {
            $scope.reset = function() {
            }

            $scope.reset();
        });
    </script>
    <div class="container form-signin" ng-app = "mainApp" ng-controller = "registerController">

        <form name = "registerForm" novalidate class="" action='<?php $_PHP_SELF ?>' method="POST">
            <h2 class="form-signin-heading">Registration</h2>
            <table>
                <tr>
                    <td><label>Full Name :</label></td>
                    <td><input type="text" class="input-block-level" name="name" ng-model = "name"  required></td>
                    <td><label>Blood Group :</label></td>
                    <td>
                        <select class="input-block-level" name="blood_group" ng-model = "blood_group" invalid-if="{blood_group == ''}" required >
                            <option value="">-- Select Blood Group --</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="O+">O+</option>
                            <option value="AB+">AB+</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="O-">O-</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.name.$dirty && registerForm.name.$invalid">
                            <span ng-show = "registerForm.name.$error.required">Name is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.blood_group.$dirty && registerForm.blood_group.$invalid">
                            <span ng-show = "registerForm.blood_group.$error.required">Name is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td><label>Contact No :</label></td>
                    <td><input type="text" class="input-block-level" name="contact_no" ng-model = "contact_no" required/></td>
                    <td><label>Email ID :</label></td>
                    <td><input type="text" class="input-block-level" name="email_id" ng-model = "email_id" required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.contact_no.$dirty && registerForm.contact_no.$invalid">
                            <span ng-show = "registerForm.contact_no.$error.required">Contact No is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.email_id.$dirty && registerForm.email_id.$invalid">
                            <span ng-show = "registerForm.email_id.$error.required">Email Id is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td><label>Designation :</label></td>
                    <td>
                        <select class="input-block-level" name="designation" ng-model = "designation" invalid-if="{designation == ''}"  required>
                            <option value="">-- Select One --</option>
                            <option value="G.M.O.">G.M.O.</option>
                            <option value="V.P.">V.P.</option>
                            <option value="S.V.P.">S.V.P.</option>
                            <option value="S.E.V.P.">S.E.V.P.</option>
                            <option value="F.A.V.P.">F.A.V.P.</option>
                            <option value="P.O.">P.O.</option>
                            <option value="S.O.">S.O.</option>
                            <option value="S.E.O.">S.E.O.</option>
                            <option value="E.O.">E.O.</option>
                        </select>
                    </td>
                    <td><label>Joining Date :</label></td>
                    <td><input type="text" id="" class="input-block-level datepicker" name="joining_date"  ng-model = "joining_date" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.designation.$dirty && registerForm.designation.$invalid">
                            <span ng-show = "registerForm.designation.$error.required">Name is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.joining_date.$dirty && registerForm.joining_date.$invalid">
                            <span ng-show = "registerForm.joining_date.$error.required">Name is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td><label>Branch Name :</label></td>
                    <td><input type="text" class="input-block-level" name="branch_name" ng-model = "branch_name" required></td>
                    <td><label>Controlling Office :</label></td>
                    <td><input type="text" class="input-block-level" name="controlling_office" ng-model = "controlling_office" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.branch_name.$dirty && registerForm.branch_name.$invalid">
                            <span ng-show = "registerForm.branch_name.$error.required">branch name is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.controlling_office.$dirty && registerForm.controlling_office.$invalid">
                            <span ng-show = "registerForm.controlling_office.$error.required">controlling office is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td><label>Area : </label></td>
                    <td><input type="text" class="input-block-level" name="area" ng-model = "area" required></td>
                    <td><label> District: </label></td>
                    <td>
                        <select class="input-block-level" name="district" ng-model = "district" invalid-if="{district == ''}" required>
                            <option value="">-- Select Blood Group --</option>
                            <option value="Barguna">Barguna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Bhola">Bhola</option>
                            <option value="Jhalokati">Jhalokati</option>
                            <option value="Patuakhali">Patuakhali</option>
                            <option value="Pirojpur">Pirojpur</option>
                            <option value="Bandarban">Bandarban</option>
                            <option value="Brahmanbaria">Brahmanbaria</option>
                            <option value="Chandpur">Chandpur</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Comilla">Comilla</option>
                            <option value="Cox's Bazar">Cox's Bazar</option>
                            <option value="Feni">Feni</option>
                            <option value="Khagrachhari">Khagrachhari</option>
                            <option value="Lakshmipur">Lakshmipur</option>
                            <option value="Noakhali">Noakhali</option>
                            <option value="Rangamati">Rangamati</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Faridpur">Faridpur</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Gopalganj">Gopalganj</option>
                            <option value="Kishoreganj">Kishoreganj</option>
                            <option value="Madaripur">Madaripur</option>
                            <option value="Manikganj">Manikganj</option>
                            <option value="Munshiganj">Munshiganj</option>
                            <option value="Narayanganj">Narayanganj</option>
                            <option value="Narsingdi">Narsingdi</option>
                            <option value="Rajbari">Rajbari</option>
                            <option value="Shariatpur">Shariatpur</option>
                            <option value="Tangail">Tangail</option>
                            <option value="Bagerhat">Bagerhat</option>
                            <option value="Chuadanga">Chuadanga</option>
                            <option value="Jessore">Jessore</option>
                            <option value="Jhenaidah">Jhenaidah</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Kushtia">Kushtia</option>
                            <option value="Magura">Magura</option>
                            <option value="Meherpur">Meherpur</option>
                            <option value="Narail">Narail</option>
                            <option value="Satkhira">Satkhira</option>
                            <option value="Jamalpur">Jamalpur</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Netrokona">Netrokona</option>
                            <option value="Sherpur">Sherpur</option>
                            <option value="Bogra">Bogra</option>
                            <option value="Joypurhat">Joypurhat</option>
                            <option value="Naogaon">Naogaon</option>
                            <option value="Natore">Natore</option>
                            <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                            <option value="Pabna">Pabna</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Sirajganj">Sirajganj</option>
                            <option value="Dinajpur">Dinajpur</option>
                            <option value="Gaibandha">Gaibandha</option>
                            <option value="Kurigram">Kurigram</option>
                            <option value="Lalmonirhat">Lalmonirhat</option>
                            <option value="Nilphamari">Nilphamari</option>
                            <option value="Panchagarh">Panchagarh</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Thakurgaon">Thakurgaon</option>
                            <option value="Habiganj">Habiganj</option>
                            <option value="Moulvibazar">Moulvibazar</option>
                            <option value="Sunamganj">Sunamganj</option>
                            <option value="Sylhet">Sylhet</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.area.$dirty && registerForm.area.$invalid">
                            <span ng-show = "registerForm.area.$error.required">Area is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.district.$dirty && registerForm.district.$invalid">
                            <span ng-show = "registerForm.district.$error.required">District is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td><label>Date of Birth :</label></td>
                    <td><input type="text" class="input-block-level datepicker" name="dob" ng-model = "dob" required></td>
                    <td><label>User Name :</label></td>
                    <td><input type="text" class="input-block-level" name="user_name" ng-model = "user_name" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.dob.$dirty && registerForm.dob.$invalid">
                            <span ng-show = "registerForm.dob.$error.required">Date of Birth is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.user_name.$dirty && registerForm.user_name.$invalid">
                            <span ng-show = "registerForm.user_name.$error.required">user name is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td><label>Index No :</label></td>
                    <td><input type="text" class="input-block-level" name="index_no" ng-model = "index_no" required></td>
                    <td><label>Password :</label></td>
                    <td> <input type="password" class="input-block-level" name="password" ng-model = "password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.index_no.$dirty && registerForm.index_no.$invalid">
                            <span ng-show = "registerForm.index_no.$error.required">Index No is required.</span>
                        </span> 
                    </td>
                    <td></td>
                    <td>
                        <span style = "color:red" ng-show = "registerForm.password.$dirty && registerForm.password.$invalid">
                            <span ng-show = "registerForm.password.$error.required">Password is required.</span>
                        </span> 
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-large btn-success" 
                                ng-disabled = "registerForm.name.$dirty && registerForm.name.$invalid ||
                                                registerForm.blood_group.$dirty && registerForm.blood_group.$invalid ||
                                                registerForm.contact_no.$dirty && registerForm.contact_no.$invalid ||
                                                registerForm.email_id.$dirty && registerForm.email_id.$invalid ||
                                                registerForm.designation.$dirty && registerForm.designation.$invalid ||
                                                registerForm.joining_date.$dirty && registerForm.joining_date.$invalid ||
                                                registerForm.branch_name.$dirty && registerForm.branch_name.$invalid ||
                                                registerForm.controlling_office.$dirty && registerForm.controlling_office.$invalid ||
                                                registerForm.area.$dirty && registerForm.area.$invalid ||
                                                registerForm.district.$dirty && registerForm.district.$invalid ||
                                                registerForm.dob.$dirty && registerForm.dob.$invalid ||
                                                registerForm.user_name.$dirty && registerForm.user_name.$invalid ||
                                                registerForm.index_no.$dirty && registerForm.index_no.$invalid ||
                                                registerForm.password.$dirty && registerForm.password.$invalid" 
                                type="submit">Submit</button></td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>