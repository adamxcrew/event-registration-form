<div class="modal fade" id="exportModal" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Pilih kegiatan :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('registrations.export') }}" method="POST" download>
                    {{ csrf_field() }}
                    {{-- <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="allEvents" v-model="exportAll" checked>
                            <label class="custom-control-label" for="allEvents">
                                Pilih Semua
                            </label>
                        </div>
                    </div>
                    <hr> --}}
                    <div class="form-group">
                        @foreach ($events as $event)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="events[]" id="{{ $event->category . $event->id }}" value="{{ $event->id }}" :checked="exportAll">
                                <label class="custom-control-label" for="{{ $event->category . $event->id }}">
                                    {{ $event->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success btn-block">
                        <img src="{{ asset('images/excel.png') }}" height="20px" class="mr-1"> EXPORT
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>