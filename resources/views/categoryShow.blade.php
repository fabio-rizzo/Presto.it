<x-layoutmain>
    <div class="conteiner-fluid p-5 bg-gradient button-2 radius-carousel shadow mb-4">
        <div class="row">
            <div class="col-12 text-light p-5">
                <h1 class="display-2 text-center fw-semibold">{{__('ui.exploreCat')}} {{__('ui.categoria_'.$category->id)}}</h1>
            </div>
        </div>
    </div>
    <div class="conteiner">
        <div class="row">
            <div class="col-12">
            <div class="row d-flex justify-content-around">
            {{ $announcements->links()}}
                    @forelse ($announcements as $announcement)

                        <x-card-announcement 
                                        :title="$announcement->title"
                                        :description="$announcement->description"
                                        :price="$announcement->price"
                                        :announcement="$announcement"  

                    />
                    @empty
                        <div class="col-12">
                            <p class="h1">{{__('ui.noAnnCat')}}</p>
                            <p class="h2">{{__('ui.create1')}} <a href="{{route('announcement.create')}}" class="btn btn-success shadow">{{__('ui.createAnn')}}</a></p>
                        </div>
                    @endforelse
                    {{ $announcements->links()}}
                </div>
            </div>
        </div>
    </div>

</x-layoutmain>