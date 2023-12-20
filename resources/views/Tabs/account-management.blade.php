<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Account Management</h1>
</div>

<x-alert/>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Account List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="account_table" width="100%" cellspacing="0">
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
            </table>
        </div>
    </div>
</div>

<!--Edit Perosnal Information Modal-->
<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Personal Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="javascript:void(0)" id="form_editPersonalInformation" method="POST">
                <input type="hidden" name="id" class="id" id="id">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="firstName" class="mb-0">First Name</label>
                            <input type="text" class="form-control" name="firstName" id="modalEdit_firstName"
                                placeholder="">  

                            <div class="invalid-feedback" id="firstName_invalid"></div>
                        </div>

                        <div class="col-sm-6">
                            <label for="middleName" class="mb-0">Middle Name</label>
                            <input type="text" class="form-control" name="middleName" id="modalEdit_middleName"
                                placeholder="">

                            <div class="invalid-feedback" id="middleName_invalid"></div>
                        </div>                                       
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="mb-0">Last Name</label>
                        <input type="text" class="form-control" name="lastName" id="modalEdit_lastName"
                            placeholder="">

                        <div class="invalid-feedback" id="lastName_invalid"></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="birthdate" class="mb-0">Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" id="modalEdit_birthdate"
                                placeholder="">

                            <div class="invalid-feedback" id="birthdate_invalid"></div>
                        </div>

                        <div class="col-sm-6">
                            <label for="gender" class="mb-0">Gender</label>
                            <select class="form-select-user form-control" name="gender" id="modalEdit_gender">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>

                            <div class="invalid-feedback" id="gender_invalid"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="address" class="mb-0">Address</label>
                            <input type="text" class="form-control" name="address" id="modalEdit_address"
                                placeholder="">

                            <div class="invalid-feedback" id="address_invalid"></div>
                        </div>

                        <div class="col-sm-6">
                            <label for="contact" class="mb-0">Contact Number</label>
                            <input type="text" class="form-control" name="contact" id="modalEdit_contact"
                                placeholder="">

                            <div class="invalid-feedback" id="contact_invalid"></div>
                        </div>   
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#updateAccountInformationModal">Change account information</button>
                    <button class="btn btn-primary" type="submit" id="btn_updateEmployeeInformation">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Account Information Modal-->
