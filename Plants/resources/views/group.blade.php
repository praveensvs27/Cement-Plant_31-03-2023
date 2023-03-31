@extends('layout/main_page')
@section('page_title','Group')
@section('main_content')
<div class="container-fluid">
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-md-0">
			<div class="welcome-text">
				<h4><button type="button" onclick="add_group();" class="btn btn-light"><img src="assets/image/pen.png" width="35" height="35"></button>&nbsp;&nbsp;Group</h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="main_table" class="display" style="min-width: 845px;color:black;">
							<thead>
								<tr>
									<th style="width:100px;">Sno</th>
									<th>Group Name</th>
									<th>Status</th>
									<th style="width:90px;">Action</th>
								</tr>
							</thead>
							<tbody id="main_table_content">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('modal_content')
<form id="modal-form" autocomplete="off" action="javascript:submit_btn(Group_Id.value,Group.value,Status.value);">
<div class="modal-header">
	<h5 class="modal-title" id="modal-title">Add New Group</h5>
	<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">
    <div id="msg_box" style="color:red;width:"></div>
    <input type="hidden" id="Group_Id" value="0"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-label">Group Name <span>*</span></label>
                    <input type="text" id="Group" class="form-control" placeholder="Group Name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-label">Status <span>*</span></label>
                    <select id="Status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-success" id="modal-submit-btn">SUBMIT</button>
	<button type="button" class="btn btn-success" data-dismiss="modal">CLOSE</button>
</div>
</form>
@endsection
@section('footer_content')
<script src="assets/js/page/group.js"></script>
@endsection
