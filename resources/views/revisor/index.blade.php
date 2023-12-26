<x-layoutmain>
    @if($announcement_to_check)
    <x-success />
    <x-error />
        <div class="">
            <div class="container-fluid p-4 bg-gradient card-annuncio shadow mb-4 radius-left-top">
                <div style="min-height: 615px;" class="row">
                    <div class="col-6 d-flex flex-column px-5 pb-5 pt-4">
                        <div class="container-fluid text-light p-1 bg-gradient radius-carousel logo-bg shadow">
                            <h2 class="display-3 text-center fw-semibold">{{$announcement_to_check ? __('ui.revAnn') : __('ui.noAnn') }}</h2>
                        </div>
                        <h6 class="text-capitalize text-center fw-semibold titolo-annuncio mt-4">{{$announcement_to_check->title}}</h6>
                        <hr class="text-annuncio">

                        <p class="mt-3 text-annuncio">{{$announcement_to_check->description}}</p>
                        <div class="col d-flex align-items-end flex-column-reverse">
                            <div class="row w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column-reverse text-start">
                                        <p class="m-0 p-0 text-annuncio">{{__('ui.date')}} {{$announcement_to_check->created_at->format('d/m/Y')}}</p>
                                        <p class="m-0 p-0 text-annuncio">
                                            {{__('ui.autor')}} 
                                            <a href="{{route('announcementUserShow',['user'=>$announcement_to_check->user, 'category'=>$announcement_to_check->category])}}" class="">
                                                {{$announcement_to_check->user->name}}
                                            </a>
                                        </p>
                                        
                                    </div>
                                    <div class="text-end">
                                        <x-prezzo :announcement="$announcement_to_check" />
                                        <div class="row mt-3">
                                            <div class="d-flex gap-5">
                                                <form action="{{route('revisor.accept_announcement',['announcement'=>$announcement_to_check])}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-success shadow" type="submit">{{__('ui.ok')}}</button>
                                                </form>

                                                <div>
                                                    <form action="{{route('revisor.reject_announcement',['announcement'=>$announcement_to_check])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-danger shadow" type="submit">{{__('ui.no')}}</button>
                                                    </form>
    
                                                    <form action="{{route('revisor.destroy_announcement',['announcement'=>$announcement_to_check])}}" method="POST" class=" pt-1 ">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-danger shadow" type="submit">{{__('ui.elimina')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center">

                        <div id="showCarousel" class="carousel slide">
                            @if(!$announcement_to_check->images->isEmpty())
                            <div class="carousel-inner shadow radius-carousel">
                                @foreach($announcement_to_check->images as $image)
                                    <div class="carousel-item @if($loop->first)active @endif">
                                        <img src="{{$image->getUrl(1200, 1200)}}" class="img-fluid" alt="...">
                                    </div>
                                @endforeach
                                <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="col-12 py-2">
                                <div class="col-12"><h3>Revisione Immagini</h3></div>
                                <div class="d-flex flex-wrap ">
                                    <div class=" px-1">Adulti: <span class="{{$image->adult}}"></span></div>
                                    <div class=" px-1">Satira: <span class="{{$image->spoof}}"></span></div>
                                    <div class=" px-1">Medicina: <span class="{{$image->medical}}"></span></div>
                                    <div class=" px-1">Violenza: <span class="{{$image->violence}}"></span></div>
                                    <div class=" px-1">Contenuto Ammiccante: <span class="{{$image->racy}}"></span></div>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <div class="col-12"><h3>Tags</h3></div>
                                <div class="d-flex flex-wrap ">
                                    @if($image->labels)
                                        @foreach($image->labels as $label)
                                            <p class="d-inline pe-2 m-0"> #{{ $label }}, </p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @else
                            <div class="carousel-inner shadow radius-carousel">
                                <div class="carousel-item active">
                                    <img src="https://picsum.photos/id/28/1200/1200" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://picsum.photos/id/30/1200/1200" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://picsum.photos/id/29/1200/1200" class="d-block w-100" alt="...">
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- <div class="conteiner"> -->
                <!-- <div class="row"> -->
                <div class="col-12">
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    @else
    <h1>{{__('ui.noAnn')}}</h1>
    @endif

</x-layoutmain>