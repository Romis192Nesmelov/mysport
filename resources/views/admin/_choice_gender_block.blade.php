<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('content.gender'),'h' => 5])
        <div class="panel-body">
            @include('_radio_button_block', [
                'name' => 'gender',
                'values' => [
                    ['val' => 1, 'descript' => trans('content.man_letter')],
                    ['val' => 2, 'descript' => trans('content.woman_letter')],
                ],
                'activeValue' => $user ? $user->gender : 1
            ])
        </div>
    </div>
</div>