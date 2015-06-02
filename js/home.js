/**
 * @author Eivind Skreddernes, Tord-Marius Fredriksen
 * Javascript for home controller
 */

var home = {
		/**
		 * Function for loggin in to the system
		 */
		login: function() {
			sessionStorage.setItem("LoggingIn","trying");


			var username = $("#inputEmail").val();
			var password = $("#inputPassword").val();
			
			//Checking if the username or password is empty
				if(username == '' || password == '') {
					$("#alert").removeClass("alert-danger");
					$("#alert").addClass("alert-warning");
					$("#alert").html("All fields must be filled out");
			        $("#alert").show();
					return false;
				}
				var data =  { "username":username, "password":password };
				//ajax call to the server to authenticate the user
					$.ajax({
						type: 'POST', 
						contentType: "application/json",
						url: '/vcs/home/LoginWithLDAP',
						dataType: "json", 		
						data: JSON.stringify(data), 
						success: function(response){	
						
						//if it fails you get and error
						if(response.indexOf("error") > -1) {
							$("#alert").removeClass("alert-warning");
							$("#alert").addClass("alert-danger");
							$("#alert").html("Wrong password or username: " + response);
				            $("#alert").show();
							return false;
						}
						//Success, you are getting redirected to the index site
						window.location.href = "/vcs/home/index";

							
						},
						error : function(xhr, ajaxOptions, thrownError) {
					    	  alert(thrownError);
					      }
			
					});
		},
		/**
		 * Method/function for creating a new action in settings
		 */
		createAlertAction: function() {
			var action = $("#action").val();
			var variable = $("#variable").val();
			var comment = $("#comment").val();
			//checking if the action content is empty
			if($.trim(action) == ''){
				$(".alert").removeClass("alert-danger");
				$(".alert").removeClass("alert-success");
				$(".alert").addClass("alert-warning");
				$(".alert").html("Fields cannot be empty");
	            $(".alert").show();
				return false;
			}
			var data = {"action":action, "variable":variable, "comment":comment};
			
			//sending a ajax call to the server
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/home/createAlertAction',
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(response){	
				
				//if it fails on the server side and get error back
				if(response.indexOf("error") > -1) {
					$(".alert").removeClass("alert-success");
					$(".alert").removeClass("alert-warning");
					$(".alert").addClass("alert-danger");
					$(".alert").html(response);
		            $(".alert").show();
					return false;
				}
				$(".alert").removeClass("alert-danger");
				$(".alert").removeClass("alert-warning");
				$(".alert").addClass("alert-success");
				$(".alert").html(response);
	            $(".alert").show();
	            setTimeout(function(){
	           		location.reload();
	           }, 2000);
					
				},
				error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			
				
			});
		},
		/**
		 * Method/function for deleting a action in settings
		 * 
		 * @param value (this)
		 */
		deleteAlertAction: function(value){
			
			//value in table
			var row = $(value).closest("tr");
			//finding the row with class name ID
			var id = row.find(".ID").text();
			
			//A check to make sure you delete the rigth file
			if (confirm("Are you sure you want to delete this action?!") == true) {

			var data =  { "id":id };
			//Send ajax call to the server
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/home/deleteAlertAction',
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(response){
					$("#alert").removeClass("alert-danger");
					$("#alert").addClass("alert-success");
					$("#alert").html(response);
					$("#alert").show();
		         	setTimeout(function(){
		           		location.reload();
		           }, 2000);
		          },
			      error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			}); }
			else {
		        return false;
		    }
		}
}