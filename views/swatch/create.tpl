{include file='../shared/navbar.tpl'}

<div class="container">
<ol class="breadcrumb">
			<li><a href="index">Swatch</a></li>
			<li class="active">Create new</li>
		</ol>
	<div class="page-header space" align="center">
		<h1>Create Swatch</h1>
		</div>
	<div hidden="true" id="alert"
		class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"
			aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-4 ">
			
				<h3>
				<span class="label label-info">Filename</span> <span style="font-size:16px" id="filenameShow"></span>
				</h3> 
			
			
			<input placeholder="Filename" id="filename" class="form-control"
				type="text" required />
				
		</div>
		<div class="col-xs-6 col-md-4">
			<h3>
				<span class="label label-info">Path</span>
			</h3>
			<input placeholder="Path" id="filepath" class="form-control"
				type="text" required />
		</div>
		<div class="col-xs-6 col-md-4">
			<h3>
				<span class="label label-info">Comment</span>
			</h3>
			<input placeholder="Comment" id="comment" class="form-control"
				type="text" />
		</div>
		<!-- RegexCheck -->
		<div class="col-xs-6 col-md-8">
			<h3>
				<span class="label label-info">Test a single swatch
					expression</span>
			</h3>

			<input type="text" class="form-control"
				placeholder="Regex expression" id="inputTest">
			
		</div>
		<div class="col-xs-6 col-md-4">

			<h3>
				<span class="label label-info">Code Comment</span>
			</h3>
			<input type="text" id="codeComment" class="form-control"
				placeholder="Code Comment" />

		</div>
		<div class="col-xs-6 col-md-8">

			<input type="text" id="testLine" class="form-control"
				placeholder="Test line" /> <br />
				
			<div style="margin-left: 10px; display: inline;" hidden="true"
				class="regex"></div>

			<input class="btn btn-info" id="testCommand" type="submit"
				style="float: right" value="Test Command" />
				
			<button class="btn btn-info" id="btnTest"
				style="display: none; float: right">Ok</button>
		</div>


		<div class="col-xs-12 col-md-12">
			<h3>
				<span class="label label-info">File content</span>
			</h3>
			<textarea rows="20" style="resize: none" placeholder="File content"
				name="content" id="contentText" required class="form-control">{if (isset({$viewmodel})) } {$viewmodel} {/if}</textarea>
		</div>
		<div class="clearfix"></div>
		<div class="text-center">
			<h3>
				<button class="btn btn-info" id="formSubmit" type="submit">Save</button>
			</h3>
		</div>
	</div>

</div>
{literal}
<script type="text/javascript" src="/bachelor2015/js/jquery-1.11.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	//##### send add record Ajax request to response.php #########
	$("#formSubmit").click(function() {
		createFile("swatch/createFile", 3);
	});
	//Code for using tab in textarea
	$("textarea").keydown(function(e) {
		createSwatch.enableTab(e, this);
	});
	$('#testCommand').click(function(){
		createSwatch.testCommand();
	});
	$('#btnTest').click(function(){
		createSwatch.moveText();
	});
	$(function () {
		  $('[data-toggle="popover"]').popover()
	});
	$("#filename").keyup(function() {
		var filename = $("#filename").val();
		if(filename != ''){
			$("#filenameShow").html(filename + ".txt");
		}
		else {
			$("#filenameShow").html("");
		}
	});
	$(".container").keydown(function (e){
		if (e.which == 116) {
		   if (confirm("Are you sure you want refresh the page? all data will be lost!") == true) {   
		   }
		   else {
			   return false;
		  }
	   }
	});
});

	
	
</script>
{/literal}

{include file='../shared/footer.tpl'}
