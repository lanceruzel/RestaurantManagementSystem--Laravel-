<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bill Management</h1>
</div>

<!-- Table Start -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Bill List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Assigned Table</th>
                        <th>Order Number</th>
                        <th>Order Dater</th>
                        <th>Cashier</th>
                        <th>Total</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
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
                            <button class="btn btn-secondary">Pending</button>
                        </td>
                        <td>
                            <button class="btn btn-success">Paid</button>
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#billViewModal">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#billViewModal">
                                <i class="fas fa-money-check"></i> Pay
                            </a>
                        </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="billViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger d-none" role="alert" id="payment_alert">
                    Payment is not enough.
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col" style="width: 30%;">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Test Product 1</td>
                            <td>P75.00</td>
                            <td>2</td>
                            <td>P150.00</td>
                        </tr>

                        <tr>
                            <td>Test Product 1</td>
                            <td>P75.00</td>
                            <td>2</td>
                            <td>P150.00</td>
                        </tr>

                        <tr>
                            <td>Test Product 1dsdsd</td>
                            <td>P75.00</td>
                            <td>2</td>
                            <td>P150.00</td>
                        </tr>

                        <tr>
                            <td>Test Product 1dsdsd</td>
                            <td>P75.00</td>
                            <td>2</td>
                            <td>P150.00</td>
                        </tr>

                        <tr>
                            <td>Test Product 1dsdsd</td>
                            <td>P75.00</td>
                            <td>2</td>
                            <td>P150.00</td>
                        </tr>

                        <tr>
                            <td>Test Product 1dsdsd</td>
                            <td>P75.00</td>
                            <td>2</td>
                            <td>P150.00</td>
                        </tr>
                    </tbody>

                    <caption>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end">Total</td>
                            <td>₱<span id="totalPrice" colspan="2">232</span></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end">Payment</td>
                            <td colspan="2">
                                <input type="text" class="form-control bg-light border-0 small" id="amountEntered" placeholder="Bill..." onchange="getChange();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"
                                        aria-label="Search" aria-describedby="basic-addon2">
                            </td>
                        </tr>
                
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end">Change</td>
                            <td id="change" colspan="3">₱0.00</td>
                        </tr>
                    </caption>
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="#">Comfirm Payment</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function getChange(){
        change = 0;
        var payment = $('#amountEntered').val();
        var total = parseFloat($('#totalPrice').text());
        change = (payment - total);

        $('#change').text('₱' + change.toFixed(2));

        if(change < 0){
            $('#change').css('color', 'red');
        }else{
            $('#change').css('color', '#858796');
        }
    }
</script>