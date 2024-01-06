<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Table Management</h1>
</div>

<x-alert/>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Table List</h6>
        <button class="btn btn-primary" data-mode="add-table" onClick="add()">
            <strong>+</strong> Add Menu
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="table_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!--Add/Edit Modal-->
<div class="modal fade" id="addEditTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditTableModal_title">Add Table</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="table_addEditForm" action="javascript:void(0)" method="POST">
                <input type="hidden" name="id" id="id">

                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tableName" class="mb-0">Table Name</label>
                            <input type="text" class="form-control" name="tableName" id="tableName"
                                placeholder="">  

                            <div class="invalid-feedback" id="tableName_invalid"></div>
                        </div>

                        <div class="col-sm-6">
                            <label for="tableCapacity" class="mb-0">Table Capacity</label>
                            <input type="number" class="form-control" name="tableCapacity" id="tableCapacity"
                                placeholder="">

                            <div class="invalid-feedback" id="tableCapacity_invalid"></div>
                        </div>                                       
                    </div>

                    <div class="form-group row">
                        <div class="form-group col">
                            <label for="tableStatus">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-Active" value="Active" checked>
                                <label class="form-check-label">
                                  Active
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-Inactive" value="Inactive">
                                <label class="form-check-label">
                                  Inactive
                                </label>
                            </div>
                        </div>      
                        
                        <div class="form-group col">
                            <label for="tableStatus">Availability</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" id="availability-Available" value="Available" checked>
                                <label class="form-check-label">
                                  Available
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" id="availability-Unavailable" value="Unavailable">
                                <label class="form-check-label">
                                  Unavailable
                                </label>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</a>
                    <button class="btn btn-primary" type="submit" id="btn_addEditSubmit">Update</button>
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
                <form id="table_deleteForm" action="javascript:void(0)" method="POST">
                    <button class="btn btn-primary" type="submit">Yes, Delete this table</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteModal = $('#deleteTableModal');

    let addEditModal = $('#addEditTableModal');
    let addEditModalTitle = $('#addEditTableModal_title');
    let addEditModalBtn = $('#btn_addEditSubmit');

    let tableNameField = $('#tableName');
    let tableCapacity = $('#tableCapacity');

    let tableNameInvalid = $('#tableName_invalid');
    let tableCapacityInvalid = $('#tableCapacity_invalid');

    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //
        $('#table_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('table-management') }}',
            columns:[
                {data: 'tableName', name: 'tableName'},
                {data: 'tableCapacity', name: 'tableCapacity'},
                {data: 'status',
                    render: function(data, type, row, meta){
                        if(type === 'display'){
                            if(data === 'Active'){
                                data = '<button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Active</button>';
                            }else{
                                data = '<button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Inactive</button>';
                            }

                            return data;
                        }
                    }
                },
                {data: 'availability',
                    render: function(data, type, row, meta){
                        if(type === 'display'){
                            if(data === 'Available'){
                                data = '<button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Available</button>';
                            }else{
                                data = '<button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">Unavailable</button>';
                            }

                            return data;
                        }
                    }
                },
                {data: 'action', name: 'action', orderable: false}
            ],
            order:[[0, 'desc']]
        });
    });

    //Add / Edit Function
    $('#table_addEditForm').on('submit', function(e){
        e.preventDefault();

        tableNameInvalid.removeClass('is-invalid');
        tableCapacityInvalid.removeClass('is-invalid');

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('table-store') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                addEditModal.modal('toggle');
                addEditModalBtn.text('Submit');

                updateDataTable('#table_table');
                showAlert('success','Successfully Added/Updated.');
            },
            error: (data) =>{
                if(data['responseJSON'].errors.tableName){
                    tableNameField.addClass('is-invalid');
                    tableNameInvalid.text(data['responseJSON'].errors.tableName[0]);
                } 

                if(data['responseJSON'].errors.tableCapacity){
                    tableCapacity.addClass('is-invalid');
                    tableCapacityInvalid.text(data['responseJSON'].errors.tableCapacity[0]);
                } 
            }
        });
    });

    //Show Add Modal
    function add(){
        addEditModalTitle.text('Add Table');
        addEditModalBtn.text('Add');
        $('#id').val('');
        addEditModal.modal('show');

        tableNameField.val('');
        tableCapacity.val('');
        
        tableNameInvalid.removeClass('is-invalid');
        tableCapacityInvalid.removeClass('is-invalid');
    }

    //Show Edit Modal
    function showEditModal(id){
        $.ajax({
            type:'POST',
            url: '{{ route('table-edit') }}',
            data: { id: id },
            dataType: 'json',
            success: function(response){
                addEditModalTitle.text('Edit Table');
                addEditModalBtn.text('Update');
                addEditModal.modal('toggle');
                $('#id').val(response.id);
                tableNameField.val(response.tableName);
                tableCapacity.val(response.tableCapacity);

                if(response.status === 'Active'){
                    $('#status-Active').prop('checked', true);
                }else{
                    $('#status-Inactive').prop('checked', true);
                }

                if(response.availability === 'Available'){
                    $('#availability-Available').prop('checked', true);
                }else{
                    $('#availability-Unavailable').prop('checked', true);
                }

                tableNameField.removeClass('is-invalid');
                tableCapacity.removeClass('is-invalid');
            }
        });
    }

    //Delete Table
    function showDestroyModel(id){
        $('#deleteTableModal').modal('toggle');

        $('#table_deleteForm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type:'POST',
                url: '{{ route('table-destroy') }}',
                data: { id: id },
                dataType: 'json',
                success: function(response){
                    deleteModal.modal('toggle');
                    updateDataTable('#table_table');
                    showAlert('success','Table has been successfully deleted.');
                }
            });
        });  
    }
</script>   