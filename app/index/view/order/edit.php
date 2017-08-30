{extend name='public:base' /}
{block name="title"}{$title}{/block}
{block name="content"}
<style>
    .control-label{
        padding-right:10px;
    }
</style>

<!--弹出添加用户窗口--><form class="form-horizontal" action="{:url($act)}" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="id" value="{$row_->id}">
    <input type="hidden" name="referer" value="{$referer}">
    <div class="row" >
        <div class="col-xs-8">
            <div class="text-center">
                <!---->
                <h4 class="modal-title" id="gridSystemModalLabel">{$title}</h4>
            </div>
            <div class="">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="situation" class="col-xs-3 control-label">发货状态：</label>
                        <div class="col-xs-8">
                            <label class="control-label" >
                                <input type="radio" name="good_st" id="" value="1" <?php echo $row_->good_st=='待做'?'checked':''?>>待做</label> &nbsp;
                            <label class="control-label">
                                <input type="radio" name="good_st" id="" value="2" <?php echo $row_->good_st=='已接单'?'checked':''?>> 已接单</label>
                            <label class="control-label">
                                <input type="radio" name="good_st" id="" value="4" <?php echo $row_->good_st=='已送出'?'checked':''?>> 已送出</label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="javascript:history.back()">
                        <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">返回</button>
                    </a>
                    <button type="submit" class="btn btn-xs btn-green">保 存</button>
                </div>
            </div>
        </div>
</form>

<script>

    $(function () {
        $('form').bootstrapValidator({
            good_st: {
                validators: {
                    notEmpty: {
                        message: '不能为空'
                    }
                }
            }

        }
    });

    });

</script>

{/block}
