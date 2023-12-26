<x-layoutmain>
    <div class="conteiner-fluid bg-gradient button-2 radius-carousel shadow mb-4">
        <div class="row">
            <div class="col-12 text-light p-5">
                <h1 class="display-2 text-center fw-semibold">{{__('ui.zonaAdm')}}</h1>
            </div>
        </div>
    </div>
    <div class=" flex-wrap row ">

        <div class="d-flex flex-wrap justify-content-between">
            <div class="col-lg-4 col-12   bg-dark-subtle rounded-top-2 d-flex flex-column p-0 m-0 mb-3">
                {{-- lista admin --}}
                <h4 class=" text-center pt-2">
                    {{__('ui.listAdm')}}
                </h4>
                <hr class=" hr-black p-0 m-0">
                @foreach($adminList as $admin)
                <div class="col-12 d-flex p-2 d-flex justify-content-between flex-wrap ">
                    <div class="col-6">
                        {{__('ui.name')}} : 
                        <a href="{{route('announcementUserShow',['user'=>$admin])}}" class="">
                            {{$admin->name}}
                        </a>
                        <div class="">
                            {{$admin->email}}
                        </div>
                    </div>
                </div>
                <hr class=" hr-black p-0 m-0">
                @endforeach
            </div>
    
            <div class="col-lg-7 col-12">
                <div class="">
                    <div class="col-12 bg-dark-subtle rounded-top-3 d-flex flex-column p-0 m-0">
                        {{-- lista user piu ricerca --}}
                        <livewire:user-list />
                    </div>
                </div>
            </div>
        </div>
        </div>

</x-layoutmain>