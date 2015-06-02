{include file='../shared/navbar.tpl'}

<div class="container">
	<div class="page-header space">
		<ol class="breadcrumb">
			<li><a href="index">Alert</a></li>
			<li><a href="create">Create new</a></li>
			<li class="active">Settings</li>
		</ol>
      	<h1 style="align:center">Settings</h1>      	
   	</div>
	<div hidden="true" id="alert"
		class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"
			aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<!-- Example to check who has right to define alert actions -->
	{if isset($smarty.session.user) }
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<h3>
				<span class="label label-info">Add action</span>
			</h3>
			<input placeholder="Alert action" id="action" class="form-control"
				type="text" required />

			<h3>
				<span class="label label-info">Variable</span>
			</h3>
			<input placeholder="variable" id="variable" class="form-control"
				type="text" required />
			<h3>
				<span class="label label-info">Comment</span>
			</h3>
			<textarea placeholder="comment" id="comment" class="form-control"
				style="resize: none" required ></textarea>

			<h3>
				<input class="btn btn-default" type="submit" id="saveAction"
					value="Save action" />
			</h3>
		</div>
		<br />
		<div class="col-xs-6 col-md-6">
			<table class="table table-bordered" id="contentTable">
				<thead>
					<tr>

						<th>Action</th>
						<th>Variable</th>
						<th>Comment</th>

					</tr>
				</thead>
				{foreach from=$viewmodel key=i item=alert}
				<tbody>
					<tr>
						<td>{$alert->getAction()}</td>
						<td>{$alert->getVariable()}</td>
						<td>{$alert->getComment()}</td>
						<td class="ID" style="display:none">{$alert->getID()}</td>	
						<td><h3><input class="btn btn-default deleteAction" type="submit" 
					value="Delete" /></h3></td>
					</tr>
				</tbody>
				{/foreach}
			</table>
		</div>
	</div>
	{/if}
	<br />
</div>

<script>
	$('#saveAction').click(function() {
		home.createAlertAction();
	});

	$('.deleteAction').click(function() {
		home.deleteAlertAction(this);
	});
</script>

{include file='../shared/footer.tpl'}