<div class="modal fade" id="updateAccountInformationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Email</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="javascript:void(0)" id="form_editAccountInformation" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" class="id" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email" class="mb-0">Email</label>
                            <input type="email" class="form-control" name="email" id="modalEdit_email"
                                placeholder="">

                            <div class="invalid-feedback" id="email_invalid"></div>
                        </div>         

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="email" class="mb-0">Role</label>
                                <select class="form-select-user form-control" name="role" id="modalEdit_role">
                                    <option value="" selected disabled>Select Role</option>
                                    <option value="None">None</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Receptionist">Receptionist</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" id="btn_updateEmployeeInformation">Update</button>
                    </div>
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
                <form id="form_deleteAccount" action="javascript:void(0)" method="POST">
                    <button class="btn btn-primary" type="submit">Yes, Delete this account</butt>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let firstNameField = $('#modalEdit_firstName');
    let firstNameInvalid = $('#firstName_invalid');
    let middleNameField = $('#modalEdit_middleName');
    let middleNameInvalid = $('#middleName_invalid');
    let lastnameNameField = $('#modalEdit_lastName');
    let lastnameNameInvalid = $('#lastName_invalid');
    let birthdateField = $('#modalEdit_birthdate');
    let birthdateInvalid = $('#birthdate_invalid');
    let genderField = $('#modalEdit_gender');
    let genderInvalid = $('#gender_invalid');
    let addressField = $('#modalEdit_address');
    let addressInvalid = $('#address_invalid');
    let contactField = $('#modalEdit_contact');
    let contactInvalid = $('#contact_invalid');
    let emailField = $('#modalEdit_email');
    let emailInvalid = $('#email_invalid');

    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Category data table
        $('#account_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('account-management') }}',
            columns:[
                {data: 'fullname', name: 'fullname'},
                {data: 'address', name: 'address'},
                {data: 'contact', name: 'contact'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action', orderable: false}
            ],
            order:[[0, 'desc']]
        });
    });

    $('#form_editAccountInformation').on('submit', function(e){
        e.preventDefault();

        clearEntries();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('account-update') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $('#updateAccountInformationModal').modal('hide');

                updateDataTable('#account_table');
                showAlert('success','Successfully Added/Updated.');
            },
            error: (data) =>{
                if(data['responseJSON'].errors.email){
                    emailField.addClass('is-invalid');
                    emailInvalid.text(data['responseJSON'].errors.email[0]);
                } 
            }
        });
    });
    
    $('#form_editPersonalInformation').on('submit', function(e){
        e.preventDefault();

        clearEntries();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('account-personal-update') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $('#editAccountModal').modal('hide');

                updateDataTable('#account_table');
                showAlert('success','Successfully Updated.');
            },
            error: (data) =>{
                if(data['responseJSON'].errors.firstName){
                    firstNameField.addClass('is-invalid');
                    firstNameInvalid.text(data['responseJSON'].errors.firstName[0]);
                } 

                if(data['responseJSON'].errors.middleName){
                    middleNameField.addClass('is-invalid');
                    middleNameInvalid.text(data['responseJSON'].errors.middleName[0]);
                } 

                if(data['responseJSON'].errors.lastName){
                    lastnameNameField.addClass('is-invalid');
                    lastnameNameInvalid.text(data['responseJSON'].errors.lastName[0]);
                } 

                if(data['responseJSON'].errors.birthdate){
                    birthdateField.addClass('is-invalid');
                    birthdateInvalid.text(data['responseJSON'].errors.birthdate[0]);
                } 

                if(data['responseJSON'].errors.gender){
                    genderField.addClass('is-invalid');
                    genderInvalid.text(data['responseJSON'].errors.gender[0]);
                } 

                if(data['responseJSON'].errors.address){
                    addressField.addClass('is-invalid');
                    addressInvalid.text(data['responseJSON'].errors.address[0]);
                } 

                if(data['responseJSON'].errors.contact){
                    contactField.addClass('is-invalid');
                    contactInvalid.text(data['responseJSON'].errors.contact[0]);
                } 
            }
        });
    });

    function clearEntries(){
        emailField.removeClass('is-invalid');
        firstNameField.removeClass('is-invalid');
        middleNameField.removeClass('is-invalid');
        lastnameNameField.removeClass('is-invalid');
        birthdateField.removeClass('is-invalid');
        genderField.removeClass('is-invalid');
        addressField.removeClass('is-invalid');
        contactField.removeClass('is-invalid');
    }

    function showEditModal(id){
        $.ajax({
            type:'POST',
            url: '{{ route('account-view') }}',
            data: { id: id },
            dataType: 'json',
            success: function(response){
                $('#editAccountModal').modal('show');
                $('.id').val(response.accountID);
                $('#modalEdit_firstName').val(response.firstName);
                $('#modalEdit_middleName').val(response.middleName);
                $('#modalEdit_lastName').val(response.lastName);
                $('#modalEdit_birthdate').val(response.birthdate);
                $('#modalEdit_gender').val(response.gender);
                $('#modalEdit_address').val(response.address);
                $('#modalEdit_contact').val(response.contact);
                $('#modalEdit_email').val(response.email);
                $('#modalEdit_role').val(response.role);
            }
        });
    }

    function showDestroyModel(id){
        $('#deleteAccountModal').modal('show');

        $('#form_deleteAccount').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type:'POST',
                url: '{{ route('account-destroy') }}',
                data: { id: id },
                dataType: 'json',
                success: function(response){
                    $('#deleteAccountModal').modal('hide');
                    updateDataTable('#category_table');
                    showAlert('success','Account has been successfully deleted.');
                }
            });
        });  
    }
</script>