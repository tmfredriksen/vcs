
/**
 * alert.js
 * @author Tommy Langhelle
 * @name JavaScript for create-alert view
 * @date 12.04.2015
 */

/*	
 * <?xml version="1.0" encoding="UTF-8"?>													|		
 * <alerts customer="example">																| <<----------------- rootElement|
 * 																															 |
 * 						elementArray[]							<<---- elementStart 		|								 |
 * 	_______________________|________________________										|					  			 |  	
 * 	 <alert hostname="example" subsystem="example">				 							|					  			 |
 * 	  																						|					  			 |	
 * 					childElementArray[]		<--   elementstring	<<---- childElement[]		|					  			 |	
 *		___________________|___________________________________ 							|---to string----|				 |	
 *  	<sms oper="add" number="99999999" level="DEFAULT"/>	 								|				 |				 |
 * 	  																						|				 |				 |	
 * 					childElementArray[]		<--   elementstring	<<---- childElement[]		|				 |				 |	
 * 		___________________|______________________________									|				 |				 |	
 * 		<email oper="add" address="example@example.com"/>	 	 				  			|				 |				 |	
 * 	 </alert>													<<---- elementEnd			| 				 |				 |	
 *																											 |				 |	
 *																											 |<<-- elements[]| <-- function updateContentTextarea()
 *																						 					 |				 |
 * 						elementArray[]							<<---- elementStart 		|				 |				 |
 * 	_______________________|________________________										|				 |				 |
 * 	 <alert damcluster="example" probe="example">				 							|				 |				 |
 * 	  																						|				 |				 |
 * 					childElementArray[]		<--   elementstring	<<---- childElement[]		|				 |				 |
 *		___________________|___________________________________ 							|---to string----|			 	 |
 *  	<sms oper="add" number="99999999" level="DEFAULT"/>	 								|						 		 |
 * 	  																						|						  		 |
 * 					childElementArray[]		<--   elementstring	<<---- childElement[]		|								 |
 * 		___________________|______________________________									|								 |
 * 		<email oper="add" address="example@example.com" /> 				 		  			|								 |
 * 	 </alert>													<<---- elementEnd			| 								 |	
 *																															 |
 * </alerts>																				| <-------------------------- end|					
 *
 * function updateElementStart() generates elementStart from elementArray[]
 * function updateChildElement() generates the strings in the childElement[] from childElementArray[]
 * function updateElement() are assigning each part of the element to the correct array-possition in elements[] as a string
 * function updateContentTextarea() displays information in preview content -textarea
 */				

/*
 * Contains the root information. xml version, encoding and customername
 */
var rootElement = "";

/*
 * Contains all the information inside the xml-file as an array.: startbracket, elements and endbracket.
 */
var elements = [];

/*
 * Contains all actions available in the dropdownlists.
 */
var alertActions = [];

/*
 * Contains the data retrived from a LDAP search
 */
var ldapCustomers = [];

/*
 * Contains the data retrived from a LDAP search
 */
var ldapDamcluster = []; 

/*
 * Contains the data retrived from a LDAP search
 */
var ldapHostname = []; 

/*
 * Used to assign unique id to fields
 */
var trNum = +$("#inputIndex").val();

/**
 * Contains all Javascripts used in the .tpl file that creates alertfiles.
 */
