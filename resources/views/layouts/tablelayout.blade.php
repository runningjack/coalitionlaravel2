<!DOCTYPE html>
<html>
<head>
    @include("includes.head")
    <link rel="stylesheet" href="{{url()}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{url()}}/plugins/daterangepicker/daterangepicker-bs3.css">
</head>
<body>
<div class="wrapper">
@include("includes.header")
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$title}}
        <small>Listing</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url()}}"><i class="fa fa-dashboard"></i> Home</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
@yield("content")
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.0
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="javascript:void(0)">Robert Johnson Holdings</a>.</strong> All rights reserved.
</footer>

<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->



<div class="modal" id="myProcess">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div id="transProcess" style=' width:317px; margin:10px auto' ><img src='<?= url();?>/dist/img/bigLoader.gif'  ><h4>Processing Request... Please Wait!</h4></div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal" id="myDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Data Delete Console</h4>
            </div>
            <div class="modal-body delInfo">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href=""  class="del btn btn-primary" >Delete</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<script src="{{url()}}/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{url()}}/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{url()}}/plugins/iCheck/icheck.min.js"></script>
<script src="{{url()}}/plugins/jQueryUI/jquery-ui.min.js"></script>

<script src="{{url()}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url()}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{url()}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="{{url()}}/dist/js/app.min.js"></script>
<script src="{{url()}}/dist/js/jquery.validate.min.js"></script>
<script src="{{url()}}/dist/js/jquery.form.min.js"></script>

<script>


    $(function () {
        var l,p;
        var d=$(".myDelete");l=$("a.del");p=$("#myProcess")

        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('#reservation').datepicker(
            {
                dateFormat: 'yy-mm-dd',
                changeMonth: true
            }
        ).datepicker("setDate", new Date());

        $('#date_from').datepicker(
            {
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                onClose: function( selectedDate ) {
                    $( "#date_to" ).datepicker( "option", "minDate", selectedDate );
                }
            }
        );


        $('#date_to').datepicker(
            {
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                onClose: function( selectedDate ) {
                    $( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
                }
            }
        );

        var id
        var validator = $('#regTask').validate({
            rules: {
                taskname: {
                    required: true
                },
                priority: {
                    required: true
                }
            }, highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },submitHandler: function(form) {
                $("#myModalTaskNew").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '',type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });



        var validator = $('#edtFrmPaper').validate({
            rules: {name: {required: true},size: {required: true}
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },submitHandler: function(form) {
                $("#myModalPaperEdit").modal("hide");//$("tbody#tblCompany").html(data);
                $("#myProcess").modal("show")
                $.ajax({url: '{{url()}}/settings/paperedit/'+id,type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });








        $(".edtTaskLink").each(function(){
            var e = $(this)
            $(this).click(function(){
                var cid,cdescription,cname,clevel,cid = e.attr('cid');id = cid
                $("#id").val(e.attr('cid')); $("#_taskname").val(e.attr('cname'));$("#_priority").val(e.attr('cpriority'));
                $('#myModalTaskEdit').modal("show")

            })
        })

        $(".changestackstatus").each(function(){
            var e = $(this)

            alert("All Good")
            e.on("change",function(){
                alert("All Good")
                var status = $(this).val()
                var e, u, n, s;
                u="{{url()}}"+ e.attr("url");
                p.modal("show")
                $.ajax({url: u,type: 'post',data: {_token: $('meta[name="csrf_token"]').attr('content'),mstatus:status},dataType: 'html',
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000)}});

            })
        })





        $(".delLink").each(function(){
            var e, u, n, s;
            e = $(this),u= e.attr("url"),n= e.attr("dname");s="You are about to delete <b>"+n+"</b> from the record base! <br> Click Delete to procees!";e.click(function(){$("#myDelete div.delInfo").html(s);l.attr("href","{{url()}}"+u);d.modal("show");})
        })

        var validator = $('#edtFrmTask').validate({
            rules: {_taskname:{required: true},priority: {required: true}
            }, highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },submitHandler: function(form) {
                $("#myModalTaskEdit").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '<?php echo url() ?>/tasmanager/edit/'+id,type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });
//module to delete any type of record via ajax
        l.on("click",function(){
            var u = $(this).attr("href");
            $("#myDelete").modal("hide")
            p.modal("show")
            $.ajax({url: u,type: 'post',data: {_token: $('meta[name="csrf_token"]').attr('content')},dataType: 'html',
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000)}});
            return false
        })

    });
</script>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
</body>
</html>