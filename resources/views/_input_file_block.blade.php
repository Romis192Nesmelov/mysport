@php ob_start(); @endphp
<input {{ isset($inputId) ? 'id='.$inputId : '' }} type="file" name="{{ $name }}" class="file-styled">
@include('_input_cover_block',['content' => ob_get_clean()])