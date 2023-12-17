<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu Management</h1>
</div>

<x-alert/>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Menu List</h6>

        <div>
            <button class="btn btn-info" data-mode="add-menu" data-toggle="modal" data-target="#viewCategoriesModal">
                View Categories
            </button>
    
            <button class="btn btn-primary" data-mode="add-menu" onClick="showAddMenuModal()">
                <strong>+</strong> Add Menu
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="menu_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!--Add/Edit Menu Modal-->
<div class="modal fade" id="addEditMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditMenu_title">Edit Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="menu_addEditForm" action="javascript:void(0)" method="POST">
                <input type="hidden" name="id" id="menu_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tableName" class="mb-0">Menu Name</label>
                            <input type="text" class="form-control" name="menuName" id="menuName"
                                placeholder="">  

                            <div class="invalid-feedback" id="menuName_invalid"></div>
                        </div>

                        <div class="col-sm-6">
                            <label for="tableCapacity" class="mb-0">Price</label>
                            <input type="number" class="form-control" name="menuPrice" id="menuPrice"
                                placeholder="">

                            <div class="invalid-feedback" id="menuPrice_invalid"></div>
                        </div>                                       
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-sm-6 mb-3 mb-sm-0">
                            <label for="tableCapacity" class="mb-0">Category</label>
                            <select class="form-select-user form-control" name="menuCategory" id="menuCategory">
                                <option value="" selected disabled id="category_disabled">Select Category</option>
                            </select>

                            <div class="invalid-feedback" id="menuCategory_invalid"></div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="tableStatus">Availability</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" id="menu_available" value="Available" checked>
                                <label class="form-check-label">
                                  Available
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" id="menu_unavailable" value="Unavailable">
                                <label class="form-check-label">
                                  Unavailable
                                </label>
                            </div>
                        </div>   
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="menu_AddEditButton">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Categories Modal -->
<div class="modal fade" id="viewCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="min-width: 550px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Categories</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">Category List</h6>
            
                    <div>
                        <button class="btn btn-primary" onClick="showAddCategoryModal()">
                            <strong>+</strong> Add Menu
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
                <input type="hidden" name="id" id="category_id">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName" class="mb-0">Category Name</label>
                        <input type="text" class="form-control" name="categoryName" id="categoryName"
                            placeholder="">            

                        <div class="invalid-feedback" id="categoryName_invalid"></div>
                    </div>     
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="category_AddEditButton">Update</button>
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

            <div class="modal-body" id="deleteModal_message">
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
    let categoryAddEditModal = $('#addEditCategoryModal');
    let menuAddEditModal = $('#addEditMenuModal');
    let deleteModal = $('#deleteMenuModal');

    let menuID = $('#menu_id');
    let categoryID = $('#category_id');

    let menuNameField = $('#menuName');
    let menuPriceField = $('#menuPrice');
    let menuCategoryField = $('#menuCategory');

    let menuModalBtn = $('#menu_AddEditButton');
    let menuModalTitle = $('#addEditMenu_title');

    let categoryModalBtn = $('#category_AddEditButton');
    let categoryModalTitle = $('#addEditCategory_title');

    let categoryNameField = $('#categoryName');

    let categoryNameInvalid = $('#categoryName_invalid');

    let menuNameInvalid = $('#menuName_invalid');
    let menuPriceInvalid = $('#menuPrice_invalid');
    let menuSelectionInvalid = $('#menuCategory_invalid');

    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Category data table
        $('#category_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('category-view') }}',
            columns:[
                {data: 'categoryName', name: 'categoryName'},
                {data: 'action', name: 'action', orderable: false}
            ],
            order:[[0, 'desc']]
        });

        //Menu data table
        $('#menu_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('menu-management') }}',
            columns:[
                {data: 'menuName', name: 'menuName'},
                {data: 'categoryID', name: 'categoryID'},
                {data: 'menuPrice', name: 'menuPrice'},
                {data: 'availability', name: 'availability'},
                {data: 'action', name: 'action', orderable: false}
            ],
            order:[[0, 'desc']]
        });

        loadCategorySelectOptions();
    });

    // Menu Add Edit Form // Done
    $('#menu_addEditForm').on('submit', function(e){
        e.preventDefault();

        menuCategoryField.removeClass('is-invalid');
        menuNameField.removeClass('is-invalid');
        menuPriceField.removeClass('is-invalid');

        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('menu-store') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                menuAddEditModal.modal('toggle');

                updateDataTable('#menu_table');
                showAlert('success','Successfully Added/Updated.');
            },
            error: (data) =>{
                if(data['responseJSON'].errors.menuName){
                    menuNameField.addClass('is-invalid');
                    menuNameInvalid.text(data['responseJSON'].errors.menuName[0]);
                } 

                if(data['responseJSON'].errors.menuPrice){
                    menuPriceField.addClass('is-invalid');
                    menuPriceInvalid.text(data['responseJSON'].errors.menuPrice[0]);
                } 

                if(data['responseJSON'].errors.menuCategory){
                    menuCategoryField.addClass('is-invalid');
                    menuSelectionInvalid.text(data['responseJSON'].errors.menuPrice[0]);
                } 
            }
        });
    });

    // Add Menu
    function showAddMenuModal(){
        menuAddEditModal.modal('show');
        menuModalTitle.text('Add Menu');
        menuModalBtn.text('Add');
        menuID.val('');
        menuNameField.val('');
        menuPriceField.val('');

        $('#category_disabled').prop('disabled', false);
        $('#category_disabled').prop('selected', true);
        $('#category_disabled').prop('disabled', true);

        menuCategoryField.removeClass('is-invalid');
        menuNameField.removeClass('is-invalid');
        menuPriceField.removeClass('is-invalid');
        $('#menu_available').prop('checked', true);
    }

    // Category Add Edit Form
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
                categoryAddEditModal.modal('hide');

                updateDataTable('#category_table');
                updateDataTable('#menu_table');
                loadCategorySelectOptions();
                showAlert('success','Successfully Added/Updated.');
            },
            error: (data) =>{
                if(data['responseJSON'].errors.categoryName[0]){
                    categoryNameField.addClass('is-invalid');
                    categoryNameInvalid.text(data['responseJSON'].errors.categoryName[0]);
                } 
            }
        });
    });

    // Add Category
    function showAddCategoryModal(){
        categoryAddEditModal.modal('show');
        categoryModalTitle.text('Add Category');
        categoryModalBtn.text('Add');
        categoryID.val('');
        categoryNameField.val('');
        categoryNameField.removeClass('is-invalid');
    }

    // Show edit modal
    function showEditModal(id){
        menuCategoryField.removeClass('is-invalid');
        menuNameField.removeClass('is-invalid');
        menuPriceField.removeClass('is-invalid');

        //Get Table that triggered this function
        let tableID = event.target.closest('table').getAttribute('id');
        //console.log(tableID)

        $.ajax({
            type:'POST',
            url: tableID === 'menu_table' ? '{{ route('menu-edit') }}' : '{{ route('category-edit') }}',
            data: { id: id },
            dataType: 'json',
            success: function(response){

                if(tableID === 'menu_table'){
                    //Menu
                    menuAddEditModal.modal('show');
                    menuModalTitle.text('Add Menu');
                    menuModalBtn.text('Update');
 
                    menuID.val(response.id);
                    menuNameField.val(response.menuName);
                    menuPriceField.val(response.menuPrice);

                    menuCategoryField.val(response.categoryID).change();

                    if(response.availability === 'Available'){
                        $('#menu_available').prop('checked', true);
                    }else{
                        $('#menu_unavailable').prop('checked', true);
                    }
                }else{
                    //Category
                    categoryModalBtn.text('Update');
                    categoryModalTitle.text('Edit Category');
                    categoryAddEditModal.modal('show');
                    categoryID.val(response.id);
                    categoryNameField.val(response.categoryName);

                    if(categoryNameField.hasClass('is-invalid')){
                        categoryNameField.removeClass('is-invalid');
                    }

                    loadCategorySelectOptions();
                }

            }
        });
    }

    //Delete Table
    function showDestroyModel(id){
        //Get Table that triggered this function
        let tableID = event.target.closest('table').getAttribute('id');

        if(tableID === 'menu_table'){
            $('#deleteModal_message').text('Do you really want to delete this Menu?');
        }else{
            $('#deleteModal_message').text('Do you really want to delete this Category?');
        }

        deleteModal.modal('show');

        $('#category_deleteForm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type:'POST',
                url: tableID === 'menu_table' ? '{{ route('menu-destroy') }}' : '{{ route('category-destroy') }}',
                data: { id: id },
                dataType: 'json',
                success: function(response){
                    deleteModal.modal('hide');
                    updateDataTable('#category_table');
                    showAlert('success','Category has been successfully deleted.');

                    if(tableID === 'category_table'){
                        //reload category selection options
                        loadCategorySelectOptions();
                        updateDataTable('#menu_table');
                    }

                }
            });
        });  
    }

    // Done
    function loadCategorySelectOptions(){
        $('#menuCategory > option').not(':first').remove();

        $.ajax({
            type:'POST',
            url: '{{ route('category-all') }}',
            data: null,
            dataType: 'json',
            success: function(response){
                $.each(response, function (i, item) {
                    $('#menuCategory').append($('<option>', { 
                        value: item.id,
                        text : item.categoryName
                    }));
                });
            }
        });
    }
</script>