<style>
    #POS-container:fullscreen {
        background-color: #ffff;
        width: 100vw;
        height: 100vh;
    }

    .bg-dark-transparent {
        background-color: rgba(52, 58, 64, 0.25) !important;
    }
</style>

<div class="row border border-2 border-secondary" style="height: 80vh" id="POS-container">
    <div class="col-8 border-right border-2 border-secondary p-0 position-relative">
        <!-- Categories -->
        <div class="d-flex py-2 justify-content-center align-items-center border-bottom border-2 border-secondary overflow-auto px-3 position-absolute" style="max-width: 100%; min-width: 100%; height: 120px">
            <button class="btn btn-info d-flex justify-content-center align-items-center mx-2" style="height: 70px; width: 110px; min-width: 110px" onClick="changeShownMenu('all')">
                All
            </button>

            @foreach ($categoryList as $category)
                <button class="btn btn-info d-flex justify-content-center align-items-center mx-2" style="height: 70px; width: 110px; min-width: 110px" onClick="changeShownMenu({{ $category->id }})">
                    {{ $category->categoryName }}
                </button>
            @endforeach
        </div>

        <!-- Menu -->
        <div id="menu-container" class="d-flex flex-wrap p-4 justify-content-center overflow-auto position-absolute" style="max-height: calc(100% - 120px); min-height: calc(100% - 120px); bottom:0;">
        
        </div>
    </div>

    <div class="col-4 p-0 position-relative">
        <div class="w-100 border-bottom border-secondary d-flex justify-content-between align-items-center px-2" style="max-height: 50px; min-height: 50px; width: 100%; top:0;">
            <h5 class="p-0 m-0">Order List</h5>

            <div class="d-flex">
                <div class="pr-2">
                    <button class="btn btn-info" id="fullscreen-toggler">
                        <i class="fas fa-fw fa-window-maximize" id="fullscreen-icon"></i>
                        <i class="fas fa-fw fa-window-minimize d-none" id="minimize-icon"></i>
                    </button>
                </div>

                <div>
                    <button class="btn btn-primary" onClick="viewOrders()">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                    </button>     
                </div>
            </div>
        </div>

        <div class="px-2 position-absolute overflow-auto" style="max-height: calc(100% - 150px); min-height: calc(100% - 150px); width: 100%; top:50;">
            <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">Menu</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody id="orderList-container">                   
                </tbody>
              </table>
        </div>

        <div class="border-top border-secondary border-2 d-flex align-items-center justify-content-between px-2 position-absolute" style="max-height: 100px; min-height: 100px; width: 100%; bottom: 0;">
            <div class="d-flex flex-row align-items-center justify-content-center pr-5 h-100">
                <span class="align-middle mb-0 h-100 font-weight-bold">Total:  <span class="mb-0 h-100 font-weight-normal" id="totalAmount"></span></span>  
                
            </div>

            <button class="btn btn-primary" style="height: 70px;" onClick="loadTables()">Assign Table</button>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="assignTable_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Table</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="">
                <div class="d-flex flex-wrap overflow-y-scroll" id="tableContainer" style="height: 500px"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="viewOrders_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">View Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body row" id="">
                <div class="col-5 d-flex align-items-start flex-column overflow-y-scroll overflow-x-hidden" id="tableContainerOrderEdit" style="height: 500px"></div>

                <div class="col-7">
                    <div class="alert alert-warning w-100 d-none" role="alert" id="orderViewAlert"></div>

                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div class="fw-bold fs-4" id="tableNumberContainer"></div>

                        <button class="btn btn-primary d-none" data-toggle="modal" data-target="#modal_billView" id="paymentOrderBtn">Payment</button>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="w-50">Menu</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="editOrdersContainer">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="modal_assignMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <span id="modalAssignMsg"></span>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="modal_billView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Bill View</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body row" id="modalAssignMsg">
                <div class="alert alert-danger d-none" role="alert" id="payment_alert">
                    Payment is not enough.
                </div>
                <div id="billViewTableContainer"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printReceiptBtn">Print Receipt</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="modal_orderEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Quantity</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="javascript:void(0)" id="form_EditQuantity" method="POST">
                <div class="modal-body d-flex align-items-center justify-content-center" id="modalAssignMsg">
                    <button class="btn btn-danger" type="button" onClick="quantityEdit('minus')">-</button>

                    <div class="form-group">
                        <label for="categoryName" class="mb-0">Quantity: </label>
                        <input type="text" class="form-control text-center" readonly name="quantity" id="orderSelectedQuantity" style="width: 50px"
                            placeholder="">            
                        <div class="invalid-feedback" id="orderSelectedQuantity_invalid"></div>
                    </div>   
                    
                    <button class="btn btn-primary" type="button" onClick="quantityEdit('add')">+</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="modal_orderDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="javascript:void(0)" id="form_deleteQuantity" method="POST">
                <div class="modal-body d-flex align-items-center justify-content-center" id="modalAssignMsg">
                    You sure to delete this order?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes, delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let modalMessageContainer = $('#modal_assignMessage');
    let modalMessage = $('#modalAssignMsg');

    //Get User's Account Id
    let accountID = {!! auth()->user()->id !!};

    //Bill ID
    let billID = 0;

    //Selected Bill ID
    let selectedBillID = 0;

    // Load Menu
    let menu = @json($menuList);

    // Order Container
    const orderList = [];

    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function orderDelete(id){
        $('#modal_orderDelete').modal('show');

        $('#form_deleteQuantity').on('submit', function(e){
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.set('id', id);

            $.ajax({
                type: 'POST',
                url: '{{ route('order-destroy') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) =>{
                    getBillOrder(selectedBillID);
                    $('#modal_orderDelete').modal('hide');
                },
                error: (data) =>{
                    
                }
            });
        });
    }

    function quantityEdit(mode){
        let count = $('#orderSelectedQuantity').val();

        if(mode === 'add'){
            count++;
        }else if(mode === 'minus' && count > 1){
            count--;
        }
        
        $('#orderSelectedQuantity').val(count);
    }

    function orderQuantityEdit(id, quantity){
        let quantityField = $('#orderSelectedQuantity');

        $('#modal_orderEdit').modal('show');

        quantityField.val(quantity);

        $('#form_EditQuantity').on('submit', function(e){
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.set('id', id);

            $.ajax({
                type: 'POST',
                url: '{{ route('order-quantity') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) =>{
                    getBillOrder(selectedBillID);
                    $('#modal_orderEdit').modal('hide');
                },
                error: (data) =>{
                    
                }
            });
        });
    }

    function getBillOrder(id){
        selectedBillID = id;
        let orderViewList = '';

        let values = new FormData();
        values.set('id', id);

        $.ajax({
            type:'POST',
            url: '{{ route('order-view') }}',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: values,
            success: function(response){
                $.each(response, function (i, bill) {
                    const { id, menuName, price, quantity, total } = bill;

                    const html = `<tr>
                                    <td>${ menuName }</td>
                                    <td class="text-center">x${ quantity }</td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-sm" onClick="orderQuantityEdit(${ id }, ${ quantity })">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger" onClick="orderDelete(${ id })">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>`;

                    orderViewList += html;
                });

                $("#editOrdersContainer").html(orderViewList);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function viewOrders(){
        $('#viewOrders_modal').modal('show');

        loadIncompleteOrders();
    }

    function loadIncompleteOrders(){
        let orderViewList = '';

        $.ajax({
            type:'POST',
            url: '{{ route('bill-incomplete') }}',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: null,
            success: function(response){
                $.each(response, function (i, bill) {
                    const { tableName, availability, id, paymentStatus, orderStatus } = bill;

                    const html = `<button class="btn btn-primary p-5 m-2 w-100 d-flex flex-column justify-content-center align-items-center" id="tableInformation-container" style="height: 100px; width: 130px" onClick="getBillOrder(${ id })">
                        <div>
                            ${ tableName }
                        </div>

                        <div id="tableStatus">
                            Order #${ id }
                        </div>

                        <div>
                            ${ (orderStatus === 'Pending' || paymentStatus === 'Pending') ? 'Incomplete' : 'Completed' }
                        </div>
                    </button>`;

                    orderViewList += html;
                });

                $("#tableContainerOrderEdit").html(orderViewList);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function updateTableAvailability(id, availability){
        let values = new FormData();

        values.set('id', id);
        values.set('availability', availability);

        return $.ajax({
            type:'POST',
            url: '{{ route('table-update-availability') }}',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: values,
            success: function(response){
                isSuccess = true;
                
            },
            error: function(response){
                console.log(response);
                isSuccess = false;
            }
        });
    }

    function insertBill(accountID, tableID){
        let values = new FormData();

        values.set('accountID', accountID);
        values.set('tableID', tableID);
        values.set('total', getTotal());

        return $.ajax({
            type:'POST',
            url: '{{ route('bill-store') }}',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: values,
            success: function(response){
                billID = response.id;
                isSuccess = true;
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function insertOrders(){
        let values = new FormData();

        values.set('billID', billID);
        values.set('orders', JSON.stringify(orderList));

        return $.ajax({
            type:'POST',
            url: '{{ route('order-controller') }}',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: values,
            success: function(response){
                //console.log(response);
                isSuccess = true;
            },
            error: function(response){
                console.log(response);
                isSuccess = false;
            }
        });

    }

    function processOrder(tableID){
        insertBill(accountID, tableID).done(function(){
            insertOrders().done(function(){
                updateTableAvailability(tableID, 'Unavailable').done(function(){
                    $('#assignTable_modal').modal('hide');

                    modalMessageContainer.modal('show');
                    modalMessage.text('Order Successfully inserted.');

                    orderList.length = 0;
                    loadOrderList();
                }).fail(function(data){
                    modalMessageContainer.modal('show');
                    modalMessage.text('There seem to be a problem updating this table.');
                });
            }).fail(function(){
                console.log(data);
                modalMessageContainer.modal('show');
                modalMessage.text('There seem to be a problem inserting these orders.');
            });
        }).fail(function(data){
            console.log(data);
            modalMessageContainer.modal('show');
            modalMessage.text('There seem to be a problem inserting this bill.');
        });
    }

    function loadTables(){
        if(orderList === null || orderList.length === 0){
            modalMessageContainer.modal('show');
            modalMessage.text('Order list is empty.');
        }else{
            $('#assignTable_modal').modal('show');
        }

        let tableListView = '';

        $.ajax({
            type:'POST',
            url: '{{ route('pos-table') }}',
            data: null,
            dataType: 'json',
            success: function(response){
                $.each(response, function (i, table) {
                    const { tableName, availability, id } = table;

                    const html = `<button class="btn p-5 m-2 d-flex flex-column flex-fill justify-content-center align-items-center btn-${(availability === 'Available') ? 'success ' : 'danger disabled'}" id="tableInformation-container" style="height: 100px; width: 150px" onClick="processOrder(${ id })">
                        <div class="fw-bold text-white">
                            ${ tableName }
                        </div>

                        <div id="tableStatus" class="text-white">
                            ${ availability }
                        </div>
                    </button >`;

                    tableListView += html;
                });

                $("#tableContainer").html(tableListView);
            }
        });
    }

    changeShownMenu('all');

    function changeShownMenu(selectedID){
        let menuListView = '';

        for (i = 0; i < menu.length; i++) {
            var {menuName, menuPrice, quantity, categoryID, id} = menu[i];

            if(selectedID === categoryID || selectedID === 'all'){
                const html = `<button class="btn btn-primary d-flex flex-column justify-content-center align-items-center m-2 lh-1" 
                            style="height: 90px; width: 150px; min-width: 150px" 
                            onclick="addItem('${ menuName }', '${ menuPrice }', '${ id }')">
                                <h5>${ menuName }</h5>
                                <span class="small">₱${ menuPrice }</span>
                            </button>`;

                menuListView += html;
            }
        }

        $("#menu-container").html(menuListView);
    }

    //Modal Fix in full screen
    $(window).on('load', function () {
        $('.modal.fade').appendTo("#POS-container");
    });

    $('#fullscreen-toggler').on('click', function(){
        $('#fullscreen-toggler').toggleClass('fullscreen');

        if ($('#fullscreen-toggler').hasClass('fullscreen')){
            $('#fullscreen-icon').addClass('d-none');
            $('#minimize-icon').removeClass('d-none');
            openFullscreen('POS-container');
        }else{
            $('#fullscreen-icon').removeClass('d-none');
            $('#minimize-icon').addClass('d-none');
            closeFullscreen();
        }
    });

    function openFullscreen(elem) {
        let element = document.getElementById(elem);

        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.webkitRequestFullscreen) { /* Safari */
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) { /* IE11 */
            element.msRequestFullscreen();
        }
    }

    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE11 */
            document.msExitFullscreen();
        }
    }

    loadOrderList();

    function loadOrderList(){
        let orderViewList = '';

        for (i = 0; i < orderList.length; i++) {
            let {menuName, menuPrice, quantity} = orderList[i];

            const html = `<tr>
                        <td class="align-middle">${ menuName }</td>
                        <td class="align-middle text-center">x${ quantity }</td>
                        <td class="align-middle">₱${ menuPrice }</td>
                        <td class="d-flex align-items-center justify-content-center">
                            <div class="d-flex flex-column align-items-center justify-content-center pr-3 py-2">
                                <button class="btn btn-sm btn-primary mb-2" onClick="addQuantity(${ i })">
                                    +
                                </button>

                                <button class="btn btn-sm btn-secondary" onClick="minusQuantity(${ i })">
                                    -
                                </button>
                            </div>

                            <button class="btn btn-sm btn-danger" onClick="deleteOrderProduct(${ i })">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </td>
                    </tr>   `;

            orderViewList += html;
        }

        $("#orderList-container").html(orderViewList);
        updateTotalAmountText();
    }

    function getTotal(){
        let total = 0;

        orderList.forEach(order => {
            total += (parseInt(order['quantity']) * parseFloat(order['menuPrice']));
        });

        return total;
    }

    function updateTotalAmountText(){
        $('#totalAmount').text('₱' + getTotal().toFixed(2));
    }

    function addItem(menuName, menuPrice, id){
        let isExists = false;
        let index;

        //Check if item is already on the list
        for(i = 0; i < orderList.length; i++){
            if(orderList[i].menuName == menuName){
                isExists = true;
                index = i;
            }
        }

        if(!isExists){
            orderList.push({
                id: id,
                menuName: menuName,
                menuPrice: menuPrice,
                quantity: 1,
                total: menuPrice
            });
        }else{
            ++orderList[index].quantity;
            orderList[index].total = orderList[index].quantity * orderList[index].menuPrice;
        }

        loadOrderList();
    }

    function deleteOrderProduct(index){
        orderList.splice(index, 1);
        loadOrderList();
    }

    function addQuantity(index){
        orderList[index].quantity++;
        loadOrderList();
    }

    function minusQuantity(index){
        let quantity = orderList[index].quantity;
        if(quantity > 1){
            --orderList[index].quantity;
            orderList[index].total = orderList[index].quantity * orderList[index].menuPrice;
            loadOrderList();
    }
}
</script>