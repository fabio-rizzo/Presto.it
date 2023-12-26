<x-layoutmain>
    <div class="container-fluid p-4 bg-gradient card-annuncio shadow mb-4 radius-left-top">
        <div style="min-height: 615px;" class="row">
            <div class="col-6 d-flex flex-column text-light p-5">
                <a href="{{route('categoryShow',['category'=>$announcement->category])}}" class="my-2 pt-2 shadow btn btn-cris max-content position-relative button-annuncio fw-semibold">{{$announcement->category->name}}</a>
                <h1 class="display-2 text-capitalize text-center fw-semibold titolo-annuncio mt-4">{{$announcement->title}}</h1>
                <hr class="text-annuncio">
                <!-- <h5 class=" pt-3 text-capitalize">{{$announcement->title}}</h5> -->
                <p class="mt-3 text-annuncio">{{$announcement->description}}</p>
                <div class="col d-flex align-items-end flex-column-reverse ">
                    <div class="row w-100">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column-reverse text-start">
                                <p class="m-0 p-0 text-annuncio">{{__('ui.date')}} {{$announcement->created_at->format('d/m/Y')}}</p>
                                <p class="m-0 p-0 text-annuncio">{{__('ui.autor')}} {{$announcement->user->name}}</p>
                            </div>
                            <div class="text-end">
                                <x-prezzo :announcement="$announcement" />
                                {{-- <a href="{{route('categoryShow',['category'=>$announcement->category])}}" class="my-2 pt-2 shadow btn logo-bg btn-yan fw-semibold">{{__('ui.cart')}}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center">

                <div id="showCarousel" class="carousel slide">
                    @if(!$announcement->images->isEmpty())
                    <div class="carousel-inner shadow radius-carousel">
                        @foreach($announcement->images as $image)
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
</x-layoutmain>