<form action="{{ route('set_language_locale', $lang) }}" method="POST">
    @csrf
    <button class="dropdown-item px-3 py-2" type="submit" style="background-color:trasparent; border:none">
        <span class="fi fi-{{ $nation }}"></span>
    </button>
</form>