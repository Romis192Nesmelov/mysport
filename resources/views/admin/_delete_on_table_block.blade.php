<td class="delete">
    @if (!isset($nodel) || !$nodel)
        <span del-data="{{ $id }}" modal-data="{{ $method }}" class="glyphicon glyphicon-remove-circle"></span>
    @endif
</td>