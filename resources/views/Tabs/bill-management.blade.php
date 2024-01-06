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
            <table class="table table-bordered" id="bill_table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Assigned Table</th>
                        <th>Order Number</th>
                        <th>Order Date</th>
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

<div class="modal fade" id="modal_billView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bill View</h5>
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
                            <th scope="col" class="text-center">Product</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" style="width: 30%;" class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody id="billViewTableContainer"></tbody>
                    <caption>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right">Total:</td>
                            <td class="text-center">₱<span id="totalPrice"></span></td>
                        </tr>
                    </caption>
                </table>
                    
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        $('#bill_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('bill-management') }}',
            columns:[
                {data: 'tableName', name: 'tableName'},
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'fullname', name: 'fullname'},
                {data: 'totalFormatted', name: 'totatotalFormattedl'},
                {data: 'orderStatus', 
                    render: function(data, type, row, meta){
                        if(type === 'display'){
                            if(data === 'Completed'){
                                data = '<button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Completed</button>';
                            }else if(data === 'Processing'){
                                data = '<button type="button" class="btn btn-warning btn-sm" style="pointer-events: none;">Processing</button>';
                            }else{
                                data = '<button type="button" class="btn btn-secondary btn-sm" style="pointer-events: none;">Pending</button>';
                            }

                            return data;
                        }
                    }
                },
                {data: 'paymentStatus',
                    render: function(data, type, row, meta){
                        if(type === 'display'){
                            if(data === 'Completed'){
                                data = '<button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">Completed</button>';
                            }else{
                                data = '<button type="button" class="btn btn-secondary btn-sm" style="pointer-events: none;">Pending</button>';
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

    function showBill(selectedBillID){
        let total = 0;
        
        let formData = new FormData();
        formData.set('id', selectedBillID);

        let orderViewList = '';

        $.ajax({
            type: 'POST',
            url: '{{ route('order-view') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $('#modal_billView').modal('show');

                $.each(data, function (i, bill) {
                    const { id, menuName, price, quantity } = bill;

                    let menuTotal = parseFloat(price) * parseFloat(quantity);
                    total += menuTotal;

                    const html = `<tr>
                                    <td>${ menuName }</td>
                                    <td class="text-center">₱${ price.toFixed(2) }</td>
                                    <td class="text-center">x${ quantity }</td>
                                    <td class="text-center">₱${ menuTotal.toFixed(2) }</td>
                                </tr>`;

                        orderViewList += html;
                });

                $('#totalPrice').text(total);
                $("#billViewTableContainer").html(orderViewList);
            },
            error: (data) =>{
                console.log(data);
            }
        });
    }
</script>