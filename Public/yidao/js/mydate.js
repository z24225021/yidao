
    $("[rel=tooltip]").tooltip();
    $(function() {
         $('.demo-cancel-click').click(function(){return false;});
    });
	function del()
	{
	    if(confirm("确定要删除吗？"))
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
	$(".form_datetime").datetimepicker({
		language:  'zh-CN', 
		format : "yyyy-mm-dd hh:ii",
		autoclose : true,
		todayBtn : true,
		startDate : "{:date('Y-m-d h:i')}",
		minuteStep : 10
	});
	function cert()
	{
	    if(confirm("确定要认证吗？"))
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
