{extend name='public:base' /}
{block name="title"}管理员{/block}
{block name="content"}
<div role="tabpanel" class="tab-pane active" id="sour">
    <div class="check-div form-inline">
        <button class="btn btn-yellow btn-xs" data-toggle="modal" data-target="#addSource" id="add_btn">添加管理员</button>

    </div>
    <div class="data-div">
        <div class="row tableHeader">
            <div class="col-sm-1 ">
                编码
            </div>
            <div class=" col-sm-2 ">
                名称
            </div>
            <div class=" col-sm-3 ">
                创建时间
            </div>
            <div class=" col-sm-1 ">
                状态
            </div>
            <div class="col-sm-5 ">
                操作
            </div>
        </div>
        <div class="tablebody">
			<?php foreach($list_admin as $key=>$admin){?>
                <div class="row" >
                    <div class=" col-sm-1">
						<?= $admin['id']?>
                    </div>
                    <div id="topAD" class="col-sm-2" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSystem" aria-expanded="true" aria-controls="collapseOne">
                        <span><?= $admin['name']?></span>
                    </div>
                    <div class="col-sm-3">
						<?= $admin['create_time']?>
                    </div>
                    <div class="col-sm-1">
						<?= $admin['status']?>
                    </div>
                    <div class="col-sm-5">
                        <?php if(session('admin')->name == 'admin' ){?>
                        <button class="btn btn-success btn-xs update_" data-toggle="modal" data-target="#changeSource" data-id="<?= $admin['id']?>">修改</button>
                            <?php if($admin->id!=1){?>
                        <button class="btn btn-danger btn-xs del_" data-toggle="modal" data-target="#deleteSource" data-id="<?= $admin['id']?>"> 删除</button>
                                <?php }?>
                        <?php }?>
                    </div>
                </div>
			<?php }?>
        </div>
    </div>
</div>
<!-- add_admin -->
<div class="modal fade " id="addSource" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >添加管理员</h4>
            </div>
            <form class="form-horizontal" method="post" action="{:Url('admin/insert')}" id="form_a">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group ">
                        <label for="a_name" class="col-xs-3 control-label">帐号：</label>
                        <div class="col-xs-8 ">
                            <input type="text" name="name" class="form-control input-sm duiqi" id="a_name" placeholder="">
                            <span style="color:red;display:none;">帐号不能为空</span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="a_name" class="col-xs-3 control-label">密码：</label>
                        <div class="col-xs-8 ">
                            <input type="password" name="pass" class="form-control input-sm duiqi" id="a_pass" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sort" class="col-xs-3 control-label">确认密码：</label>
                        <div class="col-xs-8">
                            <input type="password" name="pass2" value="" class="form-control input-sm duiqi" id="a_pass2" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white" data-dismiss="modal">取 消</button>
                <button type="submit" class="btn btn-xs btn-xs btn-green">保 存</button>

            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div></div>
    <!-- update -->
    <div class="modal fade" id="changeSource" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >修改管理员</h4>
                </div>
                <form class="form-horizontal" action="{:url('admin/save')}" method="post" id="form_u" onsubmit="">
                    <input type="hidden" name="id" id="u_id" value="">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group ">
                                <label for="u_name" class="col-xs-3 control-label">帐号：</label>
                                <div class="col-xs-8 ">
                                    <input type="text" name="name" class="form-control input-sm duiqi" readonly id="u_name" placeholder="" style="color:inherit">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="a_name" class="col-xs-3 control-label">密码：</label>
                                <div class="col-xs-8 ">
                                    <input type="password" name="pass" class="form-control input-sm duiqi" id="u_pass" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-xs-3 control-label">确认密码：</label>
                                <div class="col-xs-8">
                                    <input type="password" name="pass2" value="" class="form-control input-sm duiqi" id="u_pass2" placeholder="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                        <button type="submit" class="btn btn-xs btn-green">保 存</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!--弹出删除资源警告窗口-->
    <div class="modal fade" id="deleteSource" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >提示</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        确定要删除该资源？删除后不可恢复！
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{:Url('admin/del')}">
                        <input type="hidden" name="id" value="" id="del_id" />
                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
                        <button type="submit" class="btn btn-xs btn-danger">确 定</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<script>
    $(function () {
        $('#form_a,#form_u').bootstrapValidator({
            fields: {
                name: {
                    validators:
                    {
                        notEmpty: {
                             message: '用户名不能为空'
                        },
                        stringLength: {
                                min: 3,
                                max: 20,
                                message: '用户名长度必须在3到20位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                                message: '用户名只能包含大写、小写、数字和下划线'
                        }
                    }

                },
                pass: {
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        },
                        stringLength: {
                            min: 6,
                            max: 32,
                            message: '密码长度为6－32位'
                        },

                    }
                },
                pass2: {
                    validators: {
                        notEmpty: {
                            message: '确认密码不能为空'
                        },
                        identical: {
                            field: 'pass',
                            message: '两次密码不一致'
                        }
                    }
                }
            }
        });

    });
    $('.update_').bind('click',function () {
        var id = $(this).attr('data-id');
        $.post('<?php echo url('admin/update')?>',{id:id},function(data){
            if(data.code!=0){
                alert(data.msg);
            }else{
//                alert(data.row.name)
                $('#form_u').find('#u_name').val(data.row.name);
                $('#form_u').find('#u_id').val(data.row.id);


            }
        });
    });
    //delete
    $('.del_').bind('click',function () {
        var id = $(this).attr('data-id');
        $('#del_id').val(id);
    });

</script>
{/block}
