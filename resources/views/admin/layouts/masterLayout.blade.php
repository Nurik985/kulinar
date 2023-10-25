@isset($pageLayout["layout"])
    @if($pageLayout["layout"] === 'blank')
        @include('admin.layouts.loginLayout')
    @else
        @include('admin.layouts.authLayout')
    @endif
@endisset



