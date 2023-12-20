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

<script>
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
                                            <button class="btn btn-primary w-75">${ (orderStatus === 'Pending') ? 'Accept Order' : 'Mark as complete' }</button>
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
</script>