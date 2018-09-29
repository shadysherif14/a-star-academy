@if (count($breadcrumbs))
<div class="col-lg-7 col-md-7 col-sm-12 text-right">
    
    <ul class="breadcrumb float-md-right">

        @foreach ($breadcrumbs as $breadcrumb)
        
        <li class="breadcrumb-item {{ count($breadcrumbs) > 1 && $loop->last ? 'active' : '' }}">

            @if($breadcrumb->url && !$loop->last)
                <a href="{{ $breadcrumb->url }}">
            @endif
            @isset($breadcrumb->icon)
                <i class="{{ $breadcrumb->icon }}"></i>             
            @endisset
    
            {{ $breadcrumb->title }}
            @if($breadcrumb->url && !$loop->last)
            </a>
            @endif
        </li>
     
        
        @endforeach
    </ul>

</div>
@endif