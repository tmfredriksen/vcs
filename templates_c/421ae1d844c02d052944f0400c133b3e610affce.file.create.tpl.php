<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 19:26:49
         compiled from "views\Manualsource\create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3085556c95d9909928-67819126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '421ae1d844c02d052944f0400c133b3e610affce' => 
    array (
      0 => 'views\\Manualsource\\create.tpl',
      1 => 1432540988,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3085556c95d9909928-67819126',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c95da088e85_52776757',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c95da088e85_52776757')) {function content_556c95da088e85_52776757($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ('../shared/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
