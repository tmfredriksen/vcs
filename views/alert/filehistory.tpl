{include file='../shared/navbar.tpl'}

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
		    			{foreach from=$viewmodel key=key item=file}
		    				<tbody>
								<tr class="selectFile">
								    <td class="fileid" style="display:none">{$file->getFileID()}</td>
								    <td class="filename">{$file->getFilename()}</td>	
								</tr>
						  	</tbody>
		    			{/foreach}
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

<script type="text/javascript">

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



</script>
<script type="text/javascript" src="/vcs/js/alert.js"></script>
{include file='../shared/footer.tpl'}