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
            <div class="border border-3 d-flex justify-content-center align-items-center m-1" style="height: 70px; width: 110px; min-width: 110px">
                All
            </div>

            @foreach ($categoryList as $category)
                <div class="border border-2 d-flex justify-content-center align-items-center mx-2" style="height: 70px; width: 110px; min-width: 110px">
                    {{ $category->categoryName }}
                </div>
            @endforeach
        </div>

        <!-- Menu -->
        <div class="d-flex flex-wrap p-4 justify-content-center overflow-auto position-absolute" style="max-height: calc(100% - 120px); min-height: calc(100% - 120px); bottom:0;">
            
            @foreach ($menuList as $menu)
                <button class="btn btn-primary d-flex flex-column justify-content-center align-items-center m-2 lh-1" 
                style="height: 90px; width: 150px; min-width: 150px" 
                onclick="addItem('{{ $menu->menuName }}', '{{ $menu->menuPrice }}', '{{ $menu->id }}')">
                    <h5>{{ $menu->menuName }}</h5>
                    <span class="small">₱{{ $menu->menuPrice }}</span>
                </button>
            @endforeach
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#assignTable_modal">
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

            <button class="btn btn-primary" style="height: 70px;" data-toggle="modal" data-target="#assignTable_modal">Assign Table</button>
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

            <div class="modal-body" id="deleteModal_message">
                <div class="d-flex flex-row flex-wrap overflow-y-scroll" id="tableContainer" style="height: 500px"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bg-dark-transparent" id="viewOrders_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body row" id="deleteModal_message">
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
                                <th scope="col">Quantity</th>
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

            <div class="modal-body row" id="modalAssignMsg">

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

<script>
    $(document).ready(function(){

    });

    $(window).on('load', function () {
        $('.modal.fade').appendTo("#POS-container");
    });

    //Modal Fix in full screen
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

    function openTables(){
        
    }

    /////////////////////////////
    const orderList = [];

    loadOrderList();

    function getTotal(){
        let total = 0;

        for(i = 0; i < orderList.length; i++){
            let quantity = parseInt(orderList[i].quantity);
            let price = parseFloat(orderList[i].menuPrice)
            total += (quantity*price);
        }

        $('#totalAmount').text('₱' + (total).toFixed(2));
    }

    function loadOrderList(){
        console.log(orderList)
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

                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </td>
                    </tr>   `;

            orderViewList += html;
        }

        $("#orderList-container").html(orderViewList);
        getTotal();
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
                quantity: 1
            });
        }else{
            orderList[index].quantity++;
        }

        loadOrderList();
    }

    function addQuantity(index){
        orderList[index].quantity++;
        loadOrderList();
    }

    function minusQuantity(index){
        let quantity = orderList[index].quantity;
        if(quantity > 1){
            orderList[index].quantity--;
            loadOrderList();
    }
}
</script>