@extends('master.master')

@section('content')
<style>

        .container.login-container {
            padding-left: 15px;
            padding-right: 15px;
            max-width: 100%;
        }
        
        .container.login-container .row.login-row {
            margin-left: 0;
            margin-right: 0;
        }

        .container.login-container .row.login-row .col-4.login-col {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }
    

    .login.login-page .wrapper.login-wrapper {
        transition: all 0.3s ease;
    }

    @media (min-width: 992px) {
        .login.login-page .wrapper.login-wrapper {
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media (max-width: 767.98px) {
        .login.login-page .wrapper.login-wrapper {
            width: 100% !important;
            max-width: 100% !important;
            padding: 25px 20px !important;
            box-sizing: border-box !important;
            margin: 0 auto !important;
        }
    

        .login.login-page .wrapper.login-wrapper .title.login-title {
            font-size: 22px !important;
            margin-bottom: 25px !important;
        }

        .login.login-page .wrapper.login-wrapper .field.login-field {
            margin-bottom: 20px !important;
            position: relative;
        }

        .login.login-page .wrapper.login-wrapper .field.login-field input.login-input {
            width: 100% !important;
            box-sizing: border-box !important;
            font-size: 16px !important;
            padding: 14px 12px !important;
            max-width: 100% !important;
        }

        .login.login-page .wrapper.login-wrapper .field.login-field label.login-label {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .login.login-page .wrapper.login-wrapper .field.login-field input:focus + label.login-label,
        .login.login-page .wrapper.login-wrapper .field.login-field input:valid + label.login-label {
            top: 0;
            font-size: 12px;
            background: white;
            padding: 0 5px;
        }
        
        .login.login-page .wrapper.login-wrapper .field.login-field input[type="submit"].login-submit {
            padding: 14px !important;
            font-size: 16px !important;
            min-height: 44px;
        }

        .login.login-page .wrapper.login-wrapper .content.login-content {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            margin-bottom: 25px !important;
            flex-wrap: wrap;
        }

        .login.login-page .wrapper.login-wrapper .content.login-content .checkbox.login-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .login.login-page .wrapper.login-wrapper .content.login-content .checkbox.login-checkbox input[type="checkbox"].login-checkbox-input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            margin-top: 0;
        }

        .login.login-page .wrapper.login-wrapper .content.login-content .checkbox.login-checkbox label.login-checkbox-label {
            margin-bottom: 0;
            font-size: 14px;
            white-space: nowrap;
        }

        .login.login-page .wrapper.login-wrapper .content.login-content .pass-link.login-pass-link {
            margin-top: 0;
        }
        
        .login.login-page .wrapper.login-wrapper .content.login-content .pass-link.login-pass-link a.login-link {
            font-size: 14px;
            white-space: nowrap;
        }
    }

    @media (max-width: 575.98px) {
        .login.login-page .wrapper.login-wrapper {
            padding: 20px 15px !important;
        }
        
        .login.login-page .wrapper.login-wrapper .title.login-title {
            font-size: 20px !important;
        }
        
        .login.login-page .wrapper.login-wrapper .field.login-field input.login-input {
            padding: 12px 10px !important;
        }
        
        .login.login-page .wrapper.login-wrapper .field.login-field input[type="submit"].login-submit {
            padding: 12px !important;
        }

        .login.login-page .wrapper.login-wrapper .content.login-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .login.login-page .wrapper.login-wrapper .content.login-content .pass-link.login-pass-link {
            align-self: flex-end;
        }
    }

    @media (max-width: 374.98px) {
        .login.login-page .wrapper.login-wrapper {
            padding: 15px 12px !important;
        }
        
        .login.login-page .wrapper.login-wrapper .title.login-title {
            font-size: 18px !important;
            margin-bottom: 20px !important;
        }
        
        .login.login-page .wrapper.login-wrapper .field.login-field {
            margin-bottom: 15px !important;
        }
        
        .login.login-page .wrapper.login-wrapper .content.login-content {
            flex-direction: column;
            gap: 8px;
        }
    }

    @media screen and (max-width: 767px) {
        .login.login-page .wrapper.login-wrapper .field.login-field input[type="email"].login-input,
        .login.login-page .wrapper.login-wrapper .field.login-field input[type="password"].login-input {
            font-size: 16px !important;
        }
    }
</style>

<br />
<div class="container login-container">
    <div class="row login-row">
        <div class="col-12 col-lg-4 login-col"></div>
        <div class="col-12 col-lg-4 login-col">
            <div class="login login-page">
                <div class="wrapper login-wrapper">
                    <div class="title login-title">
                        Login Form
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                     
                        <div class="field login-field">
                            <input type="email" name="email" value="{{ old('email') }}" required class="login-input" />
                            <label class="login-label">Email Address</label>
                            @error('email')
                                <div class="text-danger login-error">{{ $message }}</div>
                            @enderror
                        </div>
                        
                  
                        <div class="field login-field">
                            <input type="password" name="password" required class="login-input" />
                            <label class="login-label">Password</label>
                            @error('password')
                                <div class="text-danger login-error">{{ $message }}</div>
                            @enderror
                        </div>
                        
                      
                        <div class="content login-content">
                            <div class="checkbox login-checkbox">
                                <input type="checkbox" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }} class="login-checkbox-input" />
                                <label for="remember-me" class="login-checkbox-label">Remember me</label>
                            </div>
                            <div class="pass-link login-pass-link">
                                <a href="{{ route('password.request') }}" class="login-link">Forgot password?</a>
                            </div>
                        </div>
                        
                      
                        <div class="field login-field">
                            <input type="submit" value="Login" class="login-submit" />
                        </div>
                        
                      
                        <div class="signup-link login-signup-link">
                            Not a member? <a href="{{ route('register') }}" class="login-link">Signup now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 login-col"></div>
    </div>
</div>
<br />
<br />
<br />
<br />

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function adjustForMobile() {
            const isMobile = window.innerWidth <= 767;
            const wrapper = document.querySelector('.wrapper.login-wrapper');
            
            if (isMobile && wrapper) {
                wrapper.style.maxWidth = '100%';
                wrapper.style.width = '100%';

                const inputs = document.querySelectorAll('.login-input, .login-submit');
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
                if (e.target.matches('.login-input')) {
                    e.target.style.fontSize = '16px';
                }
            }, true);
            
            document.addEventListener('blur', function(e) {
                if (e.target.matches('.login-input')) {
                    setTimeout(() => {
                        e.target.style.fontSize = '';
                    }, 100);
                }
            }, true);
        }

        const inputFields = document.querySelectorAll('.field.login-field input.login-input');
        inputFields.forEach(input => {

            if (input.value.trim() !== '') {
                input.classList.add('filled');
            }
            
            input.addEventListener('input', function() {
                const label = this.nextElementSibling;
                if (label && label.classList.contains('login-label')) {
                    if (this.value.trim() !== '') {
                        label.style.top = '0';
                        label.style.fontSize = '12px';
                        label.style.background = 'white';
                        label.style.padding = '0 5px';
                    } else {
                        label.style.top = '50%';
                        label.style.fontSize = '';
                        label.style.background = 'transparent';
                        label.style.padding = '0';
                    }
                }
            });
        });

        function adjustContentLayout() {
            const content = document.querySelector('.content.login-content');
            if (content) {
                if (window.innerWidth < 576) {
                  
                    content.style.flexDirection = 'column';
                    content.style.alignItems = 'flex-start';
                    content.style.gap = '10px';
                } else {
                 
                    content.style.flexDirection = 'row';
                    content.style.justifyContent = 'space-between';
                    content.style.alignItems = 'center';
                    content.style.gap = '0';
                }
            }
        }

        window.addEventListener('resize', function() {
            adjustForMobile();
            adjustContentLayout();
        });

        adjustForMobile();
        adjustContentLayout();

        inputFields.forEach(input => {
            input.dispatchEvent(new Event('input'));
        });
    });
</script>
@endsection