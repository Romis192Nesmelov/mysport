<div class="col-md-4 col-sm-{{ $blindVer ? '12' : '4' }} col-xs-12">
    <div class="rounded-block gray left-block">{!! $content !!}</div>

    @if (isset($buttons) && $buttons && !Auth::guest())
        <div class="sub-buttons-block">
            @php
                $userRecordFlag = false;
                $kidRecordFlag = 0;
                foreach ($data['item']->records as $record) {
                    if ($record['user_id'] == Auth::id()) {
                        $userRecordFlag = true;
                        if (!count(Auth::user()->kids)) break;
                    }
                    if (count(Auth::user()->kids)) {
                        foreach (Auth::user()->kids as $kid) {
                            if ($record['kid_id'] == $kid->id) $kidRecordFlag++;
                        }
                    }
                }
            @endphp

            @if ($userRecordFlag)
                <div class="text-center">{{ trans('content.you_are_record') }}</div>
                <div class="button gray1"><a data-toggle="modal" data-target="#user-cancel-record">{{ trans('content.cancel_record_for_me') }}</a></div>
                @include('_record_user_modal_block',[
                    'id' => 'user-cancel-record',
                    'action' => $recordUserAction,
                    'head' => trans('content.confirm_delete_record')
                ])
            @else
                <div class="button gray1"><a data-toggle="modal" data-target="#user-to-record">{{ trans('menu.to_record') }}</a></div>
                @include('_record_user_modal_block',[
                    'id' => 'user-to-record',
                    'action' => $recordUserAction,
                    'head' => $recordUserMessage
                ])
            @endif

        @if (count(Auth::user()->kids))
                @if ($kidRecordFlag && $kidRecordFlag == count(Auth::user()->kids))
                    <div class="text-center">{{ $kidRecordFlag == 1 ? trans('content.your_kid_is_record') : trans('content.your_kids_are_record') }}</div>
                    <div class="button"><a data-toggle="modal" data-target="#kid-cancel-record">{{ trans('content.cancel_record_for_my_kids') }}</a></div>
                    @include('_record_kids_modal_block',[
                        'id' => 'kid-cancel-record',
                        'action' => $recordKidAction,
                        'head' => trans('content.confirm_delete_record')
                    ])
                @else
                    @if ($kidRecordFlag && $kidRecordFlag < count(Auth::user()->kids))
                        <div class="text-center">{{ $kidRecordFlag == 1 ? trans('content.your_kid_is_record') : trans('content.your_kids_are_record') }}</div>
                    @endif
                    <div class="button"><a data-toggle="modal" data-target="#kid-to-record">{{ trans('content.to_record_kid') }}</a></div>
                    @include('_record_kids_modal_block',[
                        'id' => 'kid-to-record',
                        'action' => $recordKidAction,
                        'head' => $recordKidMessage
                    ])
                @endif
            @endif
        </div>
    @elseif (isset($kidsMode) && $kidsMode)
        <div class="sub-buttons-block">
            <div class="button"><a href="{{ url('/profile/child') }}">{{ trans('content.add_kid_profile') }}</a></div>
        </div>
    @endif
</div>