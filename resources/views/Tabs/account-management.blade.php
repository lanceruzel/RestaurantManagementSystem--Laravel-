<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Account Management</h1>
</div>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Account List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>
                            <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-target="#editAccountModal">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteAccountModal">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="firstName" class="mb-0">First Name</label>
                            <input type="text" class="form-control" name="firstName"
                                placeholder="">  
                        </div>

                        <div class="col-sm-6">
                            <label for="middleName" class="mb-0">Middle Name</label>
                            <input type="text" class="form-control" name="middleName"
                                placeholder="">
                        </div>                                       
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="mb-0">Last Name</label>
                        <input type="text" class="form-control" name="lastName"
                            placeholder="">
                    </div>

                    <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="birthdate" class="mb-0">Birthdate</label>
                                <input type="date" class="form-control" name="birthdate"
                                    placeholder="">
                            </div>

                            <div class="col-sm-6">
                                <label for="gender" class="mb-0">Gender</label>
                                <select class="form-select-user form-control" name="gender">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    </select>
                            </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="address" class="mb-0">Address</label>
                            <input type="text" class="form-control" name="address"
                                placeholder="">
                        </div>

                        <div class="col-sm-6">
                            <label for="contact" class="mb-0">Contact Number</label>
                            <input type="text" class="form-control" name="contact"
                                placeholder="Contact Number">
                        </div>   
                    </div>

                    <div class="form-group">
                        <label for="email" class="mb-0">Email</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="">
                    </div>
                
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#viewWorkInfoModal" data-dismiss="modal">View Work Information</a>
                    <a class="btn btn-primary" href="#">Update</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Work Information Modal -->
<div class="modal fade" id="viewWorkInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Juan Dela Cruz's Work Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="gender" class="mb-0">Role</label>
                            <select class="form-select-user form-control" name="gender">
                                <option value="" selected disabled>Select Role</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="salary" class="mb-0">Salary</label>
                            <input type="number" class="form-control" name="salary"
                                placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="salary" class="mb-0">Started Date</label>
                            <input type="date" class="form-control" name="startedDate"
                                placeholder="">
                        </div>

                        <div class="col-sm-6">
                            <label for="birthdate" class="mb-0">Ended Date</label>
                            <input type="date" class="form-control" name="endedDate"
                                placeholder="">
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
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Account Deletion Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                Do you really want to delete this account?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="#">Yes, Delete this account</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>