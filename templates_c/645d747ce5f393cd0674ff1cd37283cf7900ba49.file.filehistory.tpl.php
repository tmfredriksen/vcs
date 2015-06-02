<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 19:35:00
         compiled from "views\Alert\filehistory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15572556c97c4c0e334-17847170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '645d747ce5f393cd0674ff1cd37283cf7900ba49' => 
    array (
      0 => 'views\\Alert\\filehistory.tpl',
      1 => 1432889951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15572556c97c4c0e334-17847170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'viewmodel' => 0,
    'file' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c97c4c92060_87480519',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c97c4c92060_87480519')) {function content_556c97c4c92060_87480519($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="container">
	<div class="page-header space">
	<ol class="breadcrumb">
		<li><a href="index">Alert</a></li>
		<li class="active">File history</li>
	</ol>
      	<h1 class="align:center">File history</h1>
   	</div>
	<div class="row">
			<div class="col-md-2" style="padding-right:0px;">
				<h3><span class="label label-info">Filename</span></h3>
				<input class="form-control borderStyling" id="search" placeholder="Search" />
				<div class="panel panel-default handCursor filenameTable">
		    		<table class="table table-bordered " id="filetable">
		    			<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['viewmodel']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['file']->key;
?>
		    				<tbody>
								<tr class="selectFile">
								    <td class="fileid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFileID();?>
</td>
								    <td class="filename"><?php echo $_smarty_tpl->tpl_vars['file']->value->getFilename();?>
</td>	
								</tr>
						  	</tbody>
		    			<?php } ?>
		    		</table>
		    	</div>
	    	</div>
	    	<div class="col-md-4 removePadding">
	    		<h3><span class="label label-info">History</span> 
	    		<input class="btn btn-info compareStrings customButton" type="button" style="float:right; margin-right:20px;" value="Calculate differences &raquo;"></h3>
				<div class="panel panel-default handCursor historyTable removePadding">
		    		<table class="table table-bordered " id=historytable>
		    		</table>
		    	</div>
	    	</div>
	    	<div class="col-md-6" style="padding-left:0px;">
	    		<h3><span class="label label-info">Content</span></h3>
	    		<pre class="customPre borderStyling" id="fileContent"></pre>
			</div>
	</div>		
</div>

<?php echo '<script'; ?>
 type="text/javascript">

/*
 * Compares two selected versions of a file and returns the difference. 
 */
$(".compareStrings").off().on("click", function(){
	fileHistory.compareStrings();
});

/*
 * Triggers when a filename is selected. 
 * Sends the selected fileID to the server and recieve all versions of that file.
 * Fills the historytable with all versions comment, owner and date of change.
 */
$(".selectFile").click(function(){
	fileHistory.selectedFile(this, "alert/getfilesoffileid");
});

/*
 * Search through table of filenames.
 */
$('#search').keyup(function() {
	fileHistory.search(this);
});



<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/vcs/js/alert.js"><?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ('../shared/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
