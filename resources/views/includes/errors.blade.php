@section('scripts')
    
    <script type="text/javascript">
        let errors = {!! json_encode($errors->messages()) !!};

        for(let error in errors) {

            let input = $(`[name=${error}]`); 

        }
    </script>
@stop
