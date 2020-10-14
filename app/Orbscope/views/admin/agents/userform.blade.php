<link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css" />
<link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<link href="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/css/multi-select{{GetLangAdds()}}.css" rel="stylesheet" type="text/css" />
<script src="{{url('orbscope/admin')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
 <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<style type="text/css" media="screen">
    summary:focus{
        outline: none;
    }
</style>
<br>
<div class="form-group">
<details class="alert alert-info" >
                    <summary style="cursor: pointer;">{{trans('orbscope.add')}}  {{trans('orbscope.to')}} - {{trans('orbscope.users')}}</summary>



    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label" for="email">{{trans('orbscope.email')}} <span class="required" aria-required="true"> * </span></label>

        <div class="col-md-10">
            {!! Form::email('email',old('email'),['class'=>'form-control','id'=>'email','placeholder'=>trans('orbscope.email')]) !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label" for="password">{{trans('orbscope.password')}} <span class="required" aria-required="true"> * </span></label>

        <div class="col-md-10">
            <input type="password" autocomplete="new-password"  name="password" id="e_password" class="form-control" placeholder="{{trans('orbscope.password')}}">
        </div>
    </div>



    <div class='form-group'>
        <label class="col-md-2 control-label">{{ trans('orbscope.assign_rolles') }} <span class="required" aria-required="true"> * </span></label>
        <div class="col-md-10">
            @foreach ($roles->chunk(4) as $roleCh)
                <div class="row">
                    @foreach ($roleCh as $role)
                        <div class="col-md-3">
                                                    <span style="margin-right: 3px">
                                                        {{ Form::checkbox('roles[]',  $role->id) }}
                                                        {{ Form::label($role->name, ucfirst($role->name)) }}
                                                    </span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>



</details></div>
@section('js')
    <script>
        $(document).ready(function() {
            $('#e_password').val('');
        });
    </script>

@endsection