@extends('frontend.layouts.main')
@section('title', 'Career')

@section('content')

    <section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>Career</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Career</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
               <div class="col-md-12 d-flex justify-content-center align-items-center">
                <p class="text-white bg-danger p-2">Career Page On Under Maintainance</p>
               </div>
            </div>
        </div>
    </section>
@endsection
