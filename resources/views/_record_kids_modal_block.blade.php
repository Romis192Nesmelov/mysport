@php ob_start(); @endphp
<form class="form-horizontal" action="{{ url('/'.$action) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $data['item']->id }}">
    <div class="modal-body">
        <h2 class="text-center">{{ $head }}</h2>
        @foreach (Auth::user()->kids as $kid)
            @php
                $recordFlag = false;
                foreach ($data['item']->records as $record) {
                    if ($record['kid_id'] == $kid->id) {
                        $recordFlag = true;
                        break;
                    }
                }
            @endphp

            @include('_checkbox_type1_block',[
                'name' => 'kid'.$kid->id,
                'label' => $kid->family.' '.$kid->name.' '.$kid->surname,
                'active' => $recordFlag
            ])
        @endforeach
    </div>
    <!-- Футер модального окна -->
    <div class="modal-footer">
        @include('_button_block', ['type' => 'submit', 'text' => trans('content.yes')])
        @include('_button_block', ['type' => 'button', 'text' => trans('content.no'), 'addAttr' => ['data-dismiss' => 'modal']])
    </div>
</form>
@include('layouts._modal_block',['id' => $id, 'content' => ob_get_clean()])