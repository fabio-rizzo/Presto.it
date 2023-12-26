<x-layoutmain>

<div class="container">
    <div class="row">
        <div class="col-12">

            <x-success/>
            <x-error/>

            <p class="h2 my-2 fw-bold">{{__('ui.allAnnouncements')}}</p>
            <div class="row d-flex justify-content-around">
                {{ $announcements->links() }}
                @forelse ($announcements as $announcement)
                {{-- copmponente card degli annunci --}}
                    <x-card-announcement 
                                        :title="$announcement->title"
                                        :description="$announcement->description"
                                        :price="$announcement->price"
                                        :announcement="$announcement" />

                @empty
                    <div class="col12">
                        <div class=" alert alert-warning py-3 shadow ">
                            <p class="lead">{{__('ui.noSearch')}}</p>
                            
                            @if (Auth::check())
                                @if(Auth::user()->role == "revisor")
                                    <p class="lead">{{__('ui.wlc')}} {{Auth::user()->name}}({{__('ui.rev')}}) {{__('ui.look')}}
                                        <a href="{{route('revisor.index')}}" aria-current="page" class=" dropdown-item position-relative text-dark ">
                                            {{__('ui.zonaRev')}}
                                        </a>
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforelse
                {{-- per il paginate, (slider delle pagine) --}}
                {{ $announcements->links() }}

            </div>
        </div>
    </div>
</div>
    


</x-layoutmain>