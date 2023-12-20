@include('partials.header')

<body id="page-top" data-barba="wrapper">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.topbar')

                <!-- Begin Page Content -->
                <main class="container-fluid" data-barba="container" data-barba-namespace="home">

                    <!-- Content -->
                    @if (request()->routeIS('account-management'))
                        @include('tabs.account-management')
                    @elseif(request()->routeIS('table-management'))
                        @include('tabs.table-management')
                    @elseif(request()->routeIS('menu-management'))
                        @include('tabs.menu-management')
                    @elseif(request()->routeIS('inventoryManagement'))
                        @include('tabs.inventory-management')
                    @elseif(request()->routeIS('bill-management'))
                        @include('tabs.bill-management')
                    @elseif(request()->routeIS('pos'))
                        @include('tabs.point-of-sale')
                    @elseif(request()->routeIS('ordersView'))
                        @include('tabs.orders-view')
                    @else
                        @include('tabs.dashboard')
                    @endif
                </main>
            </div>

            <!-- Footer -->
            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/account/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function showAlert(type, message){
        let dom = $('#alert');

        //Unhide
        if(dom.hasClass('d-none')){
            dom.removeClass('d-none');
        }

        //Clear alert success class if theres any
        if(dom.hasClass('alert-success')){
            dom.removeClass('alert-success');
        }

        //Clear danger success class if theres any
        if(dom.hasClass('alert-danger')){
            dom.removeClass('alert-danger');
        }

        if(type === 'success'){
            dom.addClass('alert-success');
        }

        if(type === 'danger'){
            dom.addClass('alert-danger');
        }

        $('#alert-messageeeeee').text(message);

        //Auto Close Alert
        setTimeout(function() {
            //Hide alert
            dom.addClass('d-none');
        }, 4000);
    }

    //refresh data table
    function updateDataTable(datatable){
        var oTable = $(datatable).dataTable();
        oTable.fnDraw(false);
    }
</script>

</html>