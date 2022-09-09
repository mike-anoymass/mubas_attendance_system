<!-- Add -->
<div class="modal fade" id="importModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-center">Browse Students Excel File
                    <span type="button" class="close fa fa-close" data-dismiss="modal"></span>
                </h3>
            </div>

            <div class="modal-body">

                <div class="panel panel-default" style="margin-top:6px">

                    <section class="panel-body">
                        <form method="post" id="upload_csv" enctype="multipart/form-data" >
                            <div class="form-group">
                                <input type="file" name="student_file" accept=".csv" required>
                                <br>
                                <input type="submit" id="upload" name="upload"
                                       class="btn btn-primary btn-block"
                                       value="Upload">
                            </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
</div>


     