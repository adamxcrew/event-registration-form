@once
    @if($errors && $errors->count() > 0)
        <div class="alert alert-danger alert-dismissible {{ $attributes['class'] }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="mb-0">
                <i class="icon fas fa-ban"></i> <b>Failure !</b>
                Something is wrong ({{ $errors->count() }} errors).
                <a href="#failureDetail" data-toggle="collapse" class="text-decoration-none font-weight-bold text-white">See detail...</a>
            </p>

            <ul type="square" style="padding-left: 20px" id="failureDetail" class="collapse multi-collapse mt-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endonce
