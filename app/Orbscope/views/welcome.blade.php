<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 col-sm-12">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>القائمة الجديدة</div>
                    <div class="tools">
                        {{$new->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach($new as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال : </strong>
                                                    {{@VarByLang(@$f->category->name,'ar')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال الفرعي : </strong>
                                                    @foreach(@$f->subcat as $sa)
                                                        <span style="margin-right: 5px;">{{@VarByLang($sa->name,'ar')}}</span>
                                                    @endforeach
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>القائمة الساخنه </div>
                    <div class="tools">
                        {{$hot->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach($hot as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال : </strong>
                                                    {{@VarByLang(@$f->category->name,'ar')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال الفرعي : </strong>
                                                    @foreach(@$f->subcat as $sa)
                                                        <span style="margin-right: 5px;">{{@VarByLang($sa->name,'ar')}}</span>
                                                    @endforeach
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>القائمة البارده </div>
                    <div class="tools">
                        {{$cold->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach($cold as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال : </strong>
                                                    {{@VarByLang(@$f->category->name,'ar')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال الفرعي : </strong>
                                                    @foreach(@$f->subcat as $sa)
                                                        <span style="margin-right: 5px;">{{@VarByLang($sa->name,'ar')}}</span>
                                                    @endforeach
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="portlet box grey-gallery">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>قائمة الارشيف </div>
                    <div class="tools">
                        {{$archive->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach($archive as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال : </strong>
                                                    {{@VarByLang(@$f->category->name,'ar')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>المجال الفرعي : </strong>
                                                    @foreach(@$f->subcat as $sa)
                                                        <span style="margin-right: 5px;">{{@VarByLang($sa->name,'ar')}}</span>
                                                    @endforeach
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

//sub
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 col-sm-12">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>القائمة الجديدة</div>
                    <div class="tools">
                        {{$sub->freelancers->where('status','new')->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach(@$sub->freelancers->where('status','new') as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>القائمة الساخنه </div>
                    <div class="tools">
                        {{$sub->freelancers->where('status','hot')->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach(@$sub->freelancers->where('status','hot') as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>القائمة البارده </div>
                    <div class="tools">
                        {{$sub->freelancers->where('status','cold')->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach(@$sub->freelancers->where('status','cold') as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="portlet box grey-gallery">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>قائمة الارشيف </div>
                    <div class="tools">
                        {{$sub->freelancers->where('status','archive')->count()}} مستقل
                    </div>
                    <div style="float: left;margin-top: 4px;margin-left: 10%" class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="ابحث...."> </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="panel-group accordion" id="accordion3">

                        @foreach($sub->freelancers->where('status','archive') as $f)

                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 15px;">

                                    <a style="font-size: medium;" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_{{$f->id}}" aria-expanded="false">{{$f->name}}


                                        <div class="free_info">
                                            <span class="free_tools"><i class="fa fa-thumbs-up"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-thumbs-down"></i> 0</span>
                                            <span class="free_tools"><i class="fa fa-comment"></i> 1</span>
                                            <span class="free_tools"><i class="fa fa-user"></i> {{$f->user_name}} </span>
                                            <span class="free_tools">الدولة: {{$f->country}} </span>
                                        </div>
                                    </a>


                                </div>
                                <div id="collapse_3_{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <strong>اسم المستخدم : </strong>
                                                    {{$f->user_name}}
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>وقت االاضافة : </strong>
                                                    {{$f->created_at->format('Y- m- d')}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>رابط معرض الاعمال : </strong>
                                                    {{$f->url_prtofolio}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>الموبيل : </strong>
                                                    {{$f->mobile}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>نبذة : </strong>
                                                    {{$f->desc}}
                                                    <hr>
                                                </div>
                                                @if(!empty($f->tags))
                                                    <div class="col-md-12">
                                                        <strong>علامات : </strong>
                                                        @foreach(@$f->tags as $t)

                                                            <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                                                            </a>
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <strong>واتس : </strong>
                                                    {{$f->whats_app}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>الايميل : </strong>
                                                    {{$f->email}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فيس بوك : </strong>
                                                    {{$f->facebook}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>فودافون كاش : </strong>
                                                    {{$f->vodafon_cache}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري (الاسم) : </strong>
                                                    {{$f->name_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>البريد المصري(رقم الهوية) : </strong>
                                                    {{$f->nationalnumber_posta}}
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>وسائل أخرى :</strong>
                                                    {{$f->others}}
                                                    <hr>
                                                </div>

                                                <div class="well margin-top-20">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-success"> الطلبات المستلمة : </span>
                                                            <h3>33</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-danger"> الطلبات الملفية : </span>
                                                            <h3>2</h3>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                                                            <span class="label label-warning"> الطالبات الجارية : </span>
                                                            <h3>3</h3>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title tabbable-line">

                                                        <div class="caption">
                                                            <i class="icon-bubbles font-dark hide"></i>
                                                            <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                                                        </div>
                                                        <ul class="nav nav-tabs">
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn font-yellow">
                                                                        <i class="fa fa-comment"></i> 1 </a>
                                                                    <a href="javascript:;" class="btn font-green">
                                                                        <i class="fa fa-thumbs-up"></i> 0 </a>
                                                                    <a href="javascript:;" class="btn font-red">
                                                                        <i class="fa fa-thumbs-down"></i> 0 </a>


                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="portlet_comments_1">
                                                                <!-- BEGIN: Comments -->
                                                                <div class="mt-comments">

                                                                    <div class="mt-comment">
                                                                        <div class="mt-comment-body">
                                                                            <div class="mt-comment-info">
                                                                                <span class="mt-comment-author">ابراهيم احمد </span>
                                                                                <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                                                            </div>
                                                                            <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                                                            <div class="mt-comment-details">
                                                                                <ul class="mt-comment-actions">
                                                                                    <a href="#">حذف</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- END: Comments -->
                                                                <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                                                                <form action="#">
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                                                        <div class="mt-stats">
                                                                            <div class="btn-group btn-group btn-group-justified">
                                                                                <a href="javascript:;" class="btn font-green">
                                                                                    <i class="fa fa-thumbs-up"></i>  </a>
                                                                                <a href="javascript:;" class="btn font-red">
                                                                                    <i class="fa fa-thumbs-down"></i>  </a>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

// add freelancer
<div class="col-md-12">

    <div class="portlet light bordered">
        <div class="portlet-title">

            <div class="caption">
                <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
            </div>

            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/freelancer')}}"
                   data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('freelancer')}}">
                    <i class="fa fa-list"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                   data-original-title="{{trans('orbscope.full-screen')}}"
                   title="{{trans('orbscope.full-screen')}}">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="col-md-12">

                {!! Form::open(['files'=>true,'route'=>'freelancer.store','class'=>'form-horizontal form-row-seperated']) !!}
                <div class="row">

                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('orbscope.category')}} <span class="required" aria-required="true"> * </span> </label>
                        <div class="col-md-10">

                            <select name="cat_id" id="cat_id" class="form-control select2 cat_id" data-placeholder="{{trans('orbscope.category')}}" required>
                                <option></option>
                                @foreach($cats as $cont)
                                    <option value="{{$cont->id}}" @if(old('cat_id') == $cont->id) selected @endif>{{VarByLang($cont->name,GetLanguage())}}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>
                    </br>


                    <div class="form-group city_data hidden"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">اسم المستخدم <span class="required" aria-required="true"> * </span></label>

                            <div class="col-md-9">
                                {!! Form::text('user_name',old('user_name'),['class'=>'form-control','id'=>'user_name','required']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">الاسم <span class="required" aria-required="true"> * </span></label>

                            <div class="col-md-9">
                                {!! Form::text('name',old('name'),['class'=>'form-control','id'=>'name','required']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">الدولة <span class="required" aria-required="true"> * </span></label>

                            <div class="col-md-9">
                                <select name="country" id="country" class="form-control select2" data-placeholder="{{trans('orbscope.country')}}" required>
                                    <option value=""></option>
                                    <option >مصر</option>
                                    <option >السعودية</option>
                                    <option >اليمن</option>
                                    <option >العراق</option>
                                    <option >لبنان</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">رابط معرض الاعمال   </label>

                            <div class="col-md-9">
                                {!! Form::url('url_prtofolio',old('url_prtofolio'),['class'=>'form-control','id'=>'url_prtofolio']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label" for="en_description">نبذة <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-10">
                            {!! Form::textarea('desc',old('desc'),['class'=>'form-control','id'=>'desc','required']) !!}
                            @if ($errors->has('en_description'))
                                <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('en_description') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label" for="en_description">tags <span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="{{old('tags')}}" name="tags" data-role="tagsinput">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">الهاتف<span class="required" aria-required="true"> * </span></label>

                            <div class="col-md-9">
                                {!! Form::text('mobile',old('mobile'),['class'=>'form-control','id'=>'mobile','required']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">الايميل </label>

                            <div class="col-md-9">
                                {!! Form::text('email',old('email'),['class'=>'form-control','id'=>'email']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('whats_app') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">الواتس</label>

                            <div class="col-md-9">
                                {!! Form::text('whats_app',old('whats_app'),['class'=>'form-control','id'=>'whats_app']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="ar_name">فيس بوك </label>

                            <div class="col-md-9">
                                {!! Form::text('facebook',old('facebook'),['class'=>'form-control','id'=>'facebook']) !!}
                                <i class="fa fa-spinner fa-spin loading hidden"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="mt-element-ribbon bg-grey-steel">
                        <div class="ribbon ribbon-left ribbon-color-default uppercase">بيانات الدفع للمستقل</div>
                        <div class="clear-fix"></div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('vodafon_cache') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label" for="ar_name">فودافون كاش</label>

                                    <div class="col-md-9">
                                        {!! Form::text('vodafon_cache',old('vodafon_cache'),['class'=>'form-control','id'=>'vodafon_cache']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ribbon ribbon-left ribbon-color-default uppercase">البريد المصري</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('name_posta') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label" for="ar_name">الاسم </label>

                                    <div class="col-md-9">
                                        {!! Form::text('name_posta',old('name_posta'),['class'=>'form-control','id'=>'name_posta']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('nationalnumber_posta') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label" for="nationalnumber_posta">الرقم القومي </label>

                                    <div class="col-md-9">
                                        {!! Form::text('nationalnumber_posta',old('nationalnumber_posta'),['class'=>'form-control','id'=>'nationalnumber_posta']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-3 control-label" for="en_description">وسائل أخرى (اذكرها مع ذكر بياناتها) </label>
                                <div class="col-md-9">
                                    {!! Form::textarea('others',old('others'),['class'=>'form-control','id'=>'others']) !!}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn blue">{{trans('orbscope.add')}} {{trans('orbscope.freelancer')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


// show info
<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <strong>اسم المستخدم : </strong>
                {{$f->user_name}}
                <hr>
            </div>

            <div class="col-md-6">
                <strong>وقت االاضافة : </strong>
                {{$f->created_at->format('Y- m- d')}}
                <hr>
            </div>
            <div class="col-md-6">
                <strong>المجال : </strong>
                {{@VarByLang(@$f->category->name,'ar')}}
                <hr>
            </div>
            <div class="col-md-6">
                <strong>المجال الفرعي : </strong>
                @foreach(@$f->subcat as $sa)
                    <span style="margin-right: 5px;">{{@VarByLang($sa->name,'ar')}}</span>
                @endforeach
                <hr>
            </div>
            <div class="col-md-6">
                <strong>رابط معرض الاعمال : </strong>
                {{$f->url_prtofolio}}
                <hr>
            </div>
            <div class="col-md-6">
                <strong>الموبيل : </strong>
                {{$f->mobile}}
                <hr>
            </div>
            <div class="col-md-12">
                <strong>نبذة : </strong>
                {{$f->desc}}
                <hr>
            </div>
            @if(!empty($f->tags))
                <div class="col-md-12">
                    <strong>علامات : </strong>
                    @foreach(@$f->tags as $t)

                        <a href="#" class="label label-sm label-success " style="margin-right: 10px;"> {{$t->name}}

                        </a>
                    @endforeach
                    <hr>
                </div>
            @endif

            <div class="col-md-4">
                <strong>واتس : </strong>
                {{$f->whats_app}}
                <hr>
            </div>
            <div class="col-md-4">
                <strong>الايميل : </strong>
                {{$f->email}}
                <hr>
            </div>
            <div class="col-md-4">
                <strong>فيس بوك : </strong>
                {{$f->facebook}}
                <hr>
            </div>
            <div class="col-md-4">
                <strong>فودافون كاش : </strong>
                {{$f->vodafon_cache}}
                <hr>
            </div>
            <div class="col-md-4">
                <strong>البريد المصري (الاسم) : </strong>
                {{$f->name_posta}}
                <hr>
            </div>
            <div class="col-md-4">
                <strong>البريد المصري(رقم الهوية) : </strong>
                {{$f->nationalnumber_posta}}
                <hr>
            </div>
            <div class="col-md-12">
                <strong>وسائل أخرى :</strong>
                {{$f->others}}
                <hr>
            </div>

            <div class="well margin-top-20">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                        <span class="label label-success"> الطلبات المستلمة : </span>
                        <h3>33</h3>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                        <span class="label label-danger"> الطلبات الملفية : </span>
                        <h3>2</h3>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                        <span class="label label-warning"> الطالبات الجارية : </span>
                        <h3>3</h3>
                    </div>
                </div>
            </div>




        </div>



    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">

                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">التعليقات</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <div class="mt-stats">
                            <div class="btn-group btn-group btn-group-justified">
                                <a href="javascript:;" class="btn font-yellow">
                                    <i class="fa fa-comment"></i> 1 </a>
                                <a href="javascript:;" class="btn font-green">
                                    <i class="fa fa-thumbs-up"></i> 0 </a>
                                <a href="javascript:;" class="btn font-red">
                                    <i class="fa fa-thumbs-down"></i> 0 </a>


                            </div>
                        </div>
                    </ul>

                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_comments_1">
                            <!-- BEGIN: Comments -->
                            <div class="mt-comments">

                                <div class="mt-comment">
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <span class="mt-comment-author">ابراهيم احمد </span>
                                            <span class="mt-comment-date"><i class="fa fa-thumbs-up"></i></span>
                                        </div>
                                        <div class="mt-comment-text">شخص ممتاز وصبور جدا </div>
                                        <div class="mt-comment-details">
                                            <ul class="mt-comment-actions">
                                                <a href="#">حذف</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- END: Comments -->
                            <h3 class="sbold blog-comments-title">اضف تقييم</h3>
                            <form action="#">
                                <div class="col-lg-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="ملاحظة" class="form-control c-square"> </div>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-sm-12">
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-green">
                                                <i class="fa fa-thumbs-up"></i>  </a>
                                            <a href="javascript:;" class="btn font-red">
                                                <i class="fa fa-thumbs-down"></i>  </a>


                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn blue uppercase btn-md sbold btn-block">اضافة</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>