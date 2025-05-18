@extends('frontend.layouts.main')
@section('title', 'Contact Us')

@section('content')

    {{-- <section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>Contact Us</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Contact us</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section> --}}

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 sm-margin-25px-bottom">
                    <div class="padding-30px-all sm-padding-25px-all xs-padding-20px-all bg-light-gray text-center">
                        <i class="ti-email font-size40 sm-font-size38 xs-font-size34 text-theme-color"></i>
                        <h5 class="margin-5px-bottom margin-20px-top sm-margin-15px-top font-size20 xs-font-size18">Email Us:</h5>
                        <p class="no-margin-bottom"><a class="text-dark" href="mailto:{{ website()->email ?? '' }}">{{ website()->email ?? '' }}</a></p>
                    </div>
                </div>
                <div class="col-lg-4 sm-margin-25px-bottom">
                    <div class="padding-30px-all sm-padding-25px-all xs-padding-20px-all bg-light-gray text-center">
                        <i class="ti-mobile font-size40 sm-font-size38 xs-font-size34 text-theme-color"></i>
                        <h5 class="margin-5px-bottom margin-20px-top sm-margin-15px-top font-size20 xs-font-size18">Call Us:</h5>
                        <p class="no-margin-bottom"><a class="text-dark" href="tel:+88{{ website()->phone ?? '' }}">{{ '+88'.website()->phone ?? '' }}</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="padding-30px-all sm-padding-25px-all xs-padding-20px-all bg-light-gray text-center">
                        <i class="ti-location-pin font-size40 sm-font-size38 xs-font-size34 text-theme-color"></i>
                        <h5 class="margin-5px-bottom margin-20px-top sm-margin-15px-top font-size20 xs-font-size18">Our Address:</h5>
                        <p class="no-margin-bottom">{{ website()->address ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding-top">
        <div class="container">
            <div class="padding-40px-all sm-padding-30px-all xs-padding-20px-all bg-light-gray">
                @if (session('message'))
                    <div class="alert alert-success my-5">
                        {{ session('message') }}
                    </div>
                @endif
                <h4 class="font-size38 sm-font-size34 xs-font-size28 line-height-45 sm-line-height-40 font-weight-500 margin-10px-bottom text-center">Contact Us</h4>
                <form action="{{ route('home.contact') }}" method="post">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="form-control no-margin-bottom @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="form-control no-margin-bottom @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input
                                    id="phone"
                                    type="number"
                                    name="phone"
                                    class="form-control no-margin-bottom @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <input
                                    id="subject"
                                    type="text"
                                    name="subject"
                                    class="form-control no-margin-bottom @error('subject') is-invalid @enderror"
                                    value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="col-lg-12 margin-20px-bottom sm-margin-10px-bottom">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea
                                    id="text"
                                    name="message"
                                    class="form-control line-height-70 @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-lg-12">
                            <div class="Send">
                                <button type="submit" class="butn">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <iframe class="map-height" id="gmap_canvas" src="https://maps.google.com/maps?q=৯৩, কাজী নজরুল ইসলাম এভিনিউ, কারওয়ান বাজার, ঢাকা-১২১৫&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" scrolling="no" marginheight="0" marginwidth="0"></iframe>

@endsection
