<!-- Modal -->
	<div class="modal fade myModal" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Edit File</h4>
					<div hidden="true" id="alertEdit"
						class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
				<div class="modal-body">
					<h4>
						<span class="label label-info">Content</span>
					</h4>
					<textarea rows="20" style="resize: none" placeholder="File content"
						name="content_txt" hidden="true" id="contentText"
						class="form-control"></textarea>

					<div class="row">
						<div class="col-md-6">
							<h4>
								<span class="label label-info">Filename</span>
							</h4>
							<input class="form-control" disabled id="fileName"
								placeholder="Filename" />
						</div>
						<div class="col-md-6">
							<h4>
								<span class="label label-info">Path</span>
							</h4>
							<input class="form-control" disabled id="filePath"
								placeholder="Filepath" />
						</div>
						<div class="col-md-4">
							<h4>
								<span class="label label-info">Version</span>
							</h4>
							<input type="number" disabled aria-describedby="sizing-addon1"
								class="form-control" id="version" placeholder="Version" />
						</div>
						<div class="col-md-4">

							<h4>
								<span class="label label-info">FileID</span>
							</h4>
							<input type="number" disabled aria-describedby="sizing-addon1"
								class="form-control" id="fID" placeholder="FileID" />
						</div>
						<div class="clearfix"></div>
						<div class="col-md-8">
							<h4>
								<span class="label label-info">Comment</span>
							</h4>
							<textarea class="form-control cmt" hidden="true" style="resize: none"
								 id="comment" placeholder="Comment"></textarea>
						</div>
						<input type="hidden" id="filetype"/>
						<input type="hidden" id="editId" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-lg btn btn-default" data-dismiss="modal">Close</button>
						<input id="btnsaveEdit" type="submit" class="btn btn-lg btn btn-default btnsaveEdit"
							value="Save" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal for viewing file -->
	<div class="modal fade" id="myModalview" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Alerts</h4>
					<h4>
						<span class="label label-info">Filename</span>
					</h4>
					<input class="form-control" disabled id="viewDate"/>
					
				</div>
				<div class="modal-body">
					<h4>
						<span class="label label-info">Content</span>
					</h4>
					<textarea rows="20" disabled style="resize: none" placeholder="File content"
					 id="viewContent"
						class="form-control"></textarea>
				</div>
				<div class="modal-footer">
					<h3>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</h3>
				</div>
			</div>
		</div>
	</div>
	<script>
		$('.myModal').on('hidden.bs.modal', function() {
			var id = $("#fID").val();
			unlock(id);
		});
		//Fills the popup-modal with data
		$(".btnEdit").click(function(){
			index.fillModal(this);
			//Timer for editing (concurrancy control). 
			//User have 15 minutes of time for editing a file or user will be thrown out.
			//After 13 minutes user get a message about 2 minutes left
			setTimeout(function(){
				alert("You have 2 minutes left");
			}, 780000); //13 minutes, message about 2 minutes left
			setTimeout(function() {
				$('#myModal').modal('hide');
				var id = $("#fID").val();
				unlock(id);
				alert("Time has run out");
			}, 900000); //15 minutes of time for editing before you get kicked
		});

		$(".btnView").click(function(){
			view.fillModal(this);
		});
		$(".myModal").keydown(function (e){
			if (e.which == 116) {
			    return false; 
		   }
		});
		
	</script>