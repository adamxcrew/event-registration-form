<div class="modal fade" id="registration" role="dialog" aria-labelledby="registrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="registrationLabel">Informasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 table-responsive">
                <table class="table mb-2">
                    <tbody>
                        <tr>
                            <td nowrap width="30%">Kode Registrasi <span class="float-right">:</span></td>
                            <td class="pl-2">@{{ registration?.code }}</td>
                        </tr>
                        <tr>
                            <td nowrap>Tanggal Registrasi <span class="float-right">:</span></td>
                            <td class="pl-2">@{{ registration?.date }}</td>
                        </tr>
                        <tr>
                            <td nowrap>Paket Workshop <span class="float-right">:</span></td>
                            <td class="pl-2">@{{ registration?.package }} - <b>@{{ registration?.category }}</b></td>
                        </tr>
                        <tr>
                            <td nowrap>Biaya <span class="float-right">:</span></td>
                            <td class="pl-2">@{{ registration?.fee }},-</td>
                        </tr>
                        <tr>
                            <td nowrap>Status <span class="float-right">:</span></td>
                            <td class="pl-2"><span v-html="registration?.status"></span></td>
                        </tr>
                        <tr v-if="registration?.paid_at">
                            <td nowrap>Pembayaran <span class="float-right">:</span></td>
                            <td class="pl-2">
                                <a v-if="registration?.struk_ext == 'pdf'" :href="registration?.paid_struk" class="text-decoration-none text-secondary" target="_blank">
                                    <i class="far fa-file-pdf"></i>
                                    @{{ registration?.paid_at }} - @{{ registration?.paid_by }} (@{{ registration?.paid_bank }})
                                </a>
                                <a v-else href="#" class="text-decoration-none text-secondary" v-on:click.prevent="showPhoto(registration?.paid_struk)">
                                    <i class="far fa-image"></i>
                                    @{{ registration?.paid_at }} - @{{ registration?.paid_by }} (@{{ registration?.paid_bank }})
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <form method="POST" v-show="registration?.status_code == 2">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check mr-1"></i> Verifikasi Pembayaran
                    </button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>