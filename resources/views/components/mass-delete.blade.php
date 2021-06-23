<div class="d-flex align-items-center flex-grow-1 {{ $attributes['class'] }}">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" v-model="checkAll" name="checkAll" class="custom-control-input" id="checkAll">
        <label class="custom-control-label" for="checkAll">
            <i class="fas fa-angle-down mr-2"></i>
            <template v-if="checked.length">
                Selected : <b v-text="checked.length"></b>
            </template>
            <template v-else>
                Total : <b>{{ $total }}</b>
            </template>
        </label>
    </div>

    @if(isset($action) && (! is_null($action) || $action != ''))
        <div class="ml-auto" v-show="checked.length" style="display: none;">
            <form action="{{ $action }}" class="d-inline-block" method="POST">
                @csrf @method('delete')
                <input type="hidden" v-for="item in checked" name="ids[]" :value="item">
                <a href="{{ $action }}" class="text-danger font-weight-bold" confirm="delete">
                    <i class="far fa-trash-alt fa-fw"></i> <span class="d-none d-sm-inline-block">Delete selected</span>
                </a>
            </form>
        </div>

        @once
            <x-alert.confirm-before-delete />
        @endonce
    @endif
</div>
