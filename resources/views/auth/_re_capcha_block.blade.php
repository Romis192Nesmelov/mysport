<div class="form-group has-feedback has-feedback-left">
    <div class="g-recaptcha" data-sitekey="6LfIM9IUAAAAAKuhUNXUBHYCsa4SwdCfmqVOIL8f"></div>
    @if ( $errors && $errors->has('g-recaptcha-response'))
        <div class="help-block error">{!! $errors->first('g-recaptcha-response') !!}</div>
    @endif
</div>