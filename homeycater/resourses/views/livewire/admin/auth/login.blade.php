<div>
    <div class="login-signin">
        <div class="mb-20">
            <h3>Sign In To Admin</h3>
            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
        </div>
        <form class="form"
            wire:submit.prevent="login"
         >
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            <div class="form-group mb-5">
                <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" type="text"  wire:model="email"  placeholder="Email" autocomplete="off" />
                @error('email')
                    <div class="invalid-feedback vis-display text-left">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-5">
                <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" autocomplete="off" wire:model="password" type="password" placeholder="Password" />
                @error('password')
                    <div class="invalid-feedback vis-display text-left">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            {{-- <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                <div class="checkbox-inline">
                    <label class="checkbox m-0 text-muted">
                    <input type="checkbox" name="remember" />
                    <span></span>Remember me</label>
                </div>
                <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forget Password ?</a>
            </div> --}}
            <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
        </form>
        {{-- <div class="mt-10">
            <span class="opacity-70 mr-4">Don't have an account yet?</span>
            <a href="javascript:;" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
        </div> --}}
    </div>
</div>

