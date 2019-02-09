@extends('layouts.main') 


@section('body')
    @include('includes.navbar')
    @include('includes.left-sidebar')
    @include('includes.right-sidebar')


    <section class="content home">
        
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    @isset($title)
                    <h2>{{ $title }}</h2>
                    @endisset
                </div>

                @isset($breadcrumbs)    
                    @isset($breadcrumbArgument) 
                        {{ Breadcrumbs::render($breadcrumbs, $breadcrumbArgument) }}
                    @else 
                        {{ Breadcrumbs::render($breadcrumbs) }}
                    @endisset
                @endisset
            </div>
        </div>

        <div class="container-fluid">
            @yield('content')
        </div>

    </section>

@stop