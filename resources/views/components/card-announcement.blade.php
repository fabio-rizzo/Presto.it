<div class="col-12 col-md-4 m-2 mb-2  d-flex justify-content-center max-content p-0 ">
    <div class="card shadow card-width ">
        <a href="{{route('announcements.show',compact('announcement'))}}">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(1200, 1200) : 'https://picsum.photos/200'}}" alt="foto" class="card-img-top">
            </div>
        </a>

        <div class="card-body p-0 m-2 d-flex flex-column ">

            <a href="{{route('announcements.show',compact('announcement'))}}" class="text-decoration-none text-dark">
                <h5 class="card-title text-capitalize fw-semibold ">{{ $title }}</h5>
            </a>
            <p class="card-text text-truncate">{{ $description }}</p>





            <div class="col-12 mt-auto">

                <div class="d-flex justify-content-center">
                    <a href="{{route('categoryShow',['category'=>$announcement->category])}}" class="btn button-2 shadow w-100 btnCustomCard">{{__('ui.categoria_'.$announcement->category->id)}}</a>
                </div>

                <div class="mt-2 mb-0 d-flex justify-content-center ">
                    <x-prezzo :announcement="$announcement" />
                </div>
            </div>

        </div>

        <div class="card-footer m-0 ">
            <p class="p-0 m-0">{{__('ui.date')}} {{$announcement->created_at->format('d/m/Y')}}</p>
            <p class="p-0 m-0">{{__('ui.autor')}}
                <a href="{{route('announcementUserShow',['user'=>$announcement->user, 'category'=>$announcement->category])}}" class="">
                    {{$announcement->user->name}}
                </a>
            </p>
            @auth()
                @if(auth()->user()->id == $announcement->user->id)
                    <span>
                        <a href="{{route('announcement.edit', ['announcement' => $announcement])}}" class="btn btn-sm btn-dark ">{{__('ui.modifica')}}</a>
                    </span>
                @endif
            @endauth
        </div>
    </div>
</div>