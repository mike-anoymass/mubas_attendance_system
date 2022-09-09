
<div class="modal" id="userAdd">
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
                    <li class="nav-link active"><a data-toggle="tab" href="#basicDetails">
                            <b>Personal Details</b></a></li>
                    <li class="nav-link"><a data-toggle="tab" href="#securityDetails">
                            <b>Security Details</b></a></li>

                </ul>

                <div class="tab-content">
                    <div id="basicDetails" class="tab-pane active">
                        <div class="panel panel-default" style="margin-top:6px">

                            <section class="panel-body">
                                <form name="data" id="data"
                                      action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                    <div class="form-group">
                                        <input type="text" name="firstName" class="form-control"
                                               autocomplete="off" placeholder="First Name"
                                               pattern="[a-zA-Z\s]+" title="only text allowed" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="lastName" class="form-control"
                                               autocomplete="off" placeholder="Last name"
                                               pattern="[a-zA-Z\s]+" title="only text allowed" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control"
                                               autocomplete="off" placeholder="User Name"
                                               body       required>
                                    </div>

                                    <div class="form-check">
                                        <input type="radio" name="gender" id="male"
                                               class="form-check-input" value="male" checked>
                                        <label for="male" class="form-check-label" >Male</label>

                                        <?php for ($i = 0; $i < 15; $i++) echo "&nbsp;" ?>

                                        <input type="radio" name="gender" id="female"
                                               class="form-check-input" value="female">
                                        <label for="female" class="form-check-label">Female</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="phone" name="phone" class="form-control"
                                               autocomplete="off" placeholder="Telephone"
                                               pattern="[0-9\s]+" title="Only Numbers allowed" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                               autocomplete="off" placeholder="Email Address" required>
                                    </div>


                            </section>
                        </div>

                    </div>

                    <div id="securityDetails" class="tab-pane ">
                        <div class="panel panel-default" style="margin-top:6px">

                            <section class="panel-body">

                                <div class="form-group">
                                    <label for="typeOfUser">Select User Type:</label>
                                    <select class="form-control" id="typeOfUser" name="typeOfUser">

                                        <option>----Select Type-----</option>
                                        <option>Administrator</option>
                                        <option>Secretary</option>
                                        <option>Technician</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="passwd1" class="form-control" id="password1"
                                           autocomplete="off" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwd2" class="form-control" id="password2"
                                           autocomplete="off" placeholder="Re-Enter Password" required>
                                </div>

                            </section>
                        </div>

                    </div>
                </div>
                    <input type="submit" id="create" class="btn btn-primary btn-block"
                           value="Add User">
                    </form>


            </div>


        </div>
    </div>
</div>