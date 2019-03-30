@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="{{ url()->full() }}" method="GET">
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
                </form>
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
                        <div class="dropdown ml-auto mr-1">
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
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-hover">
                            <thead>
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
                                @forelse ($participants as $item)
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
                                @empty
                                    <tr>
                                       <td colspan="8" class="text-center text-muted"><i>Tidak ada data...</i></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    {{ $participants->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.participant.bill')

<light-box ref="lightbox"></light-box>
@endsection

@section('scripts')
<script>
    new Vue({
        el: '#app',
        data: {
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
@endsection
