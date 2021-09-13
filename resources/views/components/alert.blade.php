@if($status != '' && $slot != '')
    <div class="alert alert-{{ $status }} alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{!! $slot !!}
@if($error != '')
    <i class="alert-danger"><b>{{ $error }}</b></i>
    @endif
    </div>
@endif
