{include file='../shared/navbar.tpl'}
<div class="container">
	<div class="page-header space">
		<ol class="breadcrumb">
			<li><a href="index">Alert</a></li>
			<li class="active">Recently changed</li>
		</ol> 
      	<h1 style="align:center">Recently changed</h1>   
	</div>	
	{foreach from = $viewmodel item = array key=i}
		<div class="panel panel-default well col-md-4">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>{if $i == 0}Manual Source{elseif $i == 1}Alert{else}Swatch {/if}</b></h3>
		  </div>
			{foreach from = $array item = file}
				{if (($file->getLocked()) != null)}
			<div class="panel panel-default" style="color:RED">
		  		<div class="panel-body">
		  			<div><i>Filename: </i> {$file->getFilename()}</div>
		  			<div><i>date: </i>{$file->getTime()}</div> 
		  			<div><i>User: </i> {$file->getUser()}</div>
		  		</div>
		  	</div>
			{else}
				<div class="panel panel-default">
		  		<div class="panel-body">
		  			<div><i>Filename: </i> {$file->getFilename()} 
		  			<button class="btn btn-default btnEditfile" value='{$file->getID()}' data-toggle="modal" data-target="#myModal" style="float:right"><h5>Edit</h5></button></div>
		  			<div><i>date: </i>{$file->getTime()}</div> 
		  			<div><i>User: </i> {$file->getUser()}</div>
		  		</div>
		  	</div>
		  	{/if}
		  	{/foreach}
		</div>
	{/foreach}
</div>
<script type="text/javascript">
//Fills the popup-modal with data

	$(document).ready(function() {
		$(".btnEditfile").click(function() {			
			index.fillModalRecentlyChanged($(this).attr("value"));
			
			//Timer for editing (concurrancy control). 
			//User have 15 minutes of time for editing a file or user will be thrown out.
			//After 13 minutes user get a message about 2 minutes left
			setTimeout(function(){
				alert("You have 2 minutes left");
			}, 780000); //13 minutes, message about 2 minutes left
			setTimeout(function() {
				$('#myModal').modal('hide');
				var id = $("#fID").val();
				var et = this;
				unlock(id);
				alert("Time has run out");
			}, 900000); //15 minutes of time for editing before you get kicked
		});
		//sends the modified data to database and saves this as a new file. 
		$("#btnsaveEdit").click(function(){		
			var type = $("#filetype").val();
			switch(type) {
			case "1":
				edit.editFile("manualsource/editFile", 1); 
				break;
			case "2":
				edit.editFile("alert/editFile", 2); 
				break;
			case "3":
				edit.editFile("swatch/editFile", 3); 
				break;
			}
		});
	});
	
</script>
{include file='../shared/modal.tpl'}
{include file='../shared/footer.tpl'}