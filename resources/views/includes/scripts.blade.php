        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>


        <script src="{{ asset('assets/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
        <!-- Cleave -->
        <script src="{{ asset('libraries/js/cleave.js') }}"></script>

        <!-- Card -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/jquery.card.min.js"></script>
        
        <!-- jQuery Extend -->
        <script src="{{ asset('libraries/js/jquery extend.js') }}"></script>
        
        <!-- Auto Size -->
        <script src="{{ asset('libraries/js/autosize.js') }}"></script>

        <!-- Sortable -->
        <script src="{{ asset('libraries/js/sortable.js') }}"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/dist/sweetalert2.all.min.js"></script>
        


        <!-- Initialize Libraries -->
        <script src="{{ asset('libraries/js/init.js') }}"></script>

        <!-- CSRF Token AJAX -->
        <script src="{{ asset('js/ajax.js') }}"></script>

        <script type="text/javascript">

            displayErrors(@json($errors->messages()));
        
        </script>