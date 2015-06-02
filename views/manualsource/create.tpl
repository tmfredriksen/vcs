{include file='../shared/navbar.tpl'}
<div class="container">
	<div class="page-header space">
		<ol class="breadcrumb">
			<li><a href="index">Manual Source</a></li>
			<li class="active">Create new</li>
		</ol>
      	<h1 style="align:center">Create new</h1>
   	</div>
</div>
<div class="container">
	<div hidden="true" id="alert" class="alert alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"
			aria-label="Close" >
			<span aria-hidden="true">&times;</span>
		</button>
	</div>	
	<div class="col-md-6">
	<h3><span class="label label-info">Filename</span> <span style="font-size:16px" id="filenameShow"></span></h3>
  		<input type="text" class="form-control" id="filename" required aria-describedby="sizing-addon1"></input>
     	<br>
		<h3><span class="label label-info">Comment</span></h3>
  		<textarea class="form-control" id="comment" rows=3 style="resize:none"aria-describedby="sizing-addon1"></textarea>
	  	<br>
	  	<h3><span class="label label-info">Path</span></h3>
	  	<input type="text" class="form-control" id="filepath"  aria-describedby="sizing-addon1"></input>
	  	<br>
	  	<h3><input type="button" class="btn btn-info customButton" id="saveFile" style="float:right; margin-bottom:20px;" value="Save file" /></h3>
  	</div>
  	<div class="col-md-6">
  		<h3><span class="label label-info">Content</span>
  		<input type="button" class="btn btn-info customButton" id="btnAddRow" value="Add line &raquo;" style="float:right" /></h3>
  		<div class=" panel panel-default">
	 		<div class="panel-body">
	 			<div id="fields"></div>
	  		</div>
  		</div>
  	</div>
	<!-- Bruker script for å generere nye felt-->
</div>
<script type="text/javascript">
$(document).ready(function(){
	createManualSource.addRow();
});
$('#btnAddRow').click(function(){
	createManualSource.addRow();
});
$("#saveFile").click(function(){	
	createFile("manualsource/createfile", 1) //Javscript found in shared.js
});
$("#filename").keyup(function() {
	var filename = $("#filename").val();
	if(filename != ''){
		$("#filenameShow").html(filename + ".conf");
	}
	else {
		$("#filenameShow").html("");
	}
});
$(".container").keydown(function (e){
	if (e.which == 116 || e.which == 17) {
	   if (confirm("Are you sure you want refresh the page? all data will be lost!") == true) {   
	   }
	   else {
		   return false;
	  }
   }
});
</script>
{include file='../shared/footer.tpl'}
