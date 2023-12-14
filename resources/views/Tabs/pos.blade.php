<style>
    #POS:fullscreen {
        background-color: #ffff;
        width: 100vw;
        height: 100vh;
    }
</style>

<div class="container-fluid" id="POS">
    <div class="row">
        <div class="col-8 border border-2 d-flex flex-column justify-content-between">
            <div class="row">
                <div class="col-12 text-bg-dark text-center fs-3 d-flex justify-content-center align-items-center" style="height: 45px;">
                    <div class="justify-content-start" id="fullscreen-toggler">
                        <i class="fa-solid fa-maximize fa-sm" id="fullscreen-icon"></i>
                        <i class="fa-solid fa-minimize fa-sm d-none" id="minimize-icon"></i>
                    </div>

                    <div class="w-100" id="selected-category">
                        All Menu
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center align-items-center py-2" id="product_container">
                    </div>
                </div>
            </div>

            <div class="row border-top border-2 py-3 px-2" id="category_container">
                <div class="col shadow-sm d-flex justify-content-center align-items-center m-1" style="height: 80px;">
                    Category 1
                </div>
            </div>
        </div>

        <div class="col-4 border border-2 d-flex flex-column justify-content-between vh-100">
            <!--Upper-->
            <div class="row vh-100">
                <div class="col-12">
                    <div class="row" style="height: calc(100vh - 45px);">
                        <div class="col-12 text-bg-dark d-flex justify-content-between align-items-center" style="height: 45px;">
                            <div class="fs-3">
                                Order List
                            </div>

                            <div>
                                <button class="btn btn-dark" id="viewOrdersBtn" data-bs-toggle="modal" data-bs-target="#viewOrders_modal">
                                    <i class="fa-solid fa-clipboard-list fa-xl"></i>
                                </button>
                            </div>
                        </div>

                        <!--Orders Container-->
                        <div class="col-12 overflow-y-auto" style="height: 80%; max-height: 80%" id="orderListView">
                            <!--Selected Order Item Container-->
                        </div>

                        <!--Bottom-->
                        <div class="col-12">
                            <div class="row border-top border-2 h-100 py-3 p-2">
                                <div class="col-md-8 shadow-sm p-4">
                                    <!--Tax-->
                                    <div class="col-12 d-flex align-items-center justify-content-between">
                                        <div class="fs-5">
                                            Tax
                                        </div>

                                        <div>
                                            ₱90.00
                                        </div>
                                    </div>

                                    <hr>

                                    <!--Total-->
                                    <div class="col-12 d-flex align-items-center justify-content-between">
                                        <div class="fw-bold fs-4">
                                            Total
                                        </div>

                                        <div id="totalAmount">
                                            ₱90.00
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 h-100 pe-0">
                                    <button class="btn btn-primary btn-lg h-100 lh-1 w-100" data-bs-toggle="modal" data-bs-target="#assignTable_modal">Assign<br>Table</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bg bg-black bg-opacity-25" id="assignTable_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Assign Table</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row flex-wrap overflow-y-scroll" id="tableContainer" style="height: 500px">

                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade bg bg-black bg-opacity-25" id="viewOrders_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 700px">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-5 d-flex align-items-start flex-column overflow-y-scroll overflow-x-hidden" id="tableContainerOrderEdit" style="height: 500px"></div>

                <div class="col-7">
                    <div class="alert alert-warning w-100 d-none" role="alert" id="orderViewAlert">

                    </div>

                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div class="fw-bold fs-4" id="tableNumberContainer"></div>

                        <button class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modal_billView" id="paymentOrderBtn">Payment</button>
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
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade bg bg-black bg-opacity-25" id="modal_assignMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container" id="modalAssignMsg">
                    sdasdsadsadasd
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<!--Bill Out Modal-->
<div class="modal fade" id="modal_billView" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="billView">Bill View</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" role="alert" id="payment_alert">
                    Payment is not enough.
                </div>
                <div id="billViewTableContainer"></div>
            </div>
            <div class="modal-footer px-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printReceiptBtn">Print Receipt</button>
            </div>
        </div>
    </div>
</div>