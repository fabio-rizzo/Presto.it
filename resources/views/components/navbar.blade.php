<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow d-flex justify-content-around">
  <!-- Container wrapper -->
  <div class="container m-0">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="/">
      <img id="PrestoLOGO" class="PrestoLogo" src="/logo/logoB.png" alt="PrestoLogo" draggable="false" height="50" />
    </a>

    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav me-3">
        <li class="nav-item d-inline text-nowrap text-center ">
          <a class="nav-link active d-flex align-items-center gap-1 p-2 max-content" aria-current="page" href="/">
            Home
          </a>
        </li>
      </ul>
      <!-- Left links -->


      <!-- Search Bar -->

      <form action="{{route('announcements.search')}}" class="d-flex align-items-center w-100 form-search mt-2 mt-lg-0">
        {{-- @csrf --}}
        <div class="input-group nav-item dropdown">

          {{-- visualizza pagina della categoria, non piu usato --}}
          {{-- <a href="{{ route('announcement.create')}}" class="btn btnCustom btn-light dropdown-toggle"
          id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categorie
          </a> --}}

          <ul class="dropdown-menu dropdown-menu-dark fa-ul">
            <li>
              <a href="#" class="dropdown-item">{{__('ui.choCat')}}</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            @foreach ($categories as $category)
            <li>
              <a href="{{route('categoryShow', compact('category'))}}" class="dropdown-item">
                {{($category->name)}}
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            @endforeach

            <li>
              <hr class="dropdown-divider" />
            </li>
          </ul>

          <form action="{{route('announcements.search')}}" method="GET" class="">
            @csrf
            <div class="container justify-content-center">
              <div class="row">

                <div class="col-md-12 m-auto">

                  <div class=" d-flex g-2 ">

                    <div class="input-group d-flex ">

                      <select name="category" id="category" class=" btn btn-light p-0 m-0  ">
                        <option value="" selected>{{__('ui.cat')}}</option>

                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ __('ui.categoria_'.$category->id) }}</option>
                        @endforeach

                      </select>

                      <input name="searched" type="search" class="form-control {{-- input-text --}} rounded-end-2  " placeholder="{{__('ui.seaCat')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>

                    <div class="ms-2 ">
                      <button class="btn btn-outline-warning btn-lg" type="submit"><i class="fa fa-search"></i></button>
                    </div>

                  </div>


                </div>


              </div>


            </div>

          </form>


        </div>

      </form>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-nav-custom p-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="fi fi-{{ App::currentLocale() }}"></span>
        </a>
        <ul style="min-width: min-content !important;" class="dropdown-menu dropdown-menu-end position-absolute p-0">
          <li>
            <x-_locale lang='it' nation='it' />
          </li>
          <li>
            <x-_locale lang='br' nation='br' />
          </li>
          <li>
            <x-_locale lang='gb' nation='gb' />
          </li>
        </ul>
      </div>

      <!-- Dark Mode checkbox -->
      <!-- <div>
        <div class="d-flex justify-content-center align-items-center">
          <label class="switch">
            <input type="checkbox" id="interruptor">
            <span class="slider round"></span>
          </label>
        </div>
      </div> -->

      <ul class="navbar-nav ms-3">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 position-relative">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-nav-custom p-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ auth()->user()->email }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end position-absolute ">
              <li>
                <a class="dropdown-item" href="/">
                  {{__('ui.ann')}}
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('announcement.create')}}">
                  {{__('ui.insAnn')}}
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              {{-- REVISOR --}}
              @Auth
              @if (Auth::user()->role == 'revisor')
              <li class="">
                <a href="{{route('revisor.index')}}" aria-current="page" class=" dropdown-item position-relative text-dark ">
                  {{__('ui.zonaRev')}}
                  <span class="position-absolute top-0 start-100 translate-middle bg-danger rounded-circle px-2 fs-6">
                    {{App\Models\Announcement::toBeRevisionedCount()}}
                    <!-- <span class="visually-hidden  ">Messaggi non letti</span> -->
                  </span>
                </a>
              </li>
              @endif

              {{-- ADMIN --}}
              @if (Auth::user()->role == 'admin')
              <li class="">
                <a href="{{route('admin.index')}}" aria-current="page" class=" dropdown-item position-relative text-dark ">
                  {{__('ui.zonaAdm')}}
                </a>
              </li>
              @endif
              @endauth

              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="btn bg-nav-custom text-nav-custom2 mx-1 fw-bold ">Logout</button>
                </form>
              </li>
            </ul>
          </li>
          @else
          <div class="d-flex gap-2 mt-2 mt-lg-0">
            <li class="nav-item">
              <a href="/login" class="btn btn-sm logo-bg text-black mx-1 btnCustom">{{__('ui.access')}}</a>
            </li>
          </div>
          @endauth
        </ul>
      </ul>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<!-- Dark Mode -->
<!-- <style>
  .switch {
    position: relative;
    display: inline-block;
    width: 47px;
    height: 24px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #333;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #333;
  }

  input:checked+.slider:before {
    transform: translateX(23px);
    background-color: rgb(129, 124, 124);
  }

  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>

<script>
  const interruptor = document.getElementById("interruptor")
  interruptor.addEventListener("change", function() {
    if (this.checked) {
      console.log("1")
      document.body.style.backgroundColor = "black";
      document.body.style.color = "white";
    } else {
      document.body.style.backgroundColor = "white"
    }
  })
</script> -->