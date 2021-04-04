@php ob_start(); @endphp
<form class="form-horizontal" action="{{ url('/admin/'.$action) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $data['item']->id }}">
    <div class="modal-body">
        <h3 class="text-center">{{ trans('admin.select_account') }}</h3>
        @include('admin._select_user_block',[
            'users' => $users,
            'selected' => null
        ])
    </div>
    <!-- Футер модального окна -->
    <div class="modal-footer">
        @include('_button_block', ['type' => 'submit', 'text' => trans('content.yes')])
        @include('_button_block', ['type' => 'button', 'text' => trans('content.no'), 'addAttr' => ['data-dismiss' => 'modal']])
    </div>
</form>
@include('layouts._modal_block',['id' => $id, 'content' => ob_get_clean()])