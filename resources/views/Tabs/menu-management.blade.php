<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu Management</h1>
</div>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Menu List</h6>

        <div>
            <button class="btn btn-info" data-mode="add-menu" data-toggle="modal" data-target="#viewCategoriesModal">
                View Categories
            </button>
    
            <button class="btn btn-primary" data-mode="add-menu" data-toggle="modal" data-target="#addEditMenuModal">
                <i class="fas fa-plus me-2"></i>
                Add Menu
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Table 1</td>
                        <td>2</td>
                        <td>Dessert</td>
                        <td>
                            <button class="btn btn-success">Available</button>
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-mode="edit-menu" data-target="#addEditMenuModal">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteMenuModal">
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
<div class="modal fade" id="addEditMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tableName" class="mb-0">Menu Name</label>
                            <input type="text" class="form-control" name="menuName"
                                placeholder="">  
                        </div>

                        <div class="col-sm-6">
                            <label for="tableCapacity" class="mb-0">Price</label>
                            <input type="number" class="form-control" name="menuPrice"
                                placeholder="">
                        </div>                                       
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-sm-6 mb-3 mb-sm-0">
                            <label for="tableCapacity" class="mb-0">Category</label>
                            <select class="form-select-user form-control" name="gender">
                                <option value="" selected disabled>Select Category</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Appetizer">Appetizer</option>
                              </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="tableStatus">Availability</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tableStatus" checked>
                                <label class="form-check-label">
                                  Available
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="tableStatus">
                                <label class="form-check-label">
                                  Unavailable
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

<!-- View Categories Modal -->
<div class="modal fade" id="viewCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width: 550px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">Category List</h6>
            
                    <div>
                        <button class="btn btn-primary" onClick="add()">
                            <i class="fas fa-plus me-2"></i>
                            Add Category
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th class="w-25">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Category Modal -->
<div class="modal fade" id="addEditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditCategory_title">Edit Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="category_addEditForm" action="javascript:void(0)" method="POST">
                <input type="hidden" name="id" id="id">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName" class="mb-0">Category Name</label>
                        <input type="text" class="form-control" name="categoryName"
                            placeholder="">            

                        <div class="invalid-feedback" id="categoryName_invalid">
                            
                        </div>
                    </div>     
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal-->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu Deletion Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                Do you really want to delete this Menu?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="category_deleteForm" action="javascript:void(0)" method="POST">
                    <button class="btn btn-primary" type="submit">Yes, Delete this category</button>
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

        $('#category_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('menu-management') }}',
            columns:[
                {data: 'categoryName', name: 'categoryName'},
                {data: 'action', name: 'action', orderable: false}
            ],
            order:[[0, 'desc']]
        });
    });

    $('#category_addEditForm').on('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('category-store') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $('#addEditCategoryModal').modal('toggle');

                updateDataTable();
                showAlert('success','Successfully Added/Updated.');
            },
            error: (data) =>{
                $('input[name="categoryName"]').addClass('is-invalid');
                $('#categoryName_invalid').text(data['responseJSON'].errors.categoryName[0])
            }
        });
    });

    function add(){
        $('#addEditCategoryModal').modal('show');
        $('#addEditCategory_title').text('Add Category');
        $('#id').val('');
        $('input[name="categoryName"]').val('');

        if($('input[name="categoryName"]').hasClass('is-invalid')){
            $('input[name="categoryName"]').removeClass('is-invalid');
        }
    }

    function showEditModal(id){
        $.ajax({
            type:'POST',
            url: '{{ route('category-edit') }}',
            data: { id: id },
            dataType: 'json',
            success: function(response){
                $('#addEditCategory_title').text('Edit Table');
                $('#addEditCategoryModal').modal('show');
                $('#id').val(response.id);
                $('input[name="categoryName"]').val(response.categoryName);

                if($('input[name="categoryName"]').hasClass('is-invalid')){
                    $('input[name="categoryName"]').removeClass('is-invalid');
                }
            }
        });
    }

    //Delete Table
    function destroy(id){
        $('#deleteMenuModal').modal('show');

        $('#category_deleteForm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type:'POST',
                url: '{{ route('category-destroy') }}',
                data: { id: id },
                dataType: 'json',
                success: function(response){
                    $('#deleteMenuModal').modal('hide');
                    updateDataTable();
                    showAlert('success','Table has been successfully deleted.');
                }
            });
        });  
    }

    //refresh data table
    function updateDataTable(){
        var oTable = $('#category_table').dataTable();
        oTable.fnDraw(false);
    }
</script>