var createAlert = {	
	
	/**
	 * Retrives all actions from DB that will be available in various dropdown-menus.
	 */
	alertActions: function(){
		$.ajax({
			type: 'POST', 
			contentType: "application/json",
			url: '/vcs/alert/alertActions',
			dataType: 'json', 		
			success: function(data) {
				for(var i = 0; i < data.length; i++)
					alertActions[i] = data[i];
			}	
		});
	}, 	
	
	/**
	 * Provides the arrays containing LDAP-info with their data. The arrays are used to suggest matching
	 * information from DB with input 
	 */
	ldapResults: function(){

		$.ajax({
			type: 'POST', 
			contentType: "application/json",
			url: '/vcs/alert/ldapSearch',
			dataType: 'json', 		
			success: function(data) {
				
				for(var i = 0; i < data.customer.length; i++)
					ldapCustomers[i] = data.customer[i];	
				
				for(var i = 0; i < data.damcluster.length; i++)
					ldapDamcluster[i] = data.damcluster[i];	
				
				for(var i = 0; i < data.hostname.length; i++)
					ldapHostname[i] = data.hostname[i];	
	         },
		      error : function(xhr, ajaxOptions, thrownError) {
		    	  alert(thrownError);
		      }
		});
		
	},

	/**
	 * Adds the start of the .xml file aswell as the root element bracket containing customername.
	 */
	previewRootElement: function(field){
		var xmlHeader = '<?xml version="1.0" encoding="UTF-8"?>\n';
		var customer = '<alerts customer="'+ field.value +'">\n';
		rootElement = xmlHeader + customer;
		createAlert.updateContentTextarea();
	},
	
	/**
	 * Updates the textarea previewing the .xml file under construction.
	 */
	updateContentTextarea: function(){
		var contentTextarea = document.getElementById("contentText");
		contentTextarea.value = rootElement;
		for(i = 0; i < elements.length; i++){
			if(elements[i] != undefined)
				contentTextarea.value += elements[i];
		}
		contentTextarea.value += '</alerts>';
	},
	
	/**
	 * Used to fill dropdownlists, to avoid code-duplication
	 * @param object, array
	 */
	fillDropdown: function(array){
		
		var select = document.createElement("select");
		select.className = "form-control";
		
		if(array[0].action != undefined) //equals true if array contains objects.
		{
			for(var i = 0; i < array.length; i++){
				var option = new Option();
				option.text = array[i].action;
				option.value = array[i].variable;
				select.add(option);
			}
			return select;
		}

		for(var i = 0; i < array.length; i++){
			var option = new Option();
			option.text = array[i];
			select.add(option);
		}
		return select;
	},
	
	/**
	 * Handles the creation of fields and buttons needed to create a working .xml file.
	 */
	addBrackets: function(){
		trNum++;
		tdNum = 0;
		var elementArray = [" ", " ", " ", " "]; //contains all element info
		var elementstart = '  <alert>\n'; 		   //Startbracket
		var childElement = []; 				   //Content inside each element stored inside an array
		var elementEnd = '  </alert>\n';  //Endbracket
		
		
		var divAlert = document.getElementById("alertbrackets"); //get the div element where elements will be added
		var div = document.createElement("div"); //Contains one alert childelement (<alert>..content..</alert>)
		div.id = "div"+trNum;
		var tableAlertBracket = document.createElement("table");
		tableAlertBracket.className = "table table-bordered";
		
		var tbodyAlertBracket = document.createElement("tbody");
		var tr = document.createElement("tr"); 
		
		var tdTextbox = document.createElement("td")
		var tdTextboxOptional = document.createElement("td")
		var tdDropdown = document.createElement("td")
		var tdDropdownOptional = document.createElement("td")

		var dropdowncontent = [" ", "hostname", "damcluster"];
		var dropdown = createAlert.fillDropdown(dropdowncontent);

		dropdowncontent = [" ", "probe", "subsystem"];
		var dropdownOptional = createAlert.fillDropdown(dropdowncontent);
		
		var textbox = document.createElement("input");
		textbox.type = "text";
		textbox.style.height = "34px";
		textbox.disabled = "disabled";
		textbox.onkeyup = function(){
			updateElementStart(this, 1); //insert this.value into arrayposition 1. 
			if(dropdown.options[dropdown.selectedIndex].value == "hostname"){
				$(this).autocomplete({ //suggest names from DB matching entered information
					source: ldapHostname //contains hostname from DB obtained through LDAP
				});
			}
			if(dropdown.options[dropdown.selectedIndex].value == "damcluster"){
				$(this).autocomplete({ //suggest damclusters from DB matching entered information
					source: ldapDamcluster //contains damclusters from DB obtained through LDAP
				});
			}	
		}
		//determines if dropdown-table should be enabled or not.
		dropdown.onchange = function(){
			updateElementStart(this, 0);
			if(this.value == 0){
				textbox.disabled = true;
				dropdownOptional.disabled = true;
			}
			else{
				textbox.disabled = false;
				dropdownOptional.disabled = false;
			}		
		}
		tdDropdown.appendChild(dropdown)
		tr.appendChild(tdDropdown);
		tdTextbox.appendChild(textbox);
		tr.appendChild(tdTextbox);
		
		var textboxOptional = document.createElement("input");
		textboxOptional.type = "text";
		textboxOptional.style.height = "34px";
		textboxOptional.disabled = "disabled";
		textboxOptional.onkeyup = function(){
			updateElementStart(this, 3);
		}
		
		dropdownOptional.disabled = true;
		dropdownOptional.onchange = function(){
			updateElementStart(this, 2);
			if(this.value == 0){
				textboxOptional.disabled = true;
			}
			else
				textboxOptional.disabled = false;
		}
		tdDropdownOptional.appendChild(dropdownOptional);
		tr.appendChild(tdDropdownOptional);
		tdTextboxOptional.appendChild(textboxOptional);
		tr.appendChild(tdTextboxOptional);

		
		
		var table = document.createElement("table");
		table.className = "table table-bordered";
		
		var tbody = document.createElement("tbody");
		tbody.id = "tbody"+trNum;
		
		var btnAddLine = document.createElement("input");
		btnAddLine.type = "button";
		btnAddLine.className = "btn btn-info customButton";
		btnAddLine.value = "Add line";
		btnAddLine.style.height = "34px";
		btnAddLine.id = trNum;
		btnAddLine.onclick = function () { //adds a childelement to the selected element.
			var rootElementID = this.id;
			var childElementArray = ['      <sms oper="', 'add" ', " ", " "]; //the default information to be in the childelement when created.
			
			var tdOper = document.createElement("td");
			var dropdown = createAlert.fillDropdown(alertActions);
			dropdown.id = tdNum;
			dropdown.onchange = function(){		
					var arrayPosition = 0; //What position in the childelement line to be updated.
					updateChildElement(this, arrayPosition);
				};
			tdOper.appendChild(dropdown);
			updateChildElement(dropdown, 0);
		
			var tdAdd = document.createElement("td");
			dropdowncontent = ["add", "override"];
			dropdown = createAlert.fillDropdown(dropdowncontent);
			dropdown.id = tdNum;
			dropdown.onchange = function(){		
					var arrayPosition = 1; //What position in the childelement line to be updated.
					updateChildElement(this, arrayPosition);
				};
			
			tdAdd.appendChild(dropdown);
			
			var tdText = document.createElement("td");
			var textbox = document.createElement("input");
			textbox.type="text";
			textbox.style.height = "34px";
			textbox.id = tdNum;
			textbox.onkeyup = function(){
				var arrayPosition = 3; //What position in the childelement line to be updated.
				updateChildElement(this, arrayPosition);
			}
			tdText.appendChild(textbox);
		
			var tdDefault = document.createElement("td");
			dropdowncontent = [" ", "3", "DEFAULT"];
			dropdown = createAlert.fillDropdown(dropdowncontent);
			dropdown.id = tdNum;
			dropdown.onchange = function(){		
					var arrayPosition = 4; //What position in the childelement line to be updated.
					updateChildElement(this, arrayPosition);
				};
			tdDefault.appendChild(dropdown);
			
			var tdbtnDeleteLine = document.createElement("td");
			var btnDeleteLine = document.createElement("input");
			btnDeleteLine.type = "button";
			btnDeleteLine.className = "btn btn-danger ";
			btnDeleteLine.value = "X";
			btnDeleteLine.onclick = function(){
				
				if (confirm("Are you sure you want to delete this line?") == true) {
					childElement[dropdown.id] = undefined;// at position dropdown.id, set value to undefined. can not remove from array because of array-index and dropdown.id working together.
					$(this).closest('tr').remove();
					updateElement();
				}
				else
					false;
			}
			btnDeleteLine.style.height = "34px";
			tdbtnDeleteLine.appendChild(btnDeleteLine);
		
			var tr = document.createElement("tr");
			tr.appendChild(tdOper);
			tr.appendChild(tdAdd);
			tr.appendChild(tdText);
			tr.appendChild(tdDefault);
			tr.appendChild(tdbtnDeleteLine);
			
			tbody.appendChild(tr);
			tdNum++;
			
			function updateChildElement(elementInfo, arrayPosition){
				var elementstring = ""; //Used to store all selected info in a certain line.
				switch(arrayPosition){
				
				case 0: childElementArray[arrayPosition] = '      <' + elementInfo.options[elementInfo.selectedIndex].text + ' oper="'; //appends the desired action
						if(elementInfo.value == ""){
							textbox.disabled = true;
							childElementArray[3] = "";
							textbox.value = "";
						}
						else
							if(typeof textbox !== 'undefined')
								textbox.disabled = false;
							
						childElementArray[2] = elementInfo.value//appends the variable attached to the selected action. number, file, address etc.
						break;
						
				case 1: childElementArray[arrayPosition] = elementInfo.value + '" '; // append the selected oper. add or override.
						break;
						
				case 3: childElementArray[arrayPosition] = '="' + elementInfo.value + '"'; // appends the text submitted. email, phonenumber, filepath etc.
						break;
						
				case 4: if(elementInfo.value == "")
							childElementArray[arrayPosition] = "";
						else
							childElementArray[arrayPosition] = ' level="' + elementInfo.value + '" '; // appends the selected level. DEFAULT, 1,2,3 etc.
						break;
				}
				childElementArray[5] = ' /> \n';
				for(i = 0; childElementArray.length > i; i++)
				{
					if(childElementArray[i] != undefined)
						elementstring += childElementArray[i]; // stores all the information in the array to a string.
				}
				childElement[dropdown.id] = elementstring; //appends the string created above to the correct position in the childElement-array.
				updateElement();
			};
			
		}
		table.appendChild(tbody);
		tr.appendChild(btnAddLine);
		
		var tdbtnDeleteBracket = document.createElement("td");
		var btnDeleteBracket = document.createElement("input");
		btnDeleteBracket.type = "button";
		btnDeleteBracket.className = "btn btn-danger ";
		btnDeleteBracket.value = "X";
		btnDeleteBracket.onclick = function(){
			
			if (confirm("Are you sure you want to delete this line?") == true) {
				elements[btnAddLine.id] = undefined;// at position dropdown.id, set value to undefined. can not remove from array because of array-index and dropdown.id working together.
				elementstart = "";
				childElement = [];
				elementEnd = "";
				$(this).closest('tr').remove();
				$("#div"+btnAddLine.id).empty();
				updateElement();
			}
			else
				false;
		}
		tdbtnDeleteBracket.style.height = "34px";
		tdbtnDeleteBracket.appendChild(btnDeleteBracket);
		tr.appendChild(tdbtnDeleteBracket)
		
		
		tableAlertBracket.appendChild(tr);
		div.appendChild(tableAlertBracket);
		
		div.appendChild(table);
		
		divAlert.appendChild(div);
		
		updateElement();
		createAlert.updateContentTextarea();
		
		function updateElementStart(elementInfo,arrayPosition){
			
			var childElementHeadString = "";
			
			switch(arrayPosition){
			case 0: if(elementInfo.value == 0){
						elementArray[arrayPosition] = '   <alert'
						elementArray[1] = "";
						elementArray[2] = "";
						elementArray[3] = "";
						textboxOptional.disabled = true;
						dropdownOptional.selectedIndex = 0;
						textboxOptional.value = "";
						textbox.value = "";
					}						
					else
						elementArray[arrayPosition] = '  <alert ' + elementInfo.value;
					break;
			case 1: elementArray[arrayPosition] = '="' + elementInfo.value + '" ';
					break;
			case 2: if(elementInfo.value == ""){
						elementArray[3] = "";
						textboxOptional.value = "";
					}
					elementArray[arrayPosition] =  elementInfo.value;
					break;
			case 3: elementArray[arrayPosition] = '="' + elementInfo.value + '"';
					break;
			}
			elementstart = "";
			elementArray[4] = '>\n';
			for(i = 0; elementArray.length > i; i++)
			{	
				if(elementArray[i] != undefined)
					elementstart += elementArray[i];
			}
			updateElement();
		}

		function updateElement(){
			var elementID = btnAddLine.id; //the element currently editing
			elements[elementID] = elementstart; //finds the correct alert-element to update
			for(i = 0; childElement.length > i; i++)
			{
				if(childElement[i] != undefined) //checks if the array-position has content, if not it does not include it in the text to be displayed
					elements[elementID] += childElement[i]; //appends all the childelements to the correct alert-bracket
			}
			elements[elementID] += elementEnd; //
			createAlert.updateContentTextarea();
		}
	}
}



