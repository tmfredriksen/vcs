{include file='../shared/header.tpl'}
<div class="container">
	
	<div class="page-header space" align="center">
      	<h1>User login</h1>
   	</div>
	<div class="form-signin">
		<input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Username" style="margin-bottom:10px" required autofocus> 
		<input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
		
		<button class="btn btn-lg btn-info btn-block" id="btnLogin" type="submit"><h4>Sign in</h4></button>
	</div>
	<div class="col-md-8 col-md-offset-2">
	<div id="alert" class="alert alert-warning alert-dismissible" role="alert" hidden="true">
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	</div>
</div>


{literal}
<script>
var go = document.getElementById("btnLogin");
var txt = document.getElementById("inputPassword");

txt.addEventListener("keypress", function() {
    if (event.keyCode == 13) go.click();
});

$("#btnLogin").click(function(){
	home.login();
});

</script>


{/literal}

{include file='../shared/footer.tpl'}