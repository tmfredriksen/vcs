
/**
 * Contains javascript that are used on pages related to manualsource
 *  @author Tommy Langhelle
 * Date 14.04.2015
 */
var createManualSource = {
		/**
		 * function for adding rows/lines in create manual source for content.
		 */
		addRow: function(){
			var div = document.createElement("div"); //creating a div element
			div.className = "input-group";
			div.style.paddingBottom =  "10px";
			
			var inputText = document.createElement("input");
			inputText.type = "text";
			inputText.name = "content[]"; //content array
			inputText.className = "form-control";
			//function on content, checking if it is valid content.
			inputText.onkeypress = function (event){
				var $reg = new RegExp("^[a-z0-9_.-]*$"); //only accept small letters, numbers and the symbols: . - _
			    var $key = String.fromCharCode(event.which);    
			    if ($reg.test($key)) {
			        return true;
			    }
			    return false;
			};
			
			var span = document.createElement("span");
			span.className = "input-group-btn";
			
			//Button for deleting lines in create manual source
			var inputBtn = document.createElement("input");
			inputBtn.className = "btn btn-danger customButton";
			inputBtn.type = "button";
			inputBtn.value = "Delete line";
			inputBtn.style = "float:right";
			inputBtn.onclick = function(){
				fields.removeChild(div);
			}
			
			var h3 = document.createElement("h3");
			h3.appendChild(inputBtn);
			span.appendChild(h3);
			div.appendChild(inputText);
			div.appendChild(span);
			
			var fields = document.getElementById("fields");
			fields.appendChild(div);
		}		
}
