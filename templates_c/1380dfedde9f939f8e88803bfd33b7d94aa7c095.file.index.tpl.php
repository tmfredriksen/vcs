<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 10:27:15
         compiled from "views\Swatch\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28626556c1763d73030-29589876%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1380dfedde9f939f8e88803bfd33b7d94aa7c095' => 
    array (
      0 => 'views\\Swatch\\index.tpl',
      1 => 1432890082,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28626556c1763d73030-29589876',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'viewmodel' => 0,
    'fileCollection' => 0,
    'key' => 0,
    'file' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c1763eed856_61340278',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c1763eed856_61340278')) {function content_556c1763eed856_61340278($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="container">	
   	<div class="col-md-12 indexGroups">
   		<ol class="breadcrumb">
			<li class="active">Swatch</li>
			<li></li>
		</ol>
		<div class="page-header space">
	      	<h1 style="align:center">Swatch</h1>
	   	</div>
		<div hidden="true" id="alert"
			class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="panel panel-default panel-hover well col-md-3 " id="createPanel" align="center">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Create new</b></h3>
		  </div>
		</div>
		<div class="panel panel-default panel-hover well col-md-3" id="historyPanel" align="center">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>File history</b></h3>
		  </div>
		</div>
		<div class="panel panel-default panel-hover well col-md-3" id="deletedPanel" align="center">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Restore deleted</b></h3>
		  </div>
		</div>
		<div class="panel panel-default panel-hover well col-md-3" id="recentlyChangedPanel" align="center">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Recently changed</b></h3>
		  </div>
		</div>
		<div class="col-md-3" style="padding-left:0px; padding-right:0px;">
			<input class="form-control" id="search" placeholder="Search" />
			<br />
		</div>
	</div>
   	<div hidden="true" id="alert" class="alert alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"
			aria-label="Close" >
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<br />	
	<table class="table table-bordered table-hover scrollable" id="contentTable">
      <thead>
	      <tr>
	      	<th width="2%">#</th>
		    <th>FileID</th>
			<th>Filename</th>
			<th>Comment</th>
			<th>Path</th>
			<th>Time</th>
			<th>Version</th>
			<th>User</th>
		</tr>
  	</thead>
	<?php  $_smarty_tpl->tpl_vars['fileCollection'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fileCollection']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['viewmodel']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fileCollection']->key => $_smarty_tpl->tpl_vars['fileCollection']->value) {
$_smarty_tpl->tpl_vars['fileCollection']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['fileCollection']->key;
?>
		<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fileCollection']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['file']->key;
?>
			<?php if ($_smarty_tpl->tpl_vars['key']->value==0) {?>
				<?php if ($_smarty_tpl->tpl_vars['file']->value->getLocked()!=null) {?>
				<tbody style="color:RED">
					<tr id="activeFile">
						<td><div class='glyphicon glyphicon-plus accordion-toggle' data-toggle="collapse" data-target=".childfile<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"> </div>
					    <td class="fileID"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFileID();?>
</td>
					    <td class="filename"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFilename();?>
</td>				    
						<td class="comment"><?php echo $_smarty_tpl->tpl_vars['file']->value->getComment();?>
</td>
						<td class="path"><?php echo $_smarty_tpl->tpl_vars['file']->value->getPath();?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['file']->value->getTime();?>
</td>
						<td class="version"><?php echo $_smarty_tpl->tpl_vars['file']->value->getVersion();?>
</td>
						<td class="user"><?php echo $_smarty_tpl->tpl_vars['file']->value->getUser();?>
</td> 
						<td class="eID" style="display:none"><?php echo $_smarty_tpl->tpl_vars['file']->value->getID();?>
</td>		
						<td>
							<div class="btn-group">
							  <a class="btn dropdown-toggle" data-toggle="dropdown">
							    Options
							    <span class="caret"></span>
							  </a>
							  <ul class="dropdown-menu pull-right buttonGroup">
								  <h3>
								   <button type="button" class="btn btn-info btnView" data-toggle="modal" data-target="#myModalview">View</button>
								  </h3>				 
							  </ul>
							</div>
						</td>
					</tr>
			  	</tbody>
			  	<?php } else { ?>
			  	<tbody>
					<tr id="activeFile">
						<td><div class='glyphicon glyphicon-plus accordion-toggle' data-toggle="collapse" data-target=".childfile<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"> </div>
					    <td class="fileID"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFileID();?>
</td>
					    <td class="filename"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFilename();?>
</td>				    
						<td class="comment"><?php echo $_smarty_tpl->tpl_vars['file']->value->getComment();?>
</td>
						<td class="path"><?php echo $_smarty_tpl->tpl_vars['file']->value->getPath();?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['file']->value->getTime();?>
</td>
						<td class="version"><?php echo $_smarty_tpl->tpl_vars['file']->value->getVersion();?>
</td>
						<td class="user"><?php echo $_smarty_tpl->tpl_vars['file']->value->getUser();?>
</td> 
						<td class="eID" style="display:none"><?php echo $_smarty_tpl->tpl_vars['file']->value->getID();?>
</td>		
						<td>
							<div class="btn-group">
							  <a class="btn dropdown-toggle" data-toggle="dropdown">
							    Options
							    <span class="caret"></span>
							  </a>
							  <ul class="dropdown-menu pull-right buttonGroup">
								  <h3>
								  	<input type="submit" class="btn btn-info btnEdit" value="Edit" data-toggle="modal" data-target="#myModal" />
								  	<input type="submit" class="btn btn-danger btnDelete" value="Delete"/>
								   <button type="button" class="btn btn-info btnView" data-toggle="modal" data-target="#myModalview">View</button>
								   <input type="submit" class="btn btn-danger btncreatenew" value="Create new based on"/>

								  </h3>				 
							  </ul>
							</div>
						</td>
					</tr>
			  	</tbody>
			  	<?php }?>
			<?php } else { ?>
				<?php if ($_smarty_tpl->tpl_vars['file']->value->getLocked()!=null) {?>
				<?php } else { ?>
				<tbody>
					<tr class="childfile<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
 hiddenRow accordian-body success collapse">
						<td><div ></div>
						<td class="eID" style="display:none"><?php echo $_smarty_tpl->tpl_vars['file']->value->getID();?>
</td>	
						<td class="fileid"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFileID();?>
</td>
						<td class="filename"><i><?php echo $_smarty_tpl->tpl_vars['file']->value->getFilename();?>
</i></td>				    
						<td class="comment"><i><?php echo $_smarty_tpl->tpl_vars['file']->value->getComment();?>
</i></td>
						<td class="path"><i><?php echo $_smarty_tpl->tpl_vars['file']->value->getPath();?>
</i></td>
						<td><i><?php echo $_smarty_tpl->tpl_vars['file']->value->getTime();?>
</i></td>
						<td class="version"><i><?php echo $_smarty_tpl->tpl_vars['file']->value->getVersion();?>
</i></td>
						<td class="user"><i><?php echo $_smarty_tpl->tpl_vars['file']->value->getUser();?>
</i></td> 
						<td><input type="submit" class="btn btn-info btnRestore" value="Restore"/><button type="button" class="btn btn-info btnView" data-toggle="modal" data-target="#myModalview">View</button></td>
					</tr>
				</tbody>
				<?php }?>
			  <?php }?>
		  <?php } ?>
	  <?php } ?>
    </table>
	

