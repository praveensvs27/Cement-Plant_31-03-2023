@extends('layout/main_page')
@section('page_title','Plant Location')
@section('main_content')
<div class="container-fluid">
	<div class="row mb-3">
		<div class="col-md-9">
            <div id="map" style="width:100%;height: 420px;"></div>
			<div class="card">
				<div class="card-body">
                    <span id="site_name_select" style="color:black;font-weight:bold;">Choose Site Name</span>
                    <div class="table-responsive" id="main_table_div" style="width:100%;">
                        <table id="main_table" class="display" style="min-width: 845px;color:black;">
                            <thead>
                                <tr class="text-center">
                                    <th>Sno</th>
                                    <th>Group Name</th>
                                    <th>Company Name</th>
                                    <th>Facility Name</th>
                                    <th>City</th>
                                    <th>Location 1</th>
                                    <th>Location 2</th>
                                    <th>Location 3</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
for ($i=0;$i<count($plants);$i++)
{
    $data1=$plants[$i];
    $latitude=($data1["latitude"]!=""?floatval($data1["latitude"]):0);
    $longitude=($data1["longitude"]!=""?floatval($data1["longitude"]):0);
    echo "<tr class='plant_detail_tb_row'><td>".($i+1)."<input type='hidden' class='latitude' value='".$latitude."'/><input type='hidden' class='longitude' value='".$longitude."'/></td><td>".$data1["group"]."</td><td>".$data1["company"]."</td><td>".$data1["plant"]."</td><td>".$data1["city"]."</td><td class='route1'>NULL</td><td class='route2'>NULL</td><td class='route3'>NULL</td></tr>";
}
?>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
            <div class="form-group mb-0">
                <label class="text-label mb-0">Location</label>
                <input type="text" class="form-control" placeholder="Location">
            </div>
            <div class="form-group mb-0">
                <label class="text-label mb-0">Latitude</label>
                <input type="text" class="form-control" placeholder="Latitude">
            </div>
            <div class="form-group mb-1">
                <label class="text-label mb-0">Longitude</label>
                <input type="text" class="form-control" placeholder="Longitude">
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary" onclick="initMarkers([]);">Search</button>
            </div>
            <div class="form-group mb-0">
                <label class="text-label mb-0">Site List</label>
                <div style="background-color: #fff;color:black;border:1px solid #eaeaea;height:200px;overflow-y: scroll;">
                    <ul class="list-group">
<?php
    for ($i=0;$i<count($sites);$i++)
    {
        $data1=$sites[$i];$id=$data1["id"];
        $latitude=($data1["latitude"]!=""?floatval($data1["latitude"]):0);
        $longitude=($data1["longitude"]!=""?floatval($data1["longitude"]):0);
        echo "<li class='list-group-item p-0 px-1'><div class='custom-control custom-checkbox'><input class='custom-control-input site_checkbox_list' id='site_checkbox_list-".$id."' type='checkbox' onclick=\"set_Map_Location_Id(this,'".$data1["site_name"]."',".$latitude.",".$longitude.");\"><label class='cursor-pointer font-italic d-block custom-control-label' for='site_checkbox_list-".$id."'>".$data1["site_name"]."</label></div></li>";
    }
?>
                    </ul>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('footer_content')
<link rel="stylesheet" href="//cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJGUYUdhVOmp1DoDe640xRLCE7JjFZdMw" ></script>
<script src="assets/js/page/map1.js"></script>
<script>
(function($) {
    const plantdata = [];
    <?php
    for($i=0;$i<count($plants);$i++)
    {
        $data1=$plants[$i];
        $latitude=($data1["latitude"]!=""?floatval($data1["latitude"]):0);
        $longitude=($data1["longitude"]!=""?floatval($data1["longitude"]):0);
        echo "plantdata[".$i."]={\"position\":{\"lat\":".$latitude.",\"lng\":".$longitude."},\"label\":{\"color\":\"white\"},\"draggable\":false,\"msg\":\"<b style='color:black;'>Group name : ".$data1["group"]."<br>Company name : ".$data1["company"]."<br>Plant name : ".$data1["plant"]."</b>\"};";
    }
    ?>
    init_plantmarkers(plantdata);
})(jQuery);
</script>
@endsection
