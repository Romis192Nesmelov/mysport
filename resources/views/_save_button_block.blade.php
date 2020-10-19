@include('_save_block',['content' => view('_button_block',[
    'mainClass' => 'submit',
    'icon' => ' icon-floppy-disk',
    'type' => 'submit',
    'text' => trans('content.save')
])->render()])