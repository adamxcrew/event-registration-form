<div class="modal fade" id="registrationFeeModal" role="dialog" aria-labelledby="registrationFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="registrationFeeModalLabel">Registration Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="align-middle" nowrap rowspan="2">Package</th>
                            <th class="text-center" nowrap colspan="2">
                                Early Bird <br>
                                <span class="font-weight-light">(Until {{ $date->early_bird->format("j M Y") }})</span>
                            </th>
                            <th class="text-center" nowrap colspan="2">
                                Normal <br>
                                <span class="font-weight-light">(Start from {{ $date->normal->format("j M Y") }})</span>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" nowrap>Specialist</th>
                            <th class="text-center" nowrap>GP & Resident</th>
                            <th class="text-center" nowrap>Specialist</th>
                            <th class="text-center" nowrap>GP & Resident</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->description }}</td>
                                <td class="text-center">Rp. {{ number_format($package->fee[0]->early_fee) }}</td>
                                <td class="text-center">Rp. {{ number_format($package->fee[1]->early_fee) }}</td>
                                <td class="text-center">Rp. {{ number_format($package->fee[0]->normal_fee) }}</td>
                                <td class="text-center">Rp. {{ number_format($package->fee[1]->normal_fee) }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>