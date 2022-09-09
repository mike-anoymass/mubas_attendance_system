<?php
    require_once "classAutoload.php";

    if(isset($_GET['export']) && $_GET['export'] == "excel"){
        $output = "";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=users.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $user = new UsersView();
        $data = $user->getUsers();

        if ($data != "Users not found") {
            $output .= '
                        <table class="table table-sm table-bordered table-hover" 
                        id="userTable" style="background-color:#8aa4af">
                        <thead>
                            <tr class="text-center">
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Type Of User</th>
                                <th>Password</th>
                                <th>Date Registered</th>
                            </tr>
                        </thead>
            
                        <tbody>';

            foreach ($data as $rows) {
                $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['username'].'</td>
                                <td>'.$rows['firstname'].'</td>
                                <td>'.$rows['lastname'].'</td>
                                <td>'.$rows['phone'].'</td>
                                 <td>'.$rows['email'].'</td>
                                <td>'.$rows['gender'].'</td>
                                <td>'.$rows['typeOfUser'].'</td>
                                 <td>'.$rows['password'].'</td>
                                <td>'.$rows['dateRegistered'].'</td>
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;
        }
    }


?>