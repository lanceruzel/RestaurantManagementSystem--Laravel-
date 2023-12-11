<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Table Management</h1>
</div>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Table List</h6>
        <button class="btn btn-primary" data-mode="add-table" data-toggle="modal" data-target="#addEditTableModal">
            <i class="fas fa-plus me-2"></i>
            Add Table
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table 1</td>
                        <td>2</td>
                        <td>
                            <button class="btn btn-success">Active</button>
                        </td>
                        <td>
                            <button class="btn btn-danger">Booked</button>
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-mode="edit-table" data-target="#addEditTableModal">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteTableModal">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Add/Edit Modal-->
<div class="modal fade" id="addEditTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Table</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tableName" class="mb-0">Table Name</label>
                            <input type="text" class="form-control" name="tableName"
                                placeholder="">  
                        </div>

                        <div class="col-sm-6">
                            <label for="tableCapacity" class="mb-0">Table Capacity</label>
                            <input type="number" class="form-control" name="tableCapacity"
                                placeholder="">
                        </div>                                       
                    </div>

                    <div class="form-group row">
                        <div class="form-group col">
                            <label for="tableStatus">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tableStatus" checked>
                                <label class="form-check-label">
                                  Actice
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="tableStatus">
                                <label class="form-check-label">
                                  Inactive
                                </label>
                            </div>
                        </div>      
                        
                        <div class="form-group col">
                            <label for="tableStatus">Availability</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tableAvailability" checked>
                                <label class="form-check-label">
                                  Available
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="tableAvailability">
                                <label class="form-check-label">
                                  Booked
                                </label>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Update</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal-->
<div class="modal fade" id="deleteTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Table Deletion Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                Do you really want to delete this Table?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="#">Yes, Delete this table</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>