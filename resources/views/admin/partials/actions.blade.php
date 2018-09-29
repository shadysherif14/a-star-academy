@isset($actions) 

@if(in_array('show', $actions))
<button type="button" class="btn l-turquoise btn-icon btn-icon-mini btn-round link" href="{{ $model->adminRoutes->show }}">
    <i class="zmdi zmdi-eye"></i>
</button>
@endif

@if(in_array('edit', $actions))
<button type="button" class="btn l-parpl btn-icon btn-icon-mini btn-round link" href="{{ $model->adminRoutes->edit }}">
    <i class="zmdi zmdi-edit"></i>
</button>
@endif

@if(in_array('delete', $actions))
<button type="button" class="btn l-coral btn-icon btn-icon-mini btn-round delete" action="{{ $model->adminRoutes->destroy }}">
    <i class="zmdi zmdi-delete"></i>
</button> 
@endif

@else
<button type="button" class="btn l-turquoise btn-icon btn-icon-mini btn-round link" href="{{ $model->adminRoutes->show }}">
    <i class="zmdi zmdi-eye"></i>
</button>
<button type="button" class="btn l-parpl btn-icon btn-icon-mini btn-round link" href="{{ $model->adminRoutes->edit }}">
    <i class="zmdi zmdi-edit"></i>
</button>

<button type="button" class="btn l-coral btn-icon btn-icon-mini btn-round delete" action="{{ $model->adminRoutes->destroy }}">
    <i class="zmdi zmdi-delete"></i>
</button>
@endisset