</div>

<?php echo '<script'; ?>
 type="text/javascript" src="/vcs/js/jquery-1.11.2.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">



$('#createPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/swatch/create';
});
$('#recentlyChangedPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/swatch/recentlychanged';
});
$('#historyPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/swatch/filehistory';
});
$('#deletedPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/swatch/restoredeleted';
});


$('#FilterLdapItems').keyup(function(){
	var dropdown = document.getElementById("LdapItems");
	var items = $('#LdapItems option');
	
	var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	
	items.show().filter(function(){
		var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		return !~text.indexOf(val);
	}).hide();
	
	if($(this).val() != ""){
		dropdown.style.display = "block";
		dropdown.setAttribute('size', 5);
	}
	else
		dropdown.style.display = "none";
})

//Deletes the selected file, sends it to the "deleted" table.
$(".btnDelete").click(function(){
	edit.deleteFile("swatch/deleteFile", this);
});
//Restores a earlier version of a file
$(".btnRestore").click(function(){
	restoreDeleted.restoreSingleFile("swatch/restoreSingleFile", this);
});

//Script that triggers when edit-button in table is clicked
$(".accordion-toggle").click(function() {
	edit.changeIcon(this)
});

$('#search').keyup(function() {
	edit.search(this);
});

//create new based on
$(".btncreatenew").click(function(){
	createNewBasedOn.createnew("swatch/create/", this);
});

<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ('../shared/modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../shared/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
>
//sends the modified data to database and saves this as a new file. 
$(".btnsaveEdit").click(function(){		
	edit.editFile("swatch/editFile"); 
});
<?php echo '</script'; ?>
><?php }} ?>
