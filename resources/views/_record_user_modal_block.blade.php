@php ob_start(); @endphp
<form class="form-horizontal" action="{{ url('/'.$action) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $data['item']->id }}">
    <div class="modal-body"><h2 class="text-center">{{ $head }}</h2></div>
    <!-- Футер модального окна -->
    <div class="modal-footer">
        @include('_button_block', ['type' => 'submit', 'text' => trans('content.yes')])
        @include('_button_block', ['type' => 'button', 'text' => trans('content.no'), 'addAttr' => ['data-dismiss' => 'modal']])
    </div>
</form>
@include('layouts._modal_block',['id' => $id, 'content' => ob_get_clean()])