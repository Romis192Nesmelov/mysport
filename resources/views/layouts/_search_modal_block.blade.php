@php ob_start(); @endphp
<div class="modal-body">
    <h2 class="text-center">{{ trans('menu.search') }}</h2>
{{--    <button class="button green">{{ trans('content.enter') }}</button>--}}
</div>
@include('layouts._modal_block',['id' => 'search-modal', 'content' => ob_get_clean()])