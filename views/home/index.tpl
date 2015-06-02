{include file='../shared/navbar.tpl'}
<div class="container">
	<div class="page-header space" align="center">
		<h1>
			<small>Welcome {$smarty.session.user}. You are logged in. Select action in menu. </small>
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
{include file='../shared/footer.tpl'}
