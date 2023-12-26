<x-layoutmain>
    <section class="text-center text-lg-start">
        <style>
            
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">

                    <div class="card cascading-right-login">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">{{__('ui.access')}}</h2>
                            <form action="/login" method="POST">
                                @csrf
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="emailForm" class="form-control" value="{{old('email')}}"/>
                                    <label class="form-label" for="email">Email</label>
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="passwordForm" class="form-control" />
                                    <label class="form-label" for="password">Password</label>
                                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <!-- Checkbox
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="checkboxForm"
                                        checked />
                                    <label class="form-check-label" for="checkboxForm">
                                        {{__('ui.connect')}}
                                    </label>
                                </div> -->

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    {{__('ui.access')}}
                                </button>

                                <!-- Register buttons
                                <div class="text-center">
                                    <p>{{__('ui.logWith')}}</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div> -->
                                <div>
                                    <p class="  ">
                                        {{__('ui.regNews')}}
                                        <span>
                                                <a href="/register" class=" text-black fw-bold">{{__('ui.reg')}}</a>
                                        </span>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 imageForm-login">
                    <img src="form-image/login.png"
                        class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

</x-layoutmain>