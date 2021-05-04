<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.'.$objectName.'s')])
    <div class="panel-body">
        @if (count($objects))
            {{ csrf_field() }}
            @include('_modal_delete_block',['modalId' => 'delete-'.$objectName.'-modal', 'function' => url('admin/delete-'.$objectName), 'head' => trans('admin.do_you_want_to_delete_'.$objectName)])
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('content.image') }}</th>
                    <th class="text-center">{{ trans('content.name') }}</th>
                    <th class="text-center">{{ trans('content.description') }}</th>
                    <th class="text-center">{{ trans('auth.status') }}</th>
                    <th class="text-center">{{ trans('admin.edit') }}</th>
                    <th class="text-center">{{ trans('admin.del') }}</th>
                </tr>
                @foreach ($objects as $object)
                    <tr class="data" role="row" id="{{ $objectName.'_'.$object->id }}">
                        @include('admin._image_on_table_block',['image' => (isset($object->image) ? $object->image : $object->icon)])
                        <td class="text-left name">{{ $object['name_'.App::getLocale()] }}</td>
                        <td class="text-left">{!! $object['description_'.App::getLocale()] !!}</td>
                        <td class="text-center">
                            @include('admin._status_simple_block',[
                                'status' => $object->active,
                                'trueLabel' => trans('admin.'.$objectName.'_active'),
                                'falseLabel' => trans('admin.'.$objectName.'_not_active')
                            ])
                        </td>
                        @php
                            $editVariables = ['method' => $objectName.'s'];
                            if (isset($object->slug)) $editVariables['slug'] = $object->slug;
                            else $editVariables['id'] = $object->id;

                            $allowDelete = true;
                            foreach (['events','organizations','sections','places','allTrainers','allSections'] as $condition) {
                                if (isset($object[$condition]) && count($object[$condition])) {
                                    $allowDelete = false;
                                    break;
                                }
                            }
                        @endphp
                        @include('admin._edit_on_table_block',$editVariables)
                        <td class="delete">
                            @if ($allowDelete)
                                <span del-data="{{ $object->id }}" modal-data="delete-{{ $objectName }}-modal" class="glyphicon glyphicon-remove-circle"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h4 class="text-center">{{ trans('content.no_data') }}</h4>
        @endif
    </div>
    @if (!isset($withOutAdding) || !$withOutAdding)
        <div class="panel-body">
            @include('admin._add_button_block',['href' => $objectName.'s/add', 'text' => trans('admin.add_'.$objectName)])
        </div>
    @endif
</div>