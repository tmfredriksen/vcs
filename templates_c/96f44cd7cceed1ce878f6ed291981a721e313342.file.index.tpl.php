<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 10:26:50
         compiled from "views\Home\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:760556c174ac0fa80-13410329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96f44cd7cceed1ce878f6ed291981a721e313342' => 
    array (
      0 => 'views\\Home\\index.tpl',
      1 => 1432890040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '760556c174ac0fa80-13410329',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c174ac6b314_72678056',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c174ac6b314_72678056')) {function content_556c174ac6b314_72678056($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<div class="page-header space" align="center">
		<h1>
			<small>Welcome <?php echo $_SESSION['user'];?>
. You are logged in. Select action in menu. </small>
		</h1>
	</div>
	<div class="row">
		<div class="col-md-4">
			<img
				src="https://www.basefarm.com/sites/default/files/styles/featured_thumbnail/public/media/Article/Basefarm%20Cloud%20Computing.jpg?itok=6m5Pls8L">
		</div>
		<div class="col-md-6">
			<h2>You have 3 choices.</h2> <br /> <b>1. Manual source</b><br/>
			Here you can create, check file history, restore deleted and recently changed files.  <br />
			<b>2. Alerts </b><br/>
			Here you can create, check file history, restore deleted and recently changed files.
			<br /><b> 3. Swatch</b><br/>
			Here you can create, check file history, restore deleted and recently changed files.
			<br />
					<br/><a href="/vcs/Brukerveiledning.pdf" target="_blank">Norwegian user manual</a>
			<br/><br/><b> For questions, 
			please contact administrator something@basefarm.com
			</b>
		</div>
		
		
		
	</div>
	<br />
</div>
<?php echo $_smarty_tpl->getSubTemplate ('../shared/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
