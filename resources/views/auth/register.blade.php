@extends('master.master')

@section('content')
<style>
   
    @media (max-width: 767.98px) {
        .container.register-container {
            padding-left: 15px;
            padding-right: 15px;
            max-width: 100%;
        }
        
        .container.register-container .row.register-row {
            margin-left: 0;
            margin-right: 0;
        }
        
        .container.register-container .row.register-row .col-4.register-col {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }
    }
    
    .login.register-page .wrapper.register-wrapper {
        transition: all 0.3s ease;
    }
    
    @media (min-width: 992px) {
        .login.register-page .wrapper.register-wrapper {
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    }
    
    @media (max-width: 991.98px) and (min-width: 768px) {
        .login.register-page .wrapper.register-wrapper {
            max-width: 85%;
            margin-left: auto;
            margin-right: auto;
        }
    }
    
    @media (max-width: 767.98px) {
        .login.register-page .wrapper.register-wrapper {
            width: 100% !important;
            max-width: 100% !important;
            padding: 25px 20px !important;
            box-sizing: border-box !important;
            margin: 0 auto !important;
        }

        .login.register-page .wrapper.register-wrapper .title.register-title {
            font-size: 22px !important;
            margin-bottom: 25px !important;
        }

        .login.register-page .wrapper.register-wrapper .field.register-field {
            margin-bottom: 20px !important;
        }

        .login.register-page .wrapper.register-wrapper .field.register-field input.register-input {
            width: 100% !important;
            box-sizing: border-box !important;
            font-size: 16px !important;
            padding: 14px 12px !important;
            max-width: 100% !important;
        }

        .login.register-page .wrapper.register-wrapper .field.register-field input[type="submit"].register-submit {
            padding: 14px !important;
            font-size: 16px !important;
            min-height: 44px; 
        }
    }

    @media (max-width: 575.98px) {
        .login.register-page .wrapper.register-wrapper {
            padding: 20px 15px !important;
        }
        
        .login.register-page .wrapper.register-wrapper .title.register-title {
            font-size: 20px !important;
        }
        
        .login.register-page .wrapper.register-wrapper .field.register-field input.register-input {
            padding: 12px 10px !important;
        }
        
        .login.register-page .wrapper.register-wrapper .field.register-field input[type="submit"].register-submit {
            padding: 12px !important;
        }
    }

    @media (max-width: 374.98px) {
        .login.register-page .wrapper.register-wrapper {
            padding: 15px 12px !important;
        }
        
        .login.register-page .wrapper.register-wrapper .title.register-title {
            font-size: 18px !important;
            margin-bottom: 20px !important;
        }
        
        .login.register-page .wrapper.register-wrapper .field.register-field {
            margin-bottom: 15px !important;
        }
    }

    @media (max-height: 500px) and (orientation: landscape) {
        .login.register-page .wrapper.register-wrapper {
            padding: 15px 20px !important;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .login.register-page .wrapper.register-wrapper .field.register-field {
            margin-bottom: 12px !important;
        }
    }

    @media screen and (max-width: 767px) {
        .login.register-page .wrapper.register-wrapper .field.register-field input[type="text"].register-input,
        .login.register-page .wrapper.register-wrapper .field.register-field input[type="email"].register-input,
        .login.register-page .wrapper.register-wrapper .field.register-field input[type="password"].register-input {
            font-size: 16px !important;
        }
    }
</style>

<br>
<div class="container register-container">
    <div class="row register-row">
        <div class="col-12 col-lg-4 register-col"></div>
        <div class="col-12 col-lg-4 register-col">
            <div class="login register-page">
                <div class="wrapper register-wrapper">
                    <div class="title register-title">
                        Register
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="field register-field">
                        <input type="text" name="name" value="{{ old('name') }}" required class="register-input" />
                        <label class="register-label">Name</label>
                        @error('name')<div class="text-danger register-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field register-field">
                        <input type="email" name="email" value="{{ old('email') }}" required class="register-input" />
                        <label class="register-label">Email Address</label>
                        @error('email')<div class="text-danger register-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field register-field">
                        <input type="password" name="password" required class="register-input" />
                        <label class="register-label">Password</label>
                        @error('password')<div class="text-danger register-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field register-field">
                        <input type="password" name="password_confirmation" required class="register-input" />
                        <label class="register-label">Confirm Password</label>
                        </div>
                        <div class="field register-field">
                        <input type="submit" value="Register" class="register-submit">
                        </div>
                        <div class="signup-link register-link">
                        Do You Have Account? <a href="{{ route('login') }}">Sign in now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 register-col"></div>
    </div>
</div>
<br>
<br>
<br>
<br>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        
        function adjustForMobile() {
            const isMobile = window.innerWidth <= 767;
            const wrapper = document.querySelector('.wrapper.register-wrapper');
            
            if (isMobile && wrapper) {
                
                wrapper.style.maxWidth = '100%';
                wrapper.style.width = '100%';
                
                
                const inputs = document.querySelectorAll('.register-input');
                inputs.forEach(input => {
                    if (!input.style.minHeight) {
                        input.style.minHeight = '44px';
                    }
                });
            }
        }
        
        const isIOS = /iPhone|iPad|iPod/.test(navigator.userAgent);
        const isMobileView = window.innerWidth <= 767;
        
        if (isIOS && isMobileView) {
            document.addEventListener('focus', function(e) {
                if (e.target.matches('.register-input')) {
                    e.target.style.fontSize = '16px';
                }
            }, true);
            
            document.addEventListener('blur', function(e) {
                if (e.target.matches('.register-input')) {
                    setTimeout(() => {
                        e.target.style.fontSize = '';
                    }, 100);
                }
            }, true);
        }
        
        window.addEventListener('resize', adjustForMobile);
        adjustForMobile();
        
        if ('ontouchstart' in window) {
            document.querySelector('.login.register-page').classList.add('touch-device');
        }
        
        const form = document.querySelector('form');
        if (form) {
           
            const originalOnSubmit = form.onsubmit;
            
            form.addEventListener('submit', function(e) {
            
                setTimeout(() => {
                    
                    const firstError = document.querySelector('.register-error');
                    if (firstError && firstError.textContent.trim()) {
                        firstError.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                    }
                }, 100);
            });
        }
    });
</script>
@endsection