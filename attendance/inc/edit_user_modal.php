
<div class="modal" id="editUserModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-center">User Registration Form
                    <span type="button" class="close fa fa-close" data-dismiss="modal"></span>
                </h3>
            </div>

    <!-- Modal body -->
    <div class="modal-body">
        <ul class="nav nav-tabs">
            <li class="nav-link active"><a data-toggle="tab" href="#basicDetails1">
                    <b>Personal Details</b></a></li>
            <li class="nav-link"><a data-toggle="tab" href="#securityDetails1">
                    <b>Security Details</b></a></li>

        </ul>

        <div class="tab-content">
            <div id="basicDetails1" class="tab-pane active">
                <div class="panel panel-default" style="margin-top:6px">

                    <section class="panel-body">
                        <form name="data" id="edit-data"
                              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                            <div class="form-group">
                                <input type="text" name="firstName" class="form-control"
                                       autocomplete="off" placeholder="First Name" id="edit-firstname"
                                       pattern="[a-zA-Z\s]+" title="only text allowed" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="lastName" class="form-control"
                                       autocomplete="off" placeholder="Last name" id="edit-lastname"
                                       pattern="[a-zA-Z\s]+" title="only text allowed" required>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="username" class="form-control"
                                       autocomplete="off" placeholder="User Name" id="edit-username"
                                       required>
                            </div>

                            <div class="form-check">
                                <input type="radio" name="gender" id="edit-male"
                                       class="form-check-input" value="male">
                                <label for="male" class="form-check-label">Male</label>

                                <?php for ($i = 0; $i < 15; $i++) echo "&nbsp;" ?>

                                <input type="radio" name="gender" id="edit-female"
                                       class="form-check-input" value="female">
                                <label for="female" class="form-check-label">Female</label>
                            </div>

                            <div class="form-group">
                                <input type="phone" name="phone" class="form-control" id="edit-phone"
                                       autocomplete="off" placeholder="Telephone"
                                       pattern="[0-9\s]+" title="Only Numbers allowed" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="edit-email"
                                       autocomplete="off" placeholder="Email Address" required>
                            </div>


                    </section>
                </div>

            </div>

            <div id="securityDetails1" class="tab-pane ">
                <div class="panel panel-default" style="margin-top:6px">

                    <section class="panel-body">

                        <div class="form-group">
                            <label for="typeOfUser">Select User Type:</label>
                            <select class="form-control" id="edit-typeOfUser" name="typeOfUser">

                                <option>----Select Type-----</option>
                                <option>Administrator</option>
                                <option>Secretary</option>
                                <option>Technician</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <input type="password" name="passwd1" class="form-control" id="edit-password1"
                                   autocomplete="off" placeholder="Password" required>
                        </div>


                    </section>
                </div>

            </div>
        </div>

        <section style="display:inline;">

            <input type="submit" id="update" class="btn btn-primary btn-block"
                   value="Update">
            </form>

        </section>

    </div>

</div>
</div>