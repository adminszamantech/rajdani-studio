<footer>
    <div class="container">
        <div class="footer-5 footer-style3">
            <div class="row">
                <div class="col-lg-4 col-md-6 sm-margin-25px-bottom mobile-margin-20px-bottom">
                    <div class="sm-padding-50px-right xs-no-padding-right">
                        <span class="footer-logo margin-25px-bottom xs-margin-15px-bottom display-inline-block">
                            <img src="{{ asset('/storage/admin/assets/images/logo/'.website()->logo_image) }}" alt="logo">
                        </span>
                        <p class="no-margin-bottom">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised</p>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 mobile-margin-20px-bottom">
                    <div class="padding-40px-left sm-no-padding-left">
                        <h4 class="mobile-margin-10px-bottom">Quick Links</h4>
                        <ul class="footer-list no-margin-bottom">
                            <li><a href="{{ route('home.index') }}" class="font-size14">Home</a></li>
                            <li><a href="{{ route('home.profile') }}" class="font-size14">About Us</a></li>
                            <li><a href="{{ route('home.contact') }}" class="font-size14">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h4 class="mobile-margin-10px-bottom">Quick Contact</h4>
                    <ul class="">
                        <li><i class="ti-location-pin margin-10px-right md-margin-two-right text-theme-color"></i>{{ website()->address ?? '' }} </li>
                        <li><i class="ti-email margin-10px-right md-margin-two-right text-theme-color"></i><a class="" href="mailto:{{ website()->email ?? '' }}">{{ website()->email ?? '' }}</li>
                        <li><i class="ti-mobile margin-10px-right md-margin-two-right text-theme-color"></i><a class="" href="tel:+88{{ website()->phone ?? '' }}">{{ '+88'.website()->phone ?? '' }}</a></li>
                    </ul>

                    <div class="footer-icon">
                        <ul class="no-margin-bottom">
                            <li>
                                <a target="_blank" class="btn btn-success btn-sm rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px;height:32px" href="https://wa.me/88{{ website()->whatsapp_number ?? '' }}"><i class="fab fa-whatsapp"></i></a>
                            </li>
                            <li>
                                <a target="_blank" class="btn btn-info btn-sm rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px;height:32px" href="{{ website()->linkedin_link ?? '' }}"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li>
                                <a target="_blank" class="btn btn-primary btn-sm rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px;height:32px" href="{{ website()->facebook_link ?? '' }}"><i class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-style3-bottom">
        <div class="container">
            <p class="font-size14">&copy; {{ date('Y') }} Rajdhani Studio is Powered by SZamantech</p>
        </div>
    </div>
</footer>
