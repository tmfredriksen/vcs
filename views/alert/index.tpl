{include file='../shared/navbar.tpl'}

<div class="container">	
   	<div class="col-md-12 indexGroups">
		<ol class="breadcrumb">
			<li class="active">Alert</li>
			<li></li>
		</ol> 
		<div class="page-header space" >
		      	<h1 style="align:center">Alert</h1>   
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
   	<div hidden="true" id="alert" class="alert alert-dismissible"  role="alert">
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
	{foreach from=$viewmodel key=i item=fileCollection}
		{foreach from=$fileCollection key=key item=file}
			{if $key == 0}
				{if $file->getLocked() != null} 
				<tbody style="color:RED">
					<tr id="activeFile">
						<td><div class='glyphicon glyphicon-plus accordion-toggle' data-toggle="collapse" data-target=".childfile{$i}"> </div>
					    <td class="fileID">{$file->getFileID()}</td>
					    <td class="filename">{$file->getFilename()}</td>				    
						<td class="comment">{$file->getComment()}</td>
						<td class="path">{$file->getPath()}</td>
						<td>{$file->getTime()}</td>
						<td class="version">{$file->getVersion()}</td>
						<td class="user">{$file->getUser()}</td> 
						<td class="eID" style="display:none">{$file->getID()}</td>	
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
			  	{else}
			  	<tbody>
					<tr id="activeFile">
						<td><div class='glyphicon glyphicon-plus accordion-toggle' data-toggle="collapse" data-target=".childfile{$i}"> </div>
					    <td class="fileID">{$file->getFileID()}</td>
					    <td class="filename">{$file->getFilename()}</td>				    
						<td class="comment">{$file->getComment()}</td>
						<td class="path">{$file->getPath()}</td>
						<td>{$file->getTime()}</td>
						<td class="version">{$file->getVersion()}</td>
						<td class="user">{$file->getUser()}</td> 
						<td class="eID" style="display:none">{$file->getID()}</td>	
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
								  </h3>				 
							  </ul>
							</div>
						</td>
					</tr>
			  	</tbody>
			  	{/if}
			{else}
				{if $file->getLocked() != null}
				{else}
				<tbody>
					<tr class="childfile{$i} hiddenRow accordian-body success collapse">
						<td><div></div>
						<td class="fileid">{$file->getFileID()}</td>
						<td class="filename"><i>{$file->getFilename()}</i></td>				    
						<td class="comment"><i>{$file->getComment()}</i></td>
						<td class="path"><i>{$file->getPath()}</i></td>
						<td><i>{$file->getTime()}</i></td>
						<td class="version"><i>{$file->getVersion()}</i></td>
						<td class="user"><i>{$file->getUser()}</i></td> 
						<td class="eID" style="display:none">{$file->getID()}</td>	
						<td><input type="submit" class="btn btn-info btnRestore" value="Restore"/><button type="button" class="btn btn-info btnView" data-toggle="modal" data-target="#myModalview">View</button></td>
					</tr>
				</tbody>
				{/if}
			  {/if}
		  {/foreach}
	  {/foreach}
    </table>	

	
</div>

<script type="text/javascript" src="/vcs/js/jquery-1.11.2.js"></script>
<script type="text/javascript">
$('#createPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/alert/create';
});
$('#recentlyChangedPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/alert/recentlychanged';
});
$('#historyPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/alert/filehistory';
});
$('#deletedPanel').click(function(e) {
    e.preventDefault();
    window.location = '/vcs/alert/restoredeleted';
});

//Deletes the selected file, sends it to the "deleted" table.
$(".btnDelete").click(function(){
	edit.deleteFile("alert/deleteFile", this);
});
//Restores a earlier version of a file
$(".btnRestore").click(function(){
	restoreDeleted.restoreSingleFile("alert/restoreSingleFile", this);
});


//Script that triggers when edit-button in table is clicked
$(".accordion-toggle").click(function() {
	edit.changeIcon(this)
});

$('#search').keyup(function() {
	edit.search(this);
});
</script>
{include file='../shared/modal.tpl'}
{include file='../shared/footer.tpl'}
<script type="text/javascript">
//sends the modified data to database and saves this as a new file. 
$("#btnsaveEdit").click(function(){		
	edit.editFile("alert/editFile"); 
});
</script>

