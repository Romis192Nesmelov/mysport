<div class="col-md-{{ isset($col) && $col ? $col : '12' }} col-sm-12 col-xs-12 {{ isset($addClass) && $addClass ? $addClass : '' }}">
    @foreach($data as $item)
        <label class="simple-radio">
            <input type="radio" name="{{ $name }}" class="styled" value="{{ $item['value'] }}" {{ isset($checked) && $checked == $item['value'] ? 'checked=checked' : '' }}>{!! $item['label'] !!}
        </label>
    @endforeach
</div>