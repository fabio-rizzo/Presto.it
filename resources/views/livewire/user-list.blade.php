<div class=" ">
    <div class=" mt-3 mb-5">
        <h4 class=" text-center pt-2">
            {{__('ui.users')}}
        </h4>
        <form wire:model.live.debounce.500ms="search" class="px-2" role="search">
            <input class="form-control me-2" type="search" placeholder="{{__('ui.plho')}}" aria-label="Search">
        </form>
    </div>

    <div class="col-12 bg-dark-subtle rounded-top-3 d-flex flex-column p-0 m-0 prova" >
        {{-- lista admin --}}
        <hr class=" hr-black p-0 m-0">

        @foreach($users as $user)
        
            <livewire:user-list-item 
                                    :user="$user"
                                    :key="$user->id"/>
        @endforeach

    </div>
</div>