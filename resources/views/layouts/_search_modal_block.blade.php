@php ob_start(); @endphp

<form method="get" action="{{ url('/search') }}">
    <div class="modal-body">
        <h2 class="text-center">{{ trans('menu.search') }}</h2>
        @include('_input_block',['name' => 'search', 'type' => 'text', 'max' => 50, 'placeholder' => trans('content.enter_search_string'), 'icon' => 'glyphicon glyphicon-search'])
        <button id="searching" class="button green" {{ Session::has('search') ? '' : 'disabled' }}>{{ trans('content.to_search') }}</button>
    </div>
</form>
@include('layouts._modal_block',['id' => 'search-modal', 'content' => ob_get_clean()])