<ol class="breadcrumb m-0 custom_breadcrumb">
    @if(Route::current()->getName() !== 'backend.dashboard.index')
      @if(Route::has($base_route.'index'))
        <li class="breadcrumb-item"><a href="{{ route($base_route.'index') }}">{{isset($panel)?$panel:'Dashboard'}}</a></li>
      @endif
    @endif
    <li class="breadcrumb-item active">{{isset($page_title)? $page_title : 'Dashboard'}}</li>
</ol>
