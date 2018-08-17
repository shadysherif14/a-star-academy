    <!-- jQuery -->
        <script src="{{ asset('libraries/js/jquery.js') }}"></script>

        <!-- Popper Tooltip -->
        <script src="{{ asset('libraries/js/popper.js') }}"></script>

        <!-- Material Design Bootstrap -->
        <script src="{{ asset('libraries/js/mdb pro.js') }}"></script>

        <!-- jQuery Extend -->
        <script src="{{ asset('libraries/js/jquery extend.js') }}"></script>
        
        <!-- Auto Size -->
        <script src="{{ asset('libraries/js/autosize.js') }}"></script>

        <!-- Sortable -->
        <script src="{{ asset('libraries/js/sortable.js') }}"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/dist/sweetalert2.all.min.js"></script>
        
        <!-- Progress -->
        <script src="{{ asset('libraries/js/progress.js') }}"></script>

        <!-- Initialize Libraries -->
        <script src="{{ asset('libraries/js/init.js') }}"></script>

        <!-- CSRF Token AJAX -->
        <script src="{{ asset('js/ajax.js') }}"></script>

        <!-- Main Script -->
        {{--  <script src="{{ asset('js/main.js') }}"></script>  --}}

        <script type="text/javascript">

            displayErrors(@json($errors->messages()));
        
        </script>