{include file='../shared/header.tpl'}
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
					<li><p class="navbar-text">Logged in as {$smarty.session.user} <span class="glyphicon glyphicon-user" aria-hidden="true"></span></p></li>		
					<li><a href="/vcs/home/logout">Log out <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
					</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</nav>
</div>

