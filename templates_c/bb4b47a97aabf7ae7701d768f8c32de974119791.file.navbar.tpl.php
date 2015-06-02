<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-01 10:26:50
         compiled from "C:\Users\Tord-MariusK\git\vcs\views\shared\navbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:977556c174ac95433-87648140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb4b47a97aabf7ae7701d768f8c32de974119791' => 
    array (
      0 => 'C:\\Users\\Tord-MariusK\\git\\vcs\\views\\shared\\navbar.tpl',
      1 => 1432890084,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '977556c174ac95433-87648140',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556c174acc3531_45862435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556c174acc3531_45862435')) {function content_556c174acc3531_45862435($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../shared/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- Static navbar -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="container">

	<!-- Static navbar -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/vcs/home/">
				<img alt="" height="25" width="150" border="0" src="/vcs/resources/basefarmTransparent.png"></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="/vcs/manualsource">Manual source</a></li>
					<li><a href="/vcs/alert">Alerts</a></li>
					<li><a href="/vcs/swatch">Swatch</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">	
					<li><p class="navbar-text">Logged in as <?php echo $_SESSION['user'];?>
 <span class="glyphicon glyphicon-user" aria-hidden="true"></span></p></li>		
					<li><a href="/vcs/home/logout">Log out <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
					</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</nav>
</div>

<?php }} ?>
