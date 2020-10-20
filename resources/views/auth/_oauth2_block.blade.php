<div id="oauth-block">
    <h5 class="text-center">{{ trans('auth.auth2') }}</h5>
    <div class="soc-icons-container">
        {{--<a href="{{ url('fb-oauth') }}"><i class="fa fa-facebook"></i></a>--}}
        <div class="soc-icon"><a href="{{ url('vk-oauth') }}"><i class="fa fa-vk"></i></a></div>
        <div class="divider"></div>
        <div class="soc-icon"><a href="{{ Helper::googleHref() }}"><i class="fa fa-google"></i></a></div>
    </div>
</div>