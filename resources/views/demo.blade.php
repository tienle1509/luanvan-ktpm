<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<input type="file" id="file1" name="file1"  multiple="multiple"/>
	<div id="output"><ul></ul></div>

	<script type="text/javascript">
		$("input#file1").change(function() {
    var ele = document.getElementById($(this).attr('id'));
    var result = ele.files;
    for(var x = 0;x< result.length;x++){
     var fle = result[x];
        $("#output ul").append("<li>" + fle.name + "(TYPE: " + fle.type + ", SIZE: " + fle.size + ")</li>");        
    }
    
});
	</script>

</body>
</html>