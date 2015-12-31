<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 12/31/15
 * Time: 8:23 PM
 */
?>
@extends("layouts.tablelayout")
@section("content")



<div class="row">
    <div class="col-lg-2 pull-right">
        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalTaskNew">Add New Task</button>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <div class="row">
        <div class="col-xs-12">
            <?php  ?>
            @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-success fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-check"></i>{{\Illuminate\Support\Facades\Session::get('message')}}
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('success_message'))
            <div class="alert alert-success fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-check"></i>{{\Illuminate\Support\Facades\Session::get('success_message')}}
            </div>
            @endif
            @if(Session::has('error_message'))
            <div class="alert alert-danger fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
            </div>
            @endif


            <div class="col-xs-12"> @if ( ! empty( $errors ) )
                @foreach ( $errors->all() as $error )
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-times"></i>{{$error}}

                </div>

                @endforeach
                @endif</div>
        </div>
    </div>
    <div class="box-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Priority</th>
                <th>Created</th>
                <th>Last Modified</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody id="tblCompany">
            <?php
            if($tasks){
                foreach($tasks as $task){
                    echo"
                        <tr>
                            <td>$task->id</td>
                            <td><a href='#'>$task->taskname</a></td>
                            <td>$task->priority</td>
                            <td>$task->created_at</td>
                            <td>$task->updated_at</td>
                            <td><button class='edtTaskLink btn-primary' cid='{$task->id}' cname='{$task->taskname}' cpriority='$task->priority'><span  class='glyphicon glyphicon-pencil'></span></button></td>
                            <td><button class='delLink btn-danger' dname='$task->name' url='/taskmanager/delete/$company->id'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></button></td>
                        </tr>
                        ";
                }
            }else{
                echo"<tr><td colspan='6'>No Record Found</td> </tr>";
            }
            ?>


            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Priority</th>
                <th>Created</th>
                <th>Last Modified</th>
                <th colspan="2">Action</th>
            </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->



<div class="modal fade" id="myModalTaskNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regTask" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Task</h4>
                </div>
                <div class="modal-body">
                    <form id="regCompany" method="post">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="taskname" id="taskname" placeholder="Task name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Select Task Priority</label>
                            <select class="form-control" name="priority" id="priority">
                                <option>--SELECT --</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Task</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalTaskEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edtFrmTask" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Task</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden"  name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="taskname" id="_taskname" placeholder="Task name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Select Task Priority</label>
                        <select class="form-control" name="priority" id="_priority">
                            <option>--SELECT --</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop