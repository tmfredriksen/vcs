
/**
 * Contains javascript that are common for all filetypes
 * 
 * @author Tommy Langhelle, Tord-Marius Fredriksen, Eivind Skreddernes
 * Date 25.05.2015
 */

 /**
 *	var createfile
 *	Function for creating a file, sends a ajax request to the server as a json 
 *
 * @param url (url for wich controller you want to send to)
 * @param filetype (wich type of file it is (1 for manual source, 2 for alert and 3 for swatch))
 */
var createFile = function(url, filetype){
	var fileName = $("#filename").val(); //filename
	var filePath = $("#filepath").val(); //filepath
	var comment = $("#comment").val(); //comment
	var content; //conent
	if(filetype == 1) //manual source
	{
		content = []; //content as array
		$('input[name^=content]').each(function(){
			content.push($(this).val());
		});
	}
	else
		content = $("#contentText").val();
		
	//Checks if the fields are empty
	if(!filename || !filePath){
		$("#alert").removeClass("alert-success");
		$("#alert").addClass("alert-danger");
		$("#alert").html("All fields must be filled out");
        $("#alert").show();
        return true;
	}
		//json data to the server
		var data =  { "content":content, 
					"comment":comment, 
					"path":filePath, 
					"filename":fileName, 
					"type":filetype};
	//Ajax request
	$.ajax({
		type: 'POST', 
		contentType: "application/json",
		url: '/vcs/' + url,
		dataType: "json", 		
		data: JSON.stringify(data), 
		success: function(response) {
			
			//if the rew
			//if(response == 'invalid expression in content' && filetype == 3) {
			//	alert(response);		
			//return false;
			//}
			//Success message
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
	});
}
/**
 *  var edit
 *
 *	Contains function for the index page for each type
 *
 */
var edit = {
		
	/**
	 * javascript method for searching after files in index for all file types
	 */
	search: function(value){
		var $rows = $('#contentTable tr[id^="activeFile"]');
		var val = $.trim($(value).val()).replace(/ +/g, ' ').toLowerCase();
		
		$rows.show().filter(function(){
			var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
			return !~text.indexOf(val);
		}).hide();
	},
	/**
	 * Method for deleting a single file
	 * @param url (url for wich controller you want to send to)
	 * @param value (this)
	 */
	deleteFile: function(url, value){
		var row = $(value).closest("tr"); //table
		var fileid = row.find(".fileID").text(); //fileid for file
		var id = row.find(".eID").text(); //id for file
		
		//Safety message before deleting the file
		if (confirm("Are you sure you want to delete this file?") == true) {
		//json data to the server
		var data =  { "fileid":fileid, "id":id };
		//ajax request
		$.ajax({
			type: 'POST', 
			contentType: "application/json",
			url: '/vcs/' + url,
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
	},
	/**
	 * 
	 * @param row
	 */
	changeIcon: function(row){
		var $this = $(row);
		if($this.hasClass('glyphicon glyphicon-plus'))
			$this.removeClass("glyphicon glyphicon-plus").addClass("glyphicon glyphicon-minus");
		else
			$this.removeClass("glyphicon glyphicon-minus").addClass("glyphicon glyphicon-plus");
	},
	/**
	 * function for saving the file that are beeing edited
	 * @param url (url for wich controller you want to send to)
	 */
	editFile: function(url){
		var fileid = $("#fID").val(); //Fileid
		var fileName = $("#fileName").val(); //filename
		var filePath = $("#filePath").val(); //filepath
		var version = $("#version").val(); //version of the file
		var comment = $("#comment").val(); //comment 
		var content = $("#contentText").val(); //file content
		var id = $("#editId").val(); //id for the file

		//Check for comment and content, if it is empty
		if($.trim(content) == '') {
			$("#alertEdit").removeClass("alert-success");
			$("#alertEdit").addClass("alert-danger");
			$("#alertEdit").html("Fields cannot be empty!");
            $("#alertEdit").show();
			return false;
		}
		//json data to the server
			var data =  { "fileid":fileid,
						  "content":content, 
						  "comment":comment, 
						  "version":version, 
						  "filepath":filePath, 
						  "filename":fileName,
						  "id":id
						  };
		//ajax request
		$.ajax({
			type: 'POST', 
			contentType: "application/json",
			url: '/vcs/' + url,
			dataType: "json", 		
			data: JSON.stringify(data), 
			success: function(response) {
				
				if(response.indexOf("exist") > -1 || response.indexOf("invalid") > -1) {
					$("#alertEdit").removeClass("alert-success");
					$("#alertEdit").addClass("alert-danger");
					$("#alertEdit").html(response);
		            $("#alertEdit").show();
		            return false;
				}
				$("#alertEdit").removeClass("alert-danger");
				$("#alertEdit").addClass("alert-success");
				$("#alertEdit").html(response);
	            $("#alertEdit").show();
	         	setTimeout(function(){
	           		location.reload();
	           }, 2000);
	          },
		      error : function(xhr, ajaxOptions, thrownError) {
		    	  alert(thrownError);
		      }
		});
	}

}
/**
 * Contains functions used in the filehistory page.
 */
var fileHistory = {
		/**
		 * javascript method for searching after files in filehistory page
		 * @param value(this)
		 */
		search: function(value){
			var $rows = $('#filetable tr');
			var val = $.trim($(value).val()).replace(/ +/g, ' ').toLowerCase();
			
			$rows.show().filter(function(){
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
				return !~text.indexOf(val);
			}).hide();
		},
		/**
		 * 
		 * function for comparing two files
		 */
		compareStrings: function(){
			//finds all the fileversjons that are selected
			var rows = $(".selectedfiles").find("td").has('input[type=checkbox]:checked');
			
			if(rows.length == 2) //More than two rows will not happen, because of if-check on the checkboxes
				{
				 var content = rows.map(function () { //returns the content of the selected versions.
				        return $(this).parent().find('td:nth-child(2)').text();
				    }).get();
				 
				 var $newString = content[0]; //newest file by creation date
				 var $oldString = content[1]; //oldest file by creation date
				 
				 var data = { "oldString" : $oldString,
						  	  "newString" : $newString };
				 
				 $.ajax({
						type: 'POST', 
						contentType: "application/json",
						url: '/vcs/manualsource/calculateDiff',
						dataType: "json", 		
						data: JSON.stringify(data), 
						success: function(response) {
							$("#fileContent").text(""); //clears the content-textarea
							$("#fileContent").append(response); //appends the result from the Diff class.
						}
					});
				}
		},
		/**
		 * 
		 * @param value (this)
		 * @param url (url for wich controller you want to send to)
		 */
		selectedFile: function(value, url){
			$("#fileContent").text("");
			var $row = $(value).closest("tr");
			fileHistory.changeRowColor($row, 1);
			var $fileid = $row.find(".fileid").text();

			$.ajax({
				type: 'POST',
				contentType: "application/json",
				url: '/vcs/' + url,
				data: $fileid,
				dataType: 'json',
				success: function(data){
					//creates a table and tbody element which will be filled with rows from the database.
					var table = document.createElement("table");
					var tbody = document.createElement("tbody");

					//sets the table classes.
					table.className = "table table-bordered";
					//cleares any tables already existing in the <div id="filehistory">.
					document.getElementById("historytable").innerHTML = "";
					
					for (var i = 0; i < data.length; i ++) {

						//Creates all the elements and textNodes needed to build the table containing fileversions.
						//The textnodes are filled with data obtained from database.
						var tr = document.createElement("tr");
						var td = document.createElement("td");
						var hiddentd = document.createElement("td");
						var checkbox = document.createElement("input");
						var textComment = document.createTextNode(data[i].Comment);
						var textContent = document.createTextNode(data[i].Content);
						var textDateUser = document.createTextNode(data[i].Time + " by " + data[i].User)

						//Sets all the required properties of the checkbox.
						checkbox.type = "checkbox";
						checkbox.id = "checkboxes";
						checkbox.name = "compare[]";
						checkbox.style.cssFloat = "right";
						//function that checks how many checkboxes that are checked, and disables the rest if two are checked.
						checkbox.onclick = function(){
							if ($(":checkbox[name='compare[]']:checked").length == 2)                                              
						    	$(':checkbox:not(:checked)').prop('disabled', true);  
						  	else                                                     
						   		$(':checkbox:not(:checked)').prop('disabled', false); 
						}
						//appends all required elements to a <td>.
						td.appendChild(textComment);
						td.appendChild(document.createElement("br"));
						td.appendChild(textDateUser);
						td.appendChild(checkbox);	
						
						//sets all the required properties of the hidden <td> containing the filecontent.
						hiddentd.appendChild(textContent);
						hiddentd.style.display = "none";
						
						//appends both <td>'s to the <tr> and gives the <tr> classes.
						tr.appendChild(td);
						tr.appendChild(hiddentd);
						tr.className = "tr"+ data[i].ID + " selectedfiles";
						
						//sets the onclick function for the <tr>.
						//this function fills the content-field with filecontent and colors the selected <tr>
						tr.onclick = (function(content, id) {
				            return function() {
				            	var $row = $(".tr" + id); //finds the selected row
				            	fileHistory.changeRowColor($row, 2); //changes color of selected row
				            	$("#fileContent").text(""); //clears the content-textarea
				            	$("#fileContent").text(content); //appends the correct content
				            }
				        })(data[i].Content, data[i].ID);
						
						//appends the <tr> to the tbody element.
						tbody.appendChild(tr);
					}
					//appends the filled tbody to the table element.
					table.appendChild(tbody);
					//appends the table to the <div id="historytable">
					document.getElementById("historytable").appendChild(table);
				}
			});
		},
		changeRowColor: function(row, table){
			if(table == 1)
				$("#filetable tr").removeClass("highlight");
			else
				$("#historytable tr").removeClass("highlight");

			row.toggleClass("highlight");
		}
}
/**
 * var index
 * javascript for the index page
 */
var index = {
		/**
		 * Method for filling the modal for editing
		 * @param value(table)
		 */
		fillModal: function(value){
			var $row = $(value).closest("tr"); //table row
			var id = $row.find(".eID").text(); //id for the file
			
			var data = {"id":id}; //json data to the server
		
			//ajax request
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/manualsource/getFile',
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(data){
					
					//If the file is beeing edited
					if(data.File != null){
						
						alert("'File is beeing edited'");
		           		location.reload();

						return false;
					}
					else {
					$("#contentText").val(data.Content);
					$("#fileName").val(data.Filename);
					$("#filePath").val(data.Path);
					$("#filetype").val(data.Type)
					$("#fID").val(data.FileID);
					$("#version").val(data.Version);
					$("#comment").val(data.Comment);
					$("#editId").val(data.ID);
					}
				
				},
				error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			});	
		},
		
		/**
		 * @param value 
		 */
		fillModalRecentlyChanged: function(value){
			
			var data = {"id":value}; //json data to the servers
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/manualsource/getFile',
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(response){
					
					if(response.File != null){
						
						alert("'File is beeing edited'");
		           		location.reload();

						return false;
					}
					else {
					$("#contentText").val(response.Content);
					$("#fileName").val(response.Filename);
					$("#filePath").val(response.Path);
					$("#filetype").val(response.Type)
					$("#fID").val(response.FileID);
					$("#version").val(response.Version);
					$("#comment").val(response.Comment);
					$("#editId").val(response.ID);
					}
				},
				error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			});	
		}
}
/**
 * javascript for restoredeleted page
 */
