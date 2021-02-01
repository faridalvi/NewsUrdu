<!-- JavaScript files-->
<script src="{{asset('backend/js')}}/jquery.min.js"></script>
<script src="{{asset('backend/js')}}/bootstrap.bundle.min.js"></script>
<script src="{{asset('backend/js')}}/grasp_mobile_progress_circle-1.0.0.min.js"></script>
<script src="{{asset('backend/js')}}/jquery.cookie.js"> </script>
<script src="{{asset('backend/js')}}/Chart.min.js"></script>
<script src="{{asset('backend/js')}}/jquery.validate.min.js"></script>
<script src="{{asset('backend/js')}}/jquery.mCustomScrollbar.concat.min.js"></script>
{{--<script src="{{asset('backend/js')}}/charts-home.js"></script>--}}
<!-- Main File-->
<script src="{{asset('backend/js')}}/front.js"></script>
<script src="{{asset('backend/js/ckeditor')}}/ckeditor.js"></script>
<script src="{{asset('backend/js/ckeditor/ckfinder')}}/ckfinder.js"></script>
<script src="{{asset('backend/js')}}/select2.js"></script>
<script src="{{asset('backend/js')}}/jquery.dataTables.min.js"></script>
<script src="{{asset('backend/js')}}/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend/js')}}/datepicker.js"></script>
<script>
    //Slug Creation
    var slug = function(str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[\u0660-\u0669A-Za-z0-9 ]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }
    $('#title').keyup(function() {
        var takedata = $(this).val()
        $('#slug').val(slug(takedata));
    });

    $(".alert").fadeTo(2000, 500).slideUp(1000, function(){
        $(".alert").slideUp(1000);
    });
    //Sidebar Menu Collapse others
    $('#side-main-menu li a').click(function (){
        if(this+'[aria-expanded = "true"]'){
            $(this).parents('li').siblings('li')
                .children('a').attr("aria-expanded","false")
                .siblings('ul').removeClass('show');
        }
    });

</script>
