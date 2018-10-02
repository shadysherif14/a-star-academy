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
        
        <!-- Sortable -->
        <script src="{{ asset('libraries/js/sortable.js') }}"></script>


        <!-- CSRF Token AJAX -->
        <script src="{{ asset('js/ajax.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript">

            displayErrors(@json($errors->messages()));
        
        </script>