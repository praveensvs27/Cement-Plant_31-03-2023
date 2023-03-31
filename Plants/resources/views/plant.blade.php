@extends('layout/main_page')
@section('page_title','Plant')
@section('main_content')
<div class="container-fluid">
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-md-0">
			<div class="welcome-text">
				<h4><button type="button" onclick="add_plant();" class="btn btn-light"><img src="assets/image/pen.png" width="35" height="35"></button>&nbsp;&nbsp;Plant</h4>
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
									<th>Plant Type</th>
									<th>Plant Name</th>
									<th>Company Name</th>
									<th>Latitude</th>
									<th>Longitude</th>
									<th>City</th>
									<th>State</th>
									<th>Address</th>
									<th>Contact Person name</th>
									<th>Contact Phone number</th>
									<th>Contact Email</th>
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
<form id="modal-form" autocomplete="off" action="javascript:submit_btn(Plant_Id.value,Plant_Type_Id.value,Plant.value,Company_Id.value,Latitude.value,Longitude.value,City.value,State_Id.value,Contact_Person_name.value,Contact_Phone_number.value,Contact_Email.value,Address.value,Status.value);">
<div class="modal-header">
	<h5 class="modal-title" id="modal-title">Add New Plant</h5>
	<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">
    <div id="msg_box" style="color:red;width:100%;"></div>
    <input type="hidden" id="Plant_Id" value="0"/>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Plant Type <span>*</span></label>
					<select id="Plant_Type_Id" class="form-control" required><option value="">Select</option>
                        <?php for($i=0;$i<count($plant_types);$i++){echo "<option value='".$plant_types[$i]['id']."'>".$plant_types[$i]['plant_type']."</option>";} ?>
                    </select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Plant Name <span>*</span></label>
					<input type="text" id="Plant" class="form-control" placeholder="Plant" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Company <span>*</span></label>
					<select id="Company_Id" class="form-control" required><option value="">Select</option>
                        <?php for($i=0;$i<count($companys);$i++){echo "<option value='".$companys[$i]['id']."'>".$companys[$i]['company']."</option>";} ?>
                    </select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">City <span>*</span></label>
					<input type="text" id="City" class="form-control" placeholder="City" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Latitude <span>*</span></label>
					<input type="text" id="Latitude" class="form-control" placeholder="Latitude" pattern="[0-9]{2}.[0-9]{6}" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Longitude <span>*</span></label>
					<input type="text" id="Longitude" class="form-control" placeholder="Longitude" pattern="[0-9]{2}.[0-9]{6}" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">State <span>*</span></label>
					<select id="State_Id" class="form-control" required><option value="">Select</option>
                        <?php for($i=0;$i<count($states);$i++){echo "<option value='".$states[$i]['state_id']."'>".$states[$i]['state_name']."</option>";} ?>
                    </select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Contact Person name</label>
					<input type="text" id="Contact_Person_name" class="form-control" placeholder="Contact Person name">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Contact Phone number</label>
					<input type="text" id="Contact_Phone_number" class="form-control" placeholder="Contact Phone number" pattern="[+]{0,1}[0-9]+">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Contact Email</label>
					<input type="email" id="Contact_Email" class="form-control" placeholder="Contact Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-label">Address</label>
					<textarea id="Address" class="form-control" placeholder="Address" rows="4"></textarea>
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
<script src="assets/js/page/plant.js"></script>
@endsection
