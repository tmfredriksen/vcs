{include file='../shared/navbar.tpl'}

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index">Manual Source</a></li>
		<li class="active">Restore deleted</li>
	</ol> 
	<div class="page-header space" >
      	<h1 style="align:center">Restore deleted</h1>   
   	</div>
	<div hidden="true" id="alertSuccess" class="alert alert-success alert-dismissible"
		role="alert">
		<button type="button" class="close" data-dismiss="alert"
			aria-label="Close" >
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="row">
		<div class="col-md-3">
			<input class="form-control" id="search" placeholder="Search" />
		</div>
	</div>
</br>
   <!-- Table -->
   <div class="panel panel-default">
    <table class="table table-bordered table-hover scrollable" id="contentTable">
      <thead>
      	<th width="2%">#</th>
	    <th>FileID</th>
		<th>Filename</th>
		<th>Comment</th>
		<th>Path</th>
		<th>Time</th>
		<th>Version</th>
		<th>User</th>
  	</thead>
	{foreach from=$viewmodel key=i item=fileCollection}
		{foreach from=$fileCollection key=key item=file}
			{if $key == 0}
				<tbody class="tbody2">
					<tr id="activeFile">
						<td><div class='glyphicon glyphicon-plus accordion-toggle' id="test123" data-toggle="collapse" data-target=".childfile{$i}"> </div>
					    <td class="fileid">{$file->getFileID()}</td>
					    
					    <td class="filename">{$file->getFilename()}</td>				    
						<td class="comment">{$file->getComment()}</td>
						<td class="content" style="display:none">{$file->getContent()}</td>
						<td class="path">{$file->getPath()}</td>
						<td>{$file->getTime()}</td>
						<td class="version">{$file->getVersion()}</td>
						<td class="user">{$file->getUser()}</td> 
						<td class="eID" style="display:none">{$file->getID()}</td>
						<td><h3><input type="submit" class="btn btn-danger btnRestore" value="Restore"/></h3></td>
					    
					</tr>
			  	</tbody>
			  	
			{else}
				<tbody>
					<tr class="childfile{$i} hiddenRow accordian-body success collapse">
						<td><div></div>
						<td class="fileid"><i>{$file->getFileID()}</i></td>				    
						<td class="filename"><i>{$file->getFilename()}</i></td>
						<td class="comment"><i>{$file->getComment()}</i></td>
						<td class="path"><i>{$file->getPath()}</i></td>
						<td><i>{$file->getTime()}</i></td>
						<td class="version"><i>{$file->getVersion()}</i></td>
						<td class="user"><i>{$file->getUser()}</i></td> 
					</tr>
				</tbody>
			{/if}
		{/foreach}
	 {/foreach}
	 <tbody class="tbody">			
	 </tbody>	
   </table>
  </div>
</div>



{literal}
<script>
//Script that triggers when edit-button in table is clicked
$(".accordion-toggle").click(function() {
	restoreDeleted.changeIcon(this);	
});

$(".btnRestore").click(function(){
	restoreDeleted.restore("manualsource/restoreFile", this);
});

$('#search').keyup(function() {
	restoreDeleted.search(this);
});

</script>
{/literal}
{include file='../shared/footer.tpl'}
