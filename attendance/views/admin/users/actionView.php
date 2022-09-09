<?php

    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] === "view") {
        $output = '';
        $user = new UsersView();
        $data = $user->getUsers();

        if ($data != "Users not found") {
            $output .= '
              
                        <table class="table table-sm table-bordered table-hover" 
                        id="userTable">
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Type Of User</th>
                                <th>Date Registered</th>
                                <th>Actions</th>
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
                                <td>'.$rows['dateRegistered'].'</td>
                                <td>
                                    <a href="#" title="Edit" class="text-primary editBtn" 
                                    data-toggle="modal" data-target="#editUserModal" id="'.$rows['username'].'">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>&nbsp
            
                                    <a href="#" title="Delete" class="text-danger delBtn" id="'.$rows['username'].'">
                                         <i class="fa fa-trash fa-md"></i>
                                    </a>&nbsp
                                    
                                    <a href="#" title="Reset Password" class="text-warning resetBtn" id="'.$rows['username'].'">
                                        <i class="fa fa-refresh fa-md"></i>
                                    </a>
                                </td>
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            No any Users in the database
                        </h3>';
        }
    }
?>