<script src="{{url('orbscope/admin')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/respond.min.js"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="{{url('orbscope/admin')}}/jquery.quicksearch.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="{{url('orbscope/admin')}}/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

<script src="{{url('orbscope/admin')}}/assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>
{!! Html::script('orbscope/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.js') !!}
<script src="{{url('orbscope/admin')}}/magnific-popup/jquery.magnific-popup.min.js"></script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('.parent-popup').magnificPopup({
            delegate: '.img', // child items selector, by clicking on it popup will open
            type: 'image'
        });
    });

    function select_all() {
        $('input[class=selected_data]:checkbox').each(function(){
            if($('input[class=select-all]:checkbox:checked').length == 0){
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        });
    }

    $(document).on('click', 'button[type=reset]', function() {
        $('select').val("").trigger('change');
    });
</script>




<script src="{{url('orbscope/admin')}}/assets/jquery.quicksearch.min.js" type="text/javascript"></script>
@yield('js')