var restoreDeleted = {
		
		/**
		 * 
		 * Method for searching after files in restoredeleted page
		 * @param value
		 */
		search: function(value){
			var $rows = $('#contentTable tr[id^="activeFile"]');
			var val = $.trim($(value).val()).replace(/ +/g, ' ').toLowerCase();
			
			$rows.show().filter(function(){
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
				return !~text.indexOf(val);
			}).hide();
		},
		/**
		 * 
		 * Method for restoring files by fileID
		 * @param url (what controller you want to send it to)
		 * @param value (this)
		 */
		restore: function(url, value){
			var $row = $(value).closest("tr"); //table row
			var id = $row.find(".fileid").text(); //fileid
			
			if (confirm("Are you sure you want to restore this file?") == true) {
			//json data to the server
			var data =  { "id":id };
			//ajax request
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/' + url,
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(response){
					$("#alertSuccess").html(response);
		            $("#alertSuccess").show();
		         	setTimeout(function(){
		           		location.reload();
		           }, 2000);
		           },
			      error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			});
			}
			else {
				return false;
			}
			
		},
		/**
		 * 
		 * Used to change the '+' icon to '-' and vice versa in tables.
		 * @param row
		 */
		changeIcon: function(row){
			var $this = $(row);
			if($this.hasClass('glyphicon glyphicon-plus'))
				$this.removeClass("glyphicon glyphicon-plus").addClass("glyphicon glyphicon-minus");
			else
				$this.removeClass("glyphicon glyphicon-minus").addClass("glyphicon glyphicon-plus");
		}, 
		/**
		 * Method that sends a ajax request for restoring one single file
		 * @param url (what controller you want to send it to)
		 * @param value
		 */
		restoreSingleFile: function(url, value) {
			var $row = $(value).closest("tr");
			var fileid = $row.find(".fileid").text();
			var id = $row.find(".eID").text();
			if (confirm("Are you sure you want to restore this version?") == true) {

			var data =  { "id":id, "fileid":fileid };
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/' + url,
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
			});
			}
			else {
				return false;
			}
		}
}
/**
 * var createNewBasedOn
 * 
 */
