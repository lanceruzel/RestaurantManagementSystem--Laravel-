<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->employee->firstName . ' ' . auth()->user()->employee->lastName}}
                </span>
                <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <buton class="dropdown-item" onClick="openChangePasswordModal('Change Password')">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </buton>
                <button class="dropdown-item" onClick="openChangePasswordModal('Change Email')">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Email
                </button>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>
</nav>

<div class="modal fade" id="changePasswordEmail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordEmail_title">Change Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="javascript:void(0)" id="changePasswordEmailForm" method="POST">
                <div class="modal-body">
                    <div class="alert alert-success d-none" role="alert" id="changePasswordEmailAlert">
                        <span id="changePasswordEmailAlert_message">Test</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="mb-3" id="currentFielContainer">
                        <label id="currentFieldTitle">Current Email</label>
                        <input type="text" id="currentValueField" class="form-control" name="current_password">
                        <div class="invalid-feedback" id='currentValueFieldError'>
                            
                        </div>
                    </div>

                    <div class="mb-3">
                        <label id="newValueFieldTitle">New Password</label>
                        <input type="password" id="newValueField" class="form-control" name="password">
                        <div class="invalid-feedback" id='newValueFieldError'>
                            
                        </div>
                    </div>

                    <div id="confirmFieldContainer">
                        <label>Confirm Password</label>
                        <input type="password" id="confirmField" class="form-control" name="password_confirmation">
                        <div class="invalid-feedback" id='confirmFieldError'>
                            
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick="">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let user = {!! auth()->user()->toJson() !!};

    console.log(user);
    let changePasswordEmailModal = $('#changePasswordEmail_modal');
    let changePasswordEmailModalTitle = $('#changePasswordEmail_title');

    let currentField = $('#currentValueField');
    let newField = $('#newValueField');
    let confirmField = $('#confirmField');

    let currentFieldError = $('#currentValueFieldError');
    let newFieldError = $('#newValueFieldError');
    let confirmFieldError = $('#confirmFieldError');

    let currentFieldTitle = $('#currentFieldTitle');
    let newValueFieldTitle = $('#newValueFieldTitle');

    let currentFieldContainer = $('#currentFielContainer');
    let confirmFieldContainer = $('#confirmFieldContainer');

    let alertContainer = $('#changePasswordEmailAlert');
    let alertContainerMsg = $('#changePasswordEmailAlert_message');

    function openChangePasswordModal(title){
        var mode = '';

        currentField.removeClass('is-invalid');
        newField.removeClass('is-invalid');
        confirmField.removeClass('is-invalid');

        newField.val('');
        confirmField.val('');

        changePasswordEmailModal.modal('toggle');
        changePasswordEmailModalTitle.text(title);

        if(title === 'Change Password'){
            mode = 'password';
            console.log(mode);

            newField.attr('type', 'password');

            confirmFieldContainer.removeClass('d-none');

            newValueFieldTitle.text('New Password');

            newField.attr('name', 'password');

            currentFieldTitle.text('Current Password');
            currentField.attr('readonly', false);
            currentField.val('');
            currentField.attr('type', 'password');

        }else if(title === 'Change Email'){
            mode = 'email';

            console.log(mode);

            newField.attr('type', 'text');

            confirmFieldContainer.addClass('d-none');

            currentField.val(user['email']);
            newValueFieldTitle.text('New Email');

            newField.attr('name', 'email');

            currentFieldTitle.text('Current Email');
            currentField.attr('readonly', true);
            currentField.attr('type', 'text');
        }

        $('#changePasswordEmailForm').on('submit', function(e){
            e.preventDefault();

            if(currentField.val() === null || currentField.val() === ''){
                currentField.addClass('is-invalid');
                currentFieldError.text('Please enter your current password');
            }

            let formData = new FormData();
            formData.set('id', user['id']);

            if(mode === 'email'){
                formData.set('email', newField.val());
            }

            if(mode === 'password'){
                formData.set('current_password', currentField.val());
                formData.set('password', newField.val());
                formData.set('password_confirmation', confirmField.val());
            }

            $.ajax({
                type: 'POST',
                url:  mode === 'email' ? '{{ route('account-change-email') }}' : '{{ route('account-change-password') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) =>{

                    if(mode === 'email'){
                        alertContainer.removeClass('d-none');
                        alertContainerMsg.text('Email successfully updated.');
                        currentField.val(newField.val());
                        newField.val('');
                    }
                    
                    if(mode === 'password'){

                        if(data['old_pass_error']){
                            currentField.addClass('is-invalid');
                            currentFieldError.text('Password does not match to your current password.');
                        }else{
                            alertContainer.removeClass('d-none');
                            alertContainerMsg.text('Password successfully updated.');
                            newField.removeClass('is-invalid');
                            newField.val('');
                            confirmField.removeClass('is-invalid');
                            confirmField.val('');
                            currentField.removeClass('is-invalid');
                            currentField.val('');
                        }        
                    }
                },
                error: (data) =>{
                    if(data['responseJSON'].errors.email){
                        newField.addClass('is-invalid');
                        newFieldError.text(data['responseJSON'].errors.email[0]);
                    } 

                    if(data['old_pass_error']){
                        currentField.addClass('is-invalid');
                        currentFieldError.text(data['old_pass_error']);
                    }

                    if(data['responseJSON'].errors.password){
                        newField.addClass('is-invalid');
                        
                        if(data['responseJSON'].errors.password.length > 0){
                            let message = '';

                            for(i = 0; i < data['responseJSON'].errors.password.length; i++){
                                message += (' ' + data['responseJSON'].errors.password[i]);
                            }

                            newFieldError.text(message);
                        }else{
                            newFieldError.text(data['responseJSON'].errors.password[0]);
                        }
                        
                    } 
                }
            });
        });
    }
</script>