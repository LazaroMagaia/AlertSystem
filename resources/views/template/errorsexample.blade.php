@if ($errors->any())
    <ul class="errors">
        @foreach ($errors->any() as $error)
            <li class="error">{{error}}</li>
        @endforeach
    </ul>
@endif
