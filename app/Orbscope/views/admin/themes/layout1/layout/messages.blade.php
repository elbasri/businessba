@if (count($errors) > 0)
    <div class="alert alert-danger" dir="{{GetDirection()}}">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif






<script>
    @if(session()->has('success'))
swal({
        title                  : "{{trans('orbscope.success')}}",
        text                   : "{{session()->get('success') }}",
        type                   : "success",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-success",
        cancelButtonClass      : "btn-success",
        closeOnCancel          : true,
        confirmButtonText      : "{{trans('orbscope.close')}}",
        cancelButtonText       : "{{trans('orbscope.close')}}",
        timer                  : "3000"
    });
    @endif
    @if(session()->has('info'))
swal({
        title                  : "{{trans('orbscope.info')}}",
        text                   : "{{session()->get('info') }}",
        type                   : "info",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-info",
        cancelButtonClass      : "btn-info",
        closeOnCancel          : true,
        confirmButtonText      : "{{trans('orbscope.close')}}",
        cancelButtonText       : "{{trans('orbscope.close')}}",
        timer                  : "3000"
    });
    @endif
    @if(session()->has('warning'))
swal({
        title                  : "{{trans('orbscope.warning')}}",
        text                   : "{{session()->get('warning') }}",
        type                   : "warning",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-warning",
        cancelButtonClass      : "btn-warning",
        closeOnCancel          : true,
        confirmButtonText      : "{{trans('orbscope.close')}}",
        cancelButtonText       : "{{trans('orbscope.close')}}",
        timer                  : "3000"
    });
    @endif
    @if(session()->has('error'))
swal({
        title                  : "{{trans('orbscope.error')}}",
        text                   : "{{session()->get('error') }}",
        type                   : "error",
        customClass            : "sweet-alert showSweetAlert",
        confirmButtonClass     : "btn-danger",
        cancelButtonClass      : "btn-danger",
        closeOnCancel          : true,
        confirmButtonText      : "{{trans('orbscope.close')}}",
        cancelButtonText       : "{{trans('orbscope.close')}}",
        timer                  : "3000"
    });
    @endif

</script>