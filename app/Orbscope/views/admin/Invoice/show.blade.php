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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/Invoice/create')}}" data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.invoice')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/Invoice/'.$show->id.'/edit')}}" data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.invoice')}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/Invoice')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.invoice')}}"><i class="fa fa-list"></i></a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="tabbable-line">

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row static-info">
                                    <div class="col-md-12">

                                        @if ($show->files != null)
                                            <div class="col-md-12">
                                                <div class="col-md-2"><strong>{{trans('orbscope.files')}} : </strong></div>
                                                <div class="col-md-10">
                                                    <div class="carousel-inner" role="listbox">
                                                        @foreach(explode('|', $show->files) as $key => $image)
                                                            {{getTypeFile(getEx($image))['fileType']}}
                                                            <strong>
                                                                {{trans('orbscope.file')}} : <i class="fa {{getTypeFile(getEx($image))['fileIcon']}}" aria-hidden="true"></i>  {{$image}}
                                                            </strong>
                                                            @if (getTypeFile(getEx($image))['fileType'] == 'Adobe Acrobat')
                                                                <a href="{{ url(AdminUrl('download_Invoice/'.$image))}}" style="margin: 3px;" target="_blank" class="btn btn-large blue pull-right">
                                                                    <i class="fa fa-download"></i> {{trans('orbscope.download')}}
                                                                </a>
                                                            @else
                                                                <a href="{{url(AdminUrl('download_Invoice/'.$image))}}" style="margin: 3px;" target="_blank" class="btn btn-large blue pull-right">
                                                                    <i class="fa fa-download"></i> {{trans('orbscope.download')}}
                                                                </a>
                                                            @endif
                                                            <a href="{{url('uploads/'.$image)}}" target="_blank" style="margin: 3px;" class="btn btn-large pull-right">
                                                                <i class="fa fa-eye"></i> {{trans('orbscope.view')}}
                                                            </a>
                                                            <hr>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        <div class="clearfix"></div>
                                           <form action="{{url('admin/add_files/invoices/'.$show->id)}}" method="post" enctype="multipart/form-data">
                                               {{ csrf_field() }}


                                          <br/>
                                               <div class="form-group" id="upload">
                                                   <label class="col-md-2 control-label" for="pdf">{{trans('orbscope.files')}} </label>
                                                   <div class="col-md-10">
                                                       @php
                                                           if($show->files != ''){
                                                               $pdfs = explode('|',$show->files);
                                                           }else{
                                                               $pdfs = null;
                                                           }
                                                       @endphp
                                                       <input type="file" multiple name="pdfs[]" class="form-control" >
                                                       <div style="margin-bottom: 20px">
                                                           @if($pdfs != null)
                                                               <div class="parent-popup row">
                                                                   @foreach($pdfs as $im)
                                                                       <div class="col-md-6" style="height:100px;">
                                                                           @if(checklist($im) == true )
                                                                               <span style="position:relative">
                                                                    <span class="btn-sm removeImage" style="color: red"><i class="fa fa-trash-o" style="position: absolute; top: 27px; z-index: 1000; left: 10px; color: #d20000; font-size: 15px; cursor: pointer;"></i></span>
                                                                    <a class="img" href="{{url('uploads/'.$im)}}">
                                                                        <img class="img-responsive img-rounded special-image" style="height: 96px; width:50%" src="{{url('uploads/'.$im)}}">
                                                                    </a>
                                                                </span>
                                                                           @else
                                                                               <span style="position:relative">
                                                                    <span class="btn-sm removeImage" style="color: red"><i class="fa fa-trash-o" style="color: #d20000; font-size: 15px; cursor: pointer;"></i></span>
                                                                    <strong>{{trans('orbscope.file')}} : <i class="fa {{getTypeFile(getEx($im))['fileIcon']}}  extraClass" style="margin: 25px" aria-hidden="true"></i>  {{$im}}</strong>
                                                                </span>
                                                                               <br><hr>
                                                                           @endif
                                                                           <input type="hidden" name="oldpdf[]" value="{{$im}}">
                                                                       </div>
                                                                   @endforeach
                                                               </div>
                                                           @endif
                                                       </div>
                                                   </div>
                                               </div>
                                          <br/>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn blue">{{trans('orbscope.add')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click','.removeImage', function () {
            $(this).parent().parent().remove();
        });
    </script>
@endsection
