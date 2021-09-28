<div class="{{$viewClass['form-group']}} {!! !$errors->has($column) ?: 'has-error' !!}">
    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        @include('admin::form.error')

        <script id="{{$id}}" name="{{$name}}" type="text/plain" {!! $attributes !!} ></script>
        @include('admin::form.help-block')

        <script type="text/html" class="{{$class}}_wrapper">{!! $value !!}</script>
    </div>
</div>
<script>
    window.UEDITOR_HOME_URL = '{{ $homeUrl }}'
</script>