var createNewBasedOn = {
		
		/**
		 * Function for creating a new file based on the old content
		 * @param url (what controller you want to send it to)
		 * @param value (this)
		 */
		createnew: function(url, value) {
			var $row = $(value).closest("tr");
			var id = $row.find(".eID").text();
			if (confirm("Are you sure you want create a new file based on this file?") == true) {
			window.location.href = "/vcs/" + url + id;
		} else {
			return false;
		}
	}
}
/**
 * var view
 * javascript for the view button
 */
var view = {
		/**
		 * Fill the modal for view button
		 * @param value (this)
		 */
		fillModal: function(value){
			var $row = $(value).closest("tr"); //table row
			var id = $row.find(".eID").text(); //id for the file
			var data = {"id":id}; //json data to the server
			//ajax request
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/manualsource/getFileView',
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(data){
					$("#viewDate").val(data.Filename + " " + data.Time);
					$("#viewContent").val(data.Content);
				},
				error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			});	
		}
}
/**
 * var lock
 * 	Method that send an ajax request for unlocking a file
 * @param id (id for the file)
 */
var unlock = function(id) {
			var data = {"id":id}; //json data to the server
			//ajax request
			$.ajax({
				type: 'POST', 
				contentType: "application/json",
				url: '/vcs/manualsource/unlockFile',
				dataType: "json", 		
				data: JSON.stringify(data), 
				success: function(data){	
				},
				error : function(xhr, ajaxOptions, thrownError) {
			    	  alert(thrownError);
			      }
			});	
			
		}
