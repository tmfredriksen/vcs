/**
 * Javascript for swatch and swatch controller
 * 
 * 
 * @author Tommy Langhelle, Tord-Marius Fredriksen, Eivind Skreddernes
 * 
 */

var createSwatch = {

	/**
	 * enables tab in file content. beeing used in create swatch.
	 */
	enableTab : function(e, value) {
		if (e.keyCode === 9) { // tab was pressed
			// get caret position/selection
			var start = value.selectionStart;
			end = value.selectionEnd;

			var $this = $(value);

			// set textarea value to: text before caret + tab + text after caret
			$this.val($this.val().substring(0, start) + "\t"
					+ $this.val().substring(end));

			// put caret at right position again
			value.selectionStart = value.selectionEnd = start + 1;

			// prevent the focus lose
			return false;
		}
	},
	/**
	 * Simple method that moves text from the testline to file content, if the testline is valid.
	 * It is beeing used in create swatch.
	 */
	moveText : function() {
		//text from input(test expressions)
		var input = $("#testLine").val();
		var content = $("#contentText").val();
		var codeComment = $("#codeComment").val();
		//check if it is empty
		if ($.trim(input) != '') {

			//moves the text to content textarea
			if ($.trim(content) == '' && $.trim(codeComment) == '') {
				$("#contentText").val(input);
				//clear input in test expressions
				$("#testLine").val("");
				//clear message
				$(".regex").html("");
				//hides the button(btnOk)
				$("#btnTest").hide();
				return false;
			} else {
				$("#contentText").val(
						content + "\n" + "#" + codeComment + "\n" + input);

				//clear input in test expressions
				$("#testLine").val("");
				//clear message
				$(".regex").html("");
				//hides the button(btnOk)
				$("#btnTest").hide();
			}
		}
	},
	/**
	 * Method for testing two input fields mathc each other in swatch create. You write regex in the one field and write what
	 * you will test in the another input field.
	 * 
	 * @return true or false
	 */
	testCommand : function() {
		//input regex
		var input = $("#inputTest").val();
		//input testline
		var test = $("#testLine").val();

		if ($.trim(input) != '') {
			//creates regex expression by input
			var reg = new RegExp(input);
			$(".regex").show();
			if ($.trim(test) != '') {
				//checks if the expression match(true or false)
				if (reg.test(test)) {
					$(".regex")
							.html(
									"<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Match! press ok to move to content");
					//displays btnOK that triggers the MoveText event
					$("#btnTest").show();
				} else {
					$(".regex")
							.html(
									"<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> No Match!");
					//hides the button(btnOk)
					$("#btnTest").hide();
				}
			} else {
				$(".regex")
						.html(
								"<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Empty test field!");
			}
		} else {
			$(".regex").show();
			$(".regex")
					.html(
							"<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>  Please type in your test expression!");
			//hides the button(btnOk)
			$("#btnTest").hide();
		}
	}
}
