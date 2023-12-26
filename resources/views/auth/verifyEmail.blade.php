<x-layoutmain>
    <div class="container col-12 text-center mt-5">
        <h1>{{__('ui.emailOK')}}</h1>
        <p class="lead">{{__('ui.emailOK2')}}</p>

        <form action="/email/verification-notification" method="POST">
            @csrf

            <button type="submit" class="btn btn-primary ">{{__('ui.emailTwo')}}</button>

        </form>
    </div>
</x-layoutmain>