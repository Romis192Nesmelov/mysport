<div class="avatar">
    @if (isset($deleteModal) && $deleteModal)
        <i class="delete-icon icon-close2" modal-data="{{ $deleteModal }}" del-data="{{ $delData }}"></i>
    @endif
    @if ($avatar && isset($usePreview) && $usePreview)
        <a class="img-preview" href="{{ asset($avatar) }}"><img src="{{ asset($avatar) }}"></a>
    @elseif ($avatar)
        <img src="{{ asset($avatar) }}">
    @else
        <img class="placeholder" src="{{ asset('images/placeholder.jpg') }}">
    @endif
</div>