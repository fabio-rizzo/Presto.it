<div>
    <x-success />
    <form wire:submit.prevent="store" class="mb-5 button-1 text-light  p-5 radius-carousel" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">

            <!-- Titolo -->
            <div class="col-12">
                <label for="title">{{__('ui.title')}}</label>
                <input type="text" wire:model.live.debounce.500ms="title" class="form-control @error('title') is-invalid @enderror">
                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Descrizione -->
            <div class="col-12">
                <label for="description">{{__('ui.desc')}}</label>
                <textarea wire:model.live.debounce.500ms="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Categoria -->
            <div class="col-12">
                <label>{{__('ui.cat')}}</label>

                <div class="col-12">

                    <select wire:model.live.debounce.500ms="category" id="category" class="form-select">
                        <option value="" class="">{{__('ui.cho1Cat')}}</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ __('ui.categoria_'.$category->id) }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-danger small">{{ $message }}</span> @enderror

                </div>
                @error('categories') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Prezzo -->
            <div class="col-12">
                <label for="price">{{__('ui.price')}}</label>
                <input step="any" type="number" wire:model.live.debounce.500ms="price" class="form-control @error('price') is-invalid @enderror">
                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <!-- Immagini -->
            <div class="col-12">
                <label>{{__('ui.img')}}</label>
                <input wire:model.live.debounce.500ms="temporary_images" type="file" name="images" multiple class="form-control shadow @error('temporary_images') is-invalid @enderror @error('temporary_images.*') is-invalid @enderror" placeholder="Img">

                @error('temporary_images')
                <span class="text-danger small">{{ $message }}</span>
                @enderror

                @error('temporary_images.*')
                <span class="text-danger small">{{ $message }}</span>
                @enderror


            </div>

            <!-- Foto preview -->
            @if(!empty($images))
            <div class="col-12">
                <p>Photo preview:</p>
                <div class="row border border-4 text-center rounded shadow py-4">
                    @foreach($images as $key => $image)
                    <div class="col my-3">
                        <img style="width: 200px;" src="{{$image->temporaryUrl()}}" class="img-preview mx-auto shadow rounded"></img>
                        <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto" wire:click="removeImage({{$key}})">
                            {{__('ui.elimina')}}
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Bottone -->
            <div class="col-12">
                <button type="submit" class="btn logo-bg fw-semibold mt-2 mb-3 text-nav-custom2 btn-fabio">{{__('ui.createAnn')}}</button>
            </div>
        </div>
    </form>
    
</div>