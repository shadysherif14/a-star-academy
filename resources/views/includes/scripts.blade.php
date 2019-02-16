        
        <script src="{{ asset_path('js/app.js') }}"></script>    
        <script src="{{ asset_path('assets/bundles/vendorscripts.bundle.js') }}"></script>
        <script src="{{ asset_path('assets/bundles/mainscripts.bundle.js') }}"></script>
        
        <!-- jQuery Extend -->
        <script src="{{ asset_path('libraries/js/jquery extend.js') }}"></script>
        
        <!-- CSRF Token AJAX -->
        <script src="{{ asset_path('js/ajax.js') }}"></script>

        <script src="{{ asset_path('libraries/js/init.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <script src="{{ secure_asset('assets/plugins/waitMe/waitMe.js') }}"></script>

        <script type="text/javascript">

            displayErrors(@json($errors->messages()));
        
        </script>