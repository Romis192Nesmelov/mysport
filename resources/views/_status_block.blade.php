@if (!$item || ($item && $item->status != 3) || $adminMode)
    @include('_radio_button_block', [
        'name' => 'status',
        'values' => $types,
        'activeValue' => $item ? $item->status : 0
    ])
@endif
@if ($item && count($types) < 4 && $item->status > 1)
    <div class="status-label-block">
        @include('_status_multiply_block',['status' => $item->status, 'statuses' => Helper::statuses()])
        @if ($item->status == 3)
            <p class="error text-center">{{ trans('content.status_blocked') }}</p>
        @endif
    </div>
@endif