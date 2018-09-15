@extends('layouts.main')

@section('layout_css')
    {{--  <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">    --}}  
@stop


@section('body')

    @include('includes.navbar')

    @include('includes.left-sidebar')

    @include('includes.right-sidebar')


    <section class="content home">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Dashboard</h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">

                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="./index.html"><i class="zmdi zmdi-home"></i> {{ config('app.name') }} </a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @yield('content')
        </div>
    
    </section>

@stop


