@include('partials.header')

<style>
    .loader {
        width: 38px;
        height: 38px;
        border: 5px solid #858796;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    } 

    .bg-dark-transparent {
        background-color: rgba(52, 58, 64, 0.70) !important;
    }
</style>

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
                    @elseif(request()->routeIS('bill-management'))
                        @include('tabs.bill-management')
                    @elseif(request()->routeIS('pos'))
                        @include('tabs.point-of-sale')
                    @elseif(request()->routeIS('ordersView'))
                        @include('tabs.orders-view')
                    @elseif(request()->routeIS('dashboard'))
                        @include('tabs.dashboard')
                    @else
                        <script>window.location = "{{ route('dashboard') }}";</script>
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

    <!-- Loading Modal-->
    <div class="modal fade bg-dark-transparent" id="loading_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body d-flex align-items-center justify-content-center" id="modalAssignMsg">
                    <span class="loader mr-2"></span>Processing....
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    let loadingModal = $('#loading_modal');

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

    $(document).ajaxStart(function() {
        loadingModal.modal('show');
    }).ajaxStop(function() {
        setTimeout(function(){
            loadingModal.modal('hide');
        }, 300);
    });
</script>

</html>