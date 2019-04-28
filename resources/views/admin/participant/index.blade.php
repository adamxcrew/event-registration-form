@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                {{-- <form action="{{ url()->full() }}" method="GET">
                    <div class="form-inline">
                        <div class="input-group app-shadow">
                            <input type="search" name="keyword" placeholder="Search" aria-label="Search" class="form-control form-control-navbar border-0" value="{{ request()->keyword }}">
                            <div class="input-group-append">
                                <div class="input-group-text bg-white border-0">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> --}}

                <div class="form-inline">
                    <div class="input-group app-shadow">
                        <input type="text" id="keyword" name="keyword" placeholder="Search" aria-label="Search" class="form-control form-control-navbar border-0">
                        <div class="input-group-append">
                            <div class="input-group-text bg-white border-0">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                    <img src="{{ asset('images/excel.png') }}" height="20px" class="mr-1"> EXPORT
                </button>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-2">
                        <span class="m-1">
                            Registrasi Peserta

                            <span class="badge badge-pill badge-secondary">{{ $notpaid }}</span>
                            <span class="badge badge-pill badge-warning">{{ $waiting }}</span>
                            <span class="badge badge-pill badge-success">{{ $paid }}</span>
                        </span>
                        <form class="form-inline ml-auto mr-2">
                            <select name="e" class="form-control form-control-sm" onchange="this.form.submit()">
                                <option value="">Semua Seminar</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}" {{ $request->e == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </form>
                        <div class="dropdown mr-1">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter mr-2"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('participants.index') }}">Semua Peserta</a>
                                <a class="dropdown-item" href="{{ route('participants.index') }}?filter=0">
                                    <span class="badge badge-secondary">Belum Membayar</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('participants.index') }}?filter=1">
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('participants.index') }}?filter=2">
                                    <span class="badge badge-success">Pembayaran Lunas</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table id="datatable" class="table table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th width="1%">#</th>
                                <th>Kode Reg.</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telp.</th>
                                <th class="text-center">Pembayaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->user->registration->code }}</td>
                                    <td>{{ $item->user->registration->created_at->format("d/m/Y") }}</td>
                                    <td nowrap>{{ $item->name }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td class="text-center">{!! $item->user->registration->status() !!}</td>
                                    <td class="text-right" nowrap>
                                        <a href="#" v-on:click.prevent="showBilling('{{ route('bill', $item->user->id) }}')" class="text-secondary mx-2 text-decoration-none">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                        <a href="{{ route('participants.show', $item->id) }}" class="text-secondary mx-2 text-decoration-none">
                                            <i class="fas fa-user-circle"></i>
                                        </a>
                                        <form action="{{ route('participants.destroy', $item->id) }}" method="POST" class="d-inline">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="javascript:;" class="text-secondary ml-2 text-decoration-none" onclick="$(this).parent().submit()">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </form>
                                        {{-- <a href="#" class="text-secondary ml-2 text-decoration-none">
                                            <i class="far fa-trash-alt"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.participant.bill')
@include('admin.participant.export')

<light-box ref="lightbox"></light-box>
@endsection

@section('scripts')
<script>
    new Vue({
        el: '#app',
        data: {
            exportAll: true,
            exports: [],
            bill: {
                id: '',
                code: '',
                date: '',
                package: '',
                category: '',
                fee: '',
                status: '',
                status_code: 0,
                paid_at: '',
                paid_by: '',
                paid_bank: '',
                paid_struk: ''
            }
        },
        methods: {
            showBilling(route) {
                axios.get(route).then(({ data }) => {
                    this.bill = data
                    $('#billModal').modal('show')
                    $('#billModal .modal-footer form').attr('action', data.verification)
                })
            },
            showPhoto(src, ext=null) {
                let image = {
                    src: src,
                    ext: ext
                }
                this.$refs.lightbox.open(image)
            }
        }
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    let table = $('#datatable').DataTable({
        "ordering": true,
        "info": true,
        "paging": true,
        "pageLength": 15,
        "searching": true,
        "dom": "<'table-responsive't><'card-footer px-3'<'row'<'col'i><'col'p>>>",
    });
    $('#keyword').on('keyup', function () {
        table.search( this.value ).draw();
    });

    $('#datatable_info').addClass('py-2');
    $('#datatable').addClass('mt-0')
</script>
@endsection
