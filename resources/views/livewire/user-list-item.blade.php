<div>
    <div class="col-12 d-flex p-2 d-flex justify-content-between flex-wrap ">
        <div class="col-6">
            {{__('ui.name')}} : 
            <a href="{{route('announcementUserShow',['user'=>$user])}}" class="">
                {{$user->name}}
            </a>
            <div>
                {{$user->email}}
            </div>
            <div>
                @if($user->role == 'revisor')
                {{__('ui.ruolo')}} : <strong class=" text-bg-warning rounded-2 px-1">{{$user->role}}</strong>
                @endif
            </div>
        </div>

        <div>
            <div class="d-flex">
                <div class="pe-1">
                    <select wire:model="role" class="form-select form-select-sm">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name}}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div>
                    <button type="button" class="btn btn-sm btn-secondary" wire:click="updateUser">
                        {{__('ui.modifica')}}
                    </button>
                </div>
                <div class="">
                    <button type=" button" class="btn btn-sm btn-danger ms-2" wire:click="delete({{ $user->id }})">
                        {{__('ui.elimina')}}
                    </button>
                </div>
            </div>
            
        </div>
    </div>
    <hr class=" hr-black p-0 m-0">
</div>
