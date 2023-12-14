@include('partials.header')

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                                <form method="POST" action="/account/register">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}"
                                                placeholder="First Name">
                                                
                                            <div class="invalid-feedback">
                                                @error('firstName')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ old('middleName') }}"
                                                placeholder="Middle Name">

                                            <div class="invalid-feedback">
                                                @error('middleName')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>                                       
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}"
                                            placeholder="Last Name">

                                        <div class="invalid-feedback">
                                            @error('lastName')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}"
                                                placeholder="Birthdate">

                                                <div class="invalid-feedback">
                                                    @error('birthdate')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <select class="form-select-user form-control  @error('gender') is-invalid @enderror" name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : null}}>Male</option>
                                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : null}}>Female</option>
                                                </select>

                                                <div class="invalid-feedback">
                                                    @error('gender')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"
                                            placeholder="Address">

                                        <div class="invalid-feedback">
                                            @error('address')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}"
                                            placeholder="Contact Number">
                                        
                                        <div class="invalid-feedback">
                                            @error('contact')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                            placeholder="Email Address">
                                        
                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="exampleInputPassword" placeholder="Password">
                                            
                                            <div class="invalid-feedback">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                                id="exampleRepeatPassword" placeholder="Repeat Password">

                                            <div class="invalid-feedback">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
                                        Register Account
                                    </button>
                                </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</header>