<div class="avatar">
    @if (isset($deleteModal) && $deleteModal)
        <i class="delete-icon icon-close2" modal-data="{{ $deleteModal }}" del-data="{{ $delData }}"></i>
    @endif
    <img src="{{ asset($avatar ? $avatar : 'images/placeholder.jpg') }}">
</div>