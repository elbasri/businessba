@extends(AdminCore())
@section('content')

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/pages/create')}}" data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.pages')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/pages/'.$show->id.'/edit')}}"
                            data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.pages')}}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.pages')}}">

                            <a data-toggle="modal" data-target="#myModal{{$show->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                                <i class="fa fa-trash"></i>
                            </a>
                        </span>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/pages')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.pages')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.ar-name')}} : </strong>
                                    {{@VarByLang($show->name,'ar')}}
                                    <br><hr>
                                </div>
                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.en-name')}} : </strong>
                                    {{@VarByLang($show->name,'en')}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.en-description')}} : </strong>
                                    {{ @VarByLang($show->description, 'en')  }}
                                    <br><hr>
                                </div>
                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.ar-description')}} : </strong>
                                    {{ @VarByLang($show->description, 'ar')  }}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.status')}} : </strong>
                                    {{trans('orbscope.'.$show->status)}}
                                    <br><hr>
                                </div>

                                <div class="col-md-6">
                                    <strong>{{trans('orbscope.show_website')}} : </strong>
                                    {{trans('orbscope.'.$show->show_website)}}
                                    <br><hr>
                                </div>

                                <div class="col-md-12">
                                    <strong>{{trans('orbscope.en-details')}} : </strong>
                                    <textarea class="form-control" name="en_details" id="en_details" disabled>{{ @VarByLang($show->details, 'en')  }}</textarea>
                                    <br><hr>
                                </div>


                                <div class="col-md-12">
                                    <strong>{{trans('orbscope.ar-details')}} : </strong>
                                    <textarea class="form-control" name="ar_details" id="ar_details" disabled>{{ @VarByLang($show->details, 'ar')  }}</textarea>
                                    <br><hr>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal{{$show->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">{{trans('orbscope.delete')}} {{ VarByLang($show->name,GetLanguage()) }} !</h4>
                </div>
                <div class="modal-body">
                    {{trans('orbscope.ask-delete')}}  {{ VarByLang($show->name,GetLanguage()) }} !
                </div>
                <div class="modal-footer">
                    {!! Form::open([ 'method' => 'DELETE', 'route' => ['pages.destroy', $show->id] ]) !!}
                    {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                    <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.replace( 'ar_details', {
            toolbar : 'Basic',
            language: '{{GetLanguage()}}'
        });
        CKEDITOR.replace( 'en_details', {
            toolbar : 'Basic',
            language: '{{GetLanguage()}}'
        });
    </script>
@endsection
