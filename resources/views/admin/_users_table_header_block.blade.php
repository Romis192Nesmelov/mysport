<tr>
    <th class="text-center">{{ trans('auth.avatar') }}</th>
    <th class="text-center">{{ trans('admin.'.$objectName) }}</th>
    <th class="text-center">{{ isset($parent) && $parent ? trans('admin.parent') : trans('admin.user_type') }}</th>
    <th class="text-center">{{ trans('auth.status') }}</th>
    <th class="text-center">{{ trans('admin.edit') }}</th>
    <th class="text-center">{{ !isset($nodel) || !$nodel ? trans('admin.del') : '' }}</th>
</tr>