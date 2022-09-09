<!-- Add -->
<div class="modal fade" id="selectProgram">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-center">Program Selection
                    <span type="button" class="close fa fa-close" data-dismiss="modal"></span>
                </h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                        <div class="panel panel-default" style="margin-top:6px">

                            <section class="panel-body">
                                <form id="program-form"
                                      action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                    <label for="program">Make an Allocation For:</label>
                                    <select class="form-control" id="program" name="program">
                                        <option>----Select Program-----</option>
                                        <?php
                                            $programView = new ProgramsView();
                                            $rows = $programView->getAllPrograms();

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>". $row['name']. "</option>";
                                            }
                                        ?>
                                    </select>

                            </section>
                        </div>
                <input type="submit" id="programBtn" class="btn btn-primary btn-block"
                       value="Start Allocation">
            </div>


        </div>
    </div>
</div>


     