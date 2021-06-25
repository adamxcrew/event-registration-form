<h5 class="my-0">
    <a href="#" class="text-decoration-none text-muted" data-toggle="modal" data-target="#pricing">
        <i class="far fa-question-circle"></i>
    </a>
</h5>
<div class="modal fade" id="pricing" role="dialog" aria-labelledby="pricingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="pricingLabel">Registration Fee</h5>
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
                                Early <br>
                                <span class="font-weight-light">(Until {{ $date->early_bird->format("j M Y") }})</span>
                            </th>
                            <th class="text-center" nowrap colspan="2">
                                Normal <br>
                                <span class="font-weight-light">(Start from {{ $date->normal->format("j M Y") }})</span>
                            </th>
                        </tr>
                        <tr>
                            @foreach (['early', 'normal'] as $item)
                                @foreach ($categories as $category)
                                    <th class="text-center" nowrap>{{ $category->name }}</th>
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->name ?? $package->description }}</td>
                                @foreach (['early', 'normal'] as $item)
                                    @foreach ($categories as $category)
                                        @php
                                            $price = optional($package->prices->where('category_id', $category->id)->first())->{$item} ?? 0
                                        @endphp
                                        <td class="text-center">{{ IDR($price) }}</td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>