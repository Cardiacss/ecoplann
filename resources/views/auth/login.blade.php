<!-- views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoPlan</title>

    <!-- REMIXICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <!-- LOGIN IMAGE -->
    <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0" mask-type="alpha">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />
        </mask>

        <g mask="url(#mask0)">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />
            <image class="login__img" href="{{ asset('image/bg-login.jpg') }}" width="130vw" />
        </g>
    </svg>

    <!-- LOGIN -->
    <div class="login container grid" id="loginAccessRegister">
        <!-- LOGIN ACCESS -->
        <div class="login__access">
            <h1 class="login__title">Log in to your account.</h1>

            <div class="login__area">
                <form action="{{ route('login.post') }}" method="POST" class="login__form">
                    @csrf
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="email" name="email" id="email" required placeholder=" "
                                   class="login__input @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}">
                            <label for="email" class="login__label">Email</label>
                            <i class="ri-mail-fill login__icon"></i>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="login__box">
                            <input type="password" name="password" id="password" required placeholder=" "
                                   class="login__input @error('password') is-invalid @enderror">
                            <label for="password" class="login__label">Password</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="login__button">Login</button>
                </form>

                <p class="login__switch">
                    Don't have an account?
                    <button id="loginButtonRegister">Create Account</button>
                </p>
            </div>
        </div>

        <!-- REGISTER -->
        <div class="login__register">
            <h1 class="login__title">Create new account.</h1>

            <div class="login__area">
                <form action="{{ route('register') }}" method="POST" class="login__form">
                    @csrf
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="text" name="name" id="names" required placeholder=" "
                                   class="login__input @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}">
                            <label for="names" class="login__label">Names</label>
                            <i class="ri-id-card-fill login__icon"></i>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="login__box">
                            <input type="number" name="phone" id="phone" required placeholder=" "
                                   class="login__input @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}">
                            <label for="phone" class="login__label">No. HP</label>
                            <i class="ri-phone-fill login__icon"></i>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="login__box">
                            <input type="password" name="password" id="passwordCreate" required placeholder=" "
                                   class="login__input @error('password') is-invalid @enderror">
                            <label for="passwordCreate" class="login__label">Password</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="login__box">
                        <input type="text" name="email" id="emailcreate" required placeholder=" "
                               class="login__input @error('email') is-invalid @enderror">
                        <label for="emailcreate" class="login__label">E - Mail</label>
                        @error('emai;')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                    <button type="submit" class="login__button">Create account</button>
                </form>

                <p class="login__switch">
                    Already have an account?
                    <button id="loginButtonAccess">Log In</button>
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
