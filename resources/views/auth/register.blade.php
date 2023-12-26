<x-layoutmain>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">{{__('ui.reg')}}</h2>
                            <form action="/register" method="POST">
                                @csrf
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" name="name" id="nameForm" class="form-control" value="{{old('name')}}"/>
                                            <label class="form-label" for="name">{{__('ui.name')}}</label>
                                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" name="lastName" id="lastName" class="form-control" value="{{old('lastName')}}"/>
                                            <label class="form-label"  for="lastName">{{__('ui.surname')}}</label>
                                            @error('lastName') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="emailForm" class="form-control" value="{{old('email')}}" />
                                    <label class="form-label" for="email">Email</label>
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="passwordForm" class="form-control" />
                                    <label class="form-label" for="password">Password</label>
                                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="password_confirmation" id="password_confirmationForm" class="form-control" />
                                    <label class="form-label" for="password_confirmation">{{__('ui.confPssw')}}</label>
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
                                    {{__('ui.reg')}}
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
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 imageForm-registrazione">
                    <img src="form-image/registrazione.png{{-- https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg --}}"
                        class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

</x-layoutmain>