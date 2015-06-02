<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 10:26:40
         compiled from "views\Home\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18261556c17405c4d95-19151873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c14985ff9e07c04d4f983a9c182fda0ff5da1721' => 
    array (
      0 => 'views\\Home\\login.tpl',
      1 => 1429515198,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18261556c17405c4d95-19151873',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c17406a3fb7_98372109',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c17406a3fb7_98372109')) {function content_556c17406a3fb7_98372109($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	
	<div class="page-header space" align="center">
      	<h1>User login</h1>
   	</div>
	<div class="form-signin">
		<input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Username" style="margin-bottom:10px" required autofocus> 
		<input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
		
		<button class="btn btn-lg btn-info btn-block" id="btnLogin" type="submit"><h4>Sign in</h4></button>
	</div>
	<div class="col-md-8 col-md-offset-2">
	<div id="alert" class="alert alert-warning alert-dismissible" role="alert" hidden="true">
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	</div>
</div>



<?php echo '<script'; ?>
>
var go = document.getElementById("btnLogin");
var txt = document.getElementById("inputPassword");

txt.addEventListener("keypress", function() {
    if (event.keyCode == 13) go.click();
});

$("#btnLogin").click(function(){
	home.login();
});

<?php echo '</script'; ?>
>




<?php echo $_smarty_tpl->getSubTemplate ('../shared/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
