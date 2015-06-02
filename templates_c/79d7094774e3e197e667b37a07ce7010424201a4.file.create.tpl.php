<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 19:27:04
         compiled from "views\Alert\create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18370556c95e84d5f59-01198811%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79d7094774e3e197e667b37a07ce7010424201a4' => 
    array (
      0 => 'views\\Alert\\create.tpl',
      1 => 1432889938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18370556c95e84d5f59-01198811',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'inputIndex' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c95e855e471_67765302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c95e855e471_67765302')) {function content_556c95e855e471_67765302($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<div class="page-header space">
		<ol class="breadcrumb">
			<li><a href="index">Alert</a></li>
			<li class="active">Create new</li>
		</ol>
      	<h1 style="align:center">Create Alert</h1>
    	<h3><button class="btn btn-info" id="settings" style="float:right" type="submit">Settings</button></h3>		
      	
   	</div>
	<div hidden="true" id="alert" class="alert alert-success alert-dismissible"
		role="alert">
		<button type="button" class="close" data-dismiss="alert"
			aria-label="Close" >
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div id="inputboxes">
		<div class="col-xs-12 col-md-4 ">
			<h3><span class="label label-info">Filename</span> <span style="font-size:16px" id="filenameShow"></span></h3>
			<input placeholder="Filename" id="filename" class="form-control" type="text" required />
		</div>
		<div class="col-xs-6 col-md-4">
			<h3><span class="label label-info">Path</span></h3>
			<input placeholder="Path" id="filepath" class="form-control" type="text" required />
		</div>
		<div class="col-xs-6 col-md-4">
			<h3><span class="label label-info">Comment</span></h3>
			<input placeholder="Comment" id="comment" class="form-control" type="text" /> 
		</div>
		<div class="col-md-7">
		<h3><span class="label label-info">Content</span><input class="btn btn-info customButton" type="button" id="addBrackets" value="Add <alert>" style="float:right" /></h3>
			<div class="well">
				<div class="input-group" id=alertbrackets style="width:100%"></div>
			</div>
		</div>
		<div class="col-md-5">
			<h3><span class="label label-info">Preview file</span></h3>
			<textarea rows="20" style="resize:none" placeholder="File content" name="content" id="contentText" class="form-control"></textarea>
			<h3><button class="btn btn-info" id="createFile" style="float:right" type="submit">Save</button></h3>		
		</div>
		<div class="clearfix"></div>
		</br>
	</div>
</div>
<!-- Bruker script for å generere nye felt-->
<input type="hidden" id="inputIndex" <?php if ((isset($_smarty_tpl->tpl_vars['inputIndex']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['inputIndex']->value;?>
" <?php } else { ?> value="0" <?php }?> />

<?php echo '<script'; ?>
>

$(document).ready(function() {
	createAlert.ldapResults();
	createAlert.alertActions();
	createAlert.previewRootElement("");
})
$('#filename').keyup(function(){
	createAlert.previewRootElement(this);
	
	$(this).autocomplete({
		source: ldapCustomers
	});
});
$('#settings').click(function(){
	window.location = '/vcs/alert/settings';
});
$('#addBrackets').click(function(){
	createAlert.addBrackets();
});

$('#createFile').click(function(){
	
	var textinput = $("#contentText").val();

	var n = textinput.length;
	if(n > 65000){
		$("#alert").removeClass("alert-success");
		$("#alert").addClass("alert-danger");
		$("#alert").html(n + " character in content. Only 65000 characters allowed!");
        $("#alert").show();
        return true;
	}
	else {
		createFile("alert/createfile", 2) //Javscript found in shared.js

	}
	
	
});
$("#filename").keyup(function() {
	var filename = $("#filename").val();
	if(filename != ''){
		$("#filenameShow").html(filename + ".xml");
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
