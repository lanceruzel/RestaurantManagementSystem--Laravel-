<style>
    tbody tr td:last-child{
        text-align: center;
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order List</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Pending Orders</h6>
    </div>

    <div class="card-body d-flex" id="pendingOrdersContainer">
        <!-- Order Container -->
        
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">For Processing Orders</h6>
    </div>

    <div class="card-body d-flex" id="processingOrdersContainer">

    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="confimationdialogmodal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Update Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body" id="confirmationMsg">
                ...
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmationBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
    let confirmationModal = $('#confirmationModal');
    let confirmationMessage = $('#confirmationMsg');
    let confirmationBtn = $('#confirmationBtn');

    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        loadOrders('Pending', '#pendingOrdersContainer');
        loadOrders('Processing', '#processingOrdersContainer');
    });

    function loadOrders(type, container){
        let pendingOrdersContainer = '';
        let ordersContainer = '';

        $.ajax({
            type: 'POST',
            url: '{{ route('bill-orders') }}',
            data: null,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $.each(data, function (i, item) {
                    const { id, orderStatus, orders, tableName } = item;

                    if(orderStatus !== type){
                        return;
                    }

                    $.each(orders, function(i, data){
                        const htmll = `<tr>
                                            <td>${ data.menuName }</td>
                                            <td>x${ data.quantity }</td>
                                        </tr>`

                        ordersContainer += htmll;
                    });

                    const html = `<div class="card mb-4 w-auto shadow-sm mx-3" style="width: 280px !important">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Order #${ id }</h6>
                                        <h6 class="m-0 font-weight-bold text-primary">Table: ${ tableName }</h6>
                                    </div>
                                
                                    <div class="card-body m-0">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Orders</th>
                                                    <th class="text-center">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${ ordersContainer }
                                            </tbody>
                                        </table>

                                        <div class="mt-4 w-100 d-flex align-items-center justify-content-center">
                                            <button class="btn btn-primary w-75" onClick="updateOrderStatus(${ id }, '${ (orderStatus === 'Pending') ? 'Processing' : 'Completed' }')">${ (orderStatus === 'Pending') ? 'Accept Order' : 'Mark as complete' }</button>
                                        </div>
                                    </div>
                                </div>`;

                    pendingOrdersContainer += html;
                });

                $(container).html(pendingOrdersContainer);
            },
            error: (data) =>{
                console.log(data);
            }
        });
    }

    function updateOrderStatus(id, status){
        confirmationModal.modal('show');
        if(status === 'Processing'){
            confirmationMessage.text('Accept this order?')
        }else{
            confirmationMessage.text('Mark this order as completed?')
        }

        confirmationBtn.on('click', function(){
            confirmationModal.modal('hide');

            let values = new FormData();

            values.set('id', id);
            values.set('orderStatus', status);

            $.ajax({
                type:'POST',
                url: '{{ route('bill-update-order') }}',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: values,
                success: function(response){
                    loadOrders('Pending', '#pendingOrdersContainer');
                    loadOrders('Processing', '#processingOrdersContainer');
                },
                error: function(response){
                    console.log(response);
                }
            });
        });
    }
</script>