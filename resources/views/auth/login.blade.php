<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.layouts.head')
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo text-center">
                  <img src="{{ asset('/storage/admin/assets/images/logo.jpeg') }}">
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                <form method="POST" action="{{ route('login') }}" class="pt-3">
                        @csrf
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control form-control-lg" :value="old('email')" autofocus autocomplete="username" placeholder="Enter Email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="password" autocomplete="current-password" placeholder="Enter Password" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-gradient-danger btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember_me"> Keep me signed in </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-link text-primary">Forgot password?</a>
                    @endif
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.layouts.scripts')
  </body>
</html>
