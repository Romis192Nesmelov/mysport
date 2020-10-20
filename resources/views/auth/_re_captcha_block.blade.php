<div class="form-group has-feedback has-feedback-left">
    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAPTCHA_KEY') }}"></div>
    @if ( $errors && $errors->has('g-recaptcha-response'))
        <div class="help-block error">{!! $errors->first('g-recaptcha-response') !!}</div>
    @endif
</div>