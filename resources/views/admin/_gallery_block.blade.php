@include('_modal_delete_block',['modalId' => 'delete-gallery-modal', 'function' => url('admin/delete-gallery'), 'head' => trans('admin.do_you_want_to_delete_photo')])
<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.gallery'),'h' => 3])
    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/gallery') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="model" value="{{ substr($model->getTable(),0,-1) }}">
            <input type="hidden" name="id" value="{{ $model->id }}">
            @foreach($model->gallery as $gallery)
                @include('admin._gallery_container_block',['gallery' => $gallery])
            @endforeach
            @include('admin._gallery_container_block',['gallery' => null])
            <div class="col-md-12 col-sm-12 col-xs-12">
                @include('admin._save_button_block')
            </div>
        </form>
    </div>
</div>