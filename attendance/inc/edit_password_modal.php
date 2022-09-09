<!-- Add -->
<div class="modal fade" id="editPassword">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-center">Changing Password
                    <span type="button" class="close fa fa-close" data-dismiss="modal"></span>
                </h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                        <div class="panel panel-default" style="margin-top:6px">

                            <section class="panel-body">
                                <form id="password-form"
                                      action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                    <div class="form-group">
                                        <input type="password" name="oldPassword" class="form-control"
                                               autocomplete="off" placeholder="Enter Old Password" id="oldPassword"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="newPassword" class="form-control"
                                               autocomplete="off" placeholder="Enter New Password" id="newPassword"
                                                required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="confirmPassword" class="form-control"
                                               autocomplete="off" placeholder="Confirm New Password" id="confirmPassword"
                                               required>
                                    </div>

                            </section>
                        </div>
                <input type="submit" id="pwdBtn" class="btn btn-primary btn-block"
                       value="Change Password">
            </div>


        </div>
    </div>
</div>


     