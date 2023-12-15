<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Table Management</h1>
</div>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Table List</h6>
        <button class="btn btn-primary" data-mode="add-table" onClick="add()">
            <i class="fas fa-plus me-2"></i>
            Add Table
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
                        </div>

                        <div class="col-sm-6">
                            <label for="tableCapacity" class="mb-0">Table Capacity</label>
                            <input type="number" class="form-control" name="tableCapacity" id="tableCapacity"
                                placeholder="">
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
            ajax: '{{ route('tableManagement') }}',
            columns:[
                {data: 'tableName', name: 'tableName'},
                {data: 'tableCapacity', name: 'tableCapacity'},
                {data: 'status', name: 'status'},
                {data: 'availability', name: 'availability'},
                {data: 'action', name: 'action', orderable: false}
            ],
            order:[[0, 'desc']]
        });
    });

    $('#table_addEditForm').on('submit', function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('table-store') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $('#addEditTableModal').modal('toggle');
                $("#btn_addEditSubmit").html('Submit');
                $("#btn_addEditSubmit"). attr("disabled", false);

                updateDataTable();
            },
            error: (data) =>{
                console.log(data);
            }
        });
    });

    function add(){
        $('#addEditTableModal_title').text('Add Table');
        $('#btn_addEditSubmit').text('Add');
        $('#id').val('');
        $('#addEditTableModal').modal('toggle');
    }

    //Edit Table
    function edit(id){
        $.ajax({
            type:'POST',
            url: '{{ route('table-edit') }}',
            data: { id: id },
            dataType: 'json',
            success: function(response){
                $('#addEditTableModal_title').text('Edit Table');
                $('#btn_addEditSubmit').text('Update');
                $('#addEditTableModal').modal('toggle');
                $('#id').val(response.id);
                $('#tableName').val(response.tableName);
                $('#tableCapacity').val(response.tableCapacity);

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
            }
        });
    }

    function destroy(id){
        $('#deleteTableModal').modal('toggle');

        $('#table_deleteForm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type:'POST',
                url: '{{ route('table-destroy') }}',
                data: { id: id },
                dataType: 'json',
                success: function(response){
                    $('#deleteTableModal').modal('toggle');
                    updateDataTable();
                }
            });
        });  
    }

    function updateDataTable(){
        var oTable = $('#table_table').dataTable();
        oTable.fnDraw(false);
    }
</script>