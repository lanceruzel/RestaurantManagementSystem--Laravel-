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
                                <form class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control" name="firstName"
                                                placeholder="First Name">
                                                
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="middleName"
                                                placeholder="Middle Name">
                                        </div>                                       
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lastName"
                                            placeholder="Last Name">
                                    </div>

                                    <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="birthdate"
                                            placeholder="Birthdate">
                                            </div>

                                            <div class="col-sm-6">
                                                <select class="form-select-user form-control" name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Address">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email Address">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control" name="password"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" name
                                                id="exampleRepeatPassword" placeholder="Repeat Password">
                                        </div>
                                    </div>

                                    <a href="login.html" class="btn btn-primary btn-user btn-block mt-4">
                                        Register Account
                                    </a>
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