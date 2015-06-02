<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 19:37:13
         compiled from "views\Alert\recentlychanged.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10898556c9849e23077-64113579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '670f63f07d7e1bc1222ea17e6e2ebacc7b55240a' => 
    array (
      0 => 'views\\Alert\\recentlychanged.tpl',
      1 => 1432729234,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10898556c9849e23077-64113579',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'viewmodel' => 0,
    'i' => 0,
    'array' => 0,
    'file' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c9849f33954_66504828',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c9849f33954_66504828')) {function content_556c9849f33954_66504828($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<div class="page-header space">
		<ol class="breadcrumb">
			<li><a href="index">Alert</a></li>
			<li class="active">Recently changed</li>
		</ol> 
      	<h1 style="align:center">Recently changed</h1>   
	</div>	
	<?php  $_smarty_tpl->tpl_vars['array'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['array']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['viewmodel']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['array']->key => $_smarty_tpl->tpl_vars['array']->value) {
$_smarty_tpl->tpl_vars['array']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['array']->key;
?>
		<div class="panel panel-default well col-md-4">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b><?php if ($_smarty_tpl->tpl_vars['i']->value==0) {?>Manual Source<?php } elseif ($_smarty_tpl->tpl_vars['i']->value==1) {?>Alert<?php } else { ?>Swatch <?php }?></b></h3>
		  </div>
			<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['array']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
				<?php if ((($_smarty_tpl->tpl_vars['file']->value->getLocked())!=null)) {?>
			<div class="panel panel-default" style="color:RED">
		  		<div class="panel-body">
		  			<div><i>Filename: </i> <?php echo $_smarty_tpl->tpl_vars['file']->value->getFilename();?>
</div>
		  			<div><i>date: </i><?php echo $_smarty_tpl->tpl_vars['file']->value->getTime();?>
</div> 
		  			<div><i>User: </i> <?php echo $_smarty_tpl->tpl_vars['file']->value->getUser();?>
</div>
		  		</div>
		  	</div>
			<?php } else { ?>
				<div class="panel panel-default">
		  		<div class="panel-body">
		  			<div><i>Filename: </i> <?php echo $_smarty_tpl->tpl_vars['file']->value->getFilename();?>
 
		  			<button class="btn btn-default btnEditfile" value='<?php echo $_smarty_tpl->tpl_vars['file']->value->getID();?>
' data-toggle="modal" data-target="#myModal" style="float:right"><h5>Edit</h5></button></div>
		  			<div><i>date: </i><?php echo $_smarty_tpl->tpl_vars['file']->value->getTime();?>
</div> 
		  			<div><i>User: </i> <?php echo $_smarty_tpl->tpl_vars['file']->value->getUser();?>
</div>
		  		</div>
		  	</div>
		  	<?php }?>
		  	<?php } ?>
		</div>
	<?php } ?>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
//Fills the popup-modal with data

	$(document).ready(function() {
		$(".btnEditfile").click(function() {			
			index.fillModalRecentlyChanged($(this).attr("value"));
			
			//Timer for editing (concurrancy control). 
			//User have 15 minutes of time for editing a file or user will be thrown out.
			//After 13 minutes user get a message about 2 minutes left
			setTimeout(function(){
				alert("You have 2 minutes left");
			}, 780000); //13 minutes, message about 2 minutes left
			setTimeout(function() {
				$('#myModal').modal('hide');
				var id = $("#fID").val();
				var et = this;
				unlock(id);
				alert("Time has run out");
			}, 900000); //15 minutes of time for editing before you get kicked
		});
		//sends the modified data to database and saves this as a new file. 
		$("#btnsaveEdit").click(function(){		
			var type = $("#filetype").val();
			switch(type) {
			case "1":
				edit.editFile("manualsource/editFile", 1); 
				break;
			case "2":
				edit.editFile("alert/editFile", 2); 
				break;
			case "3":
				edit.editFile("swatch/editFile", 3); 
				break;
			}
		});
	});
	
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ('../shared/modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../shared/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
