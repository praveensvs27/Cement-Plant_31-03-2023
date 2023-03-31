var directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();
function calculateRoutes(pierLocation)
{
    var plant_detail_tb_row=document.getElementsByClassName('plant_detail_tb_row');
    for (let i = 0; i < plant_detail_tb_row.length; i++)
    {
        var lat=parseFloat(plant_detail_tb_row[i].getElementsByClassName('latitude')[0].value);
        var lng=parseFloat(plant_detail_tb_row[i].getElementsByClassName('longitude')[0].value);
        var destinationLocation = new google.maps.LatLng(lat,lng);
        var request = {
            origin: pierLocation,
            destination: destinationLocation,
            travelMode: 'DRIVING',
            provideRouteAlternatives: true
        };
        directionsService.route(request, function(result, status) {
            var routes=["NULL","NULL","NULL"];
            if (status === 'OK')
            {
                directionsDisplay.setDirections(result);
                for (var x = 0; (x < result.routes.length)&&(x<3); x++) {
                    var route = result.routes[x];
                    for (var y = 0; y < route.legs.length; y++) {
                        routes[x]=route.legs[y].distance.text;
                    }
                }
            }
            plant_detail_tb_row[i].getElementsByClassName('route1')[0].innerHTML=routes[0];
            plant_detail_tb_row[i].getElementsByClassName('route2')[0].innerHTML=routes[1];
            plant_detail_tb_row[i].getElementsByClassName('route3')[0].innerHTML=routes[2];
        });
    }
}
let map, activeInfoWindow, plantmarkers=[],piermarkers=[];
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {center: {lat: 11.3410,lng: 77.7172,},zoom: 6.5});
}
function init_piermarkers(pierdata) {
    var plant_detail_tb_row=document.getElementsByClassName('plant_detail_tb_row');
    for (let i = 0; i < plant_detail_tb_row.length; i++)
    {
        var plant_detail_tb_row1=plant_detail_tb_row[i];
        plant_detail_tb_row1.getElementsByClassName('route1')[0].innerHTML="NULL";
        plant_detail_tb_row1.getElementsByClassName('route2')[0].innerHTML="NULL";
        plant_detail_tb_row1.getElementsByClassName('route3')[0].innerHTML="NULL";
    }
    for (let index = 0; index < pierdata.length; index++)
    {
        const markerData = pierdata[index];
        var pierLocation = new google.maps.LatLng(markerData.position.lat,markerData.position.lng);
        calculateRoutes(pierLocation);
        break;
    }
}
function init_plantmarkers(plantdata) {
    for (let i = 0; i < plantmarkers.length; i++) {plantmarkers[i].setMap(null);}plantmarkers = [];
    for (let index = 0; index < plantdata.length; index++) {
        const markerData = plantdata[index];
        const marker = new google.maps.Marker({
            position: markerData.position,
            label: markerData.label,
            draggable: markerData.draggable,
            map
        });
        plantmarkers.push(marker);
        const infowindow = new google.maps.InfoWindow({content: `${markerData.msg}`,});
        marker.addListener("click", (event) => {
            if(activeInfoWindow) {activeInfoWindow.close();}
            infowindow.open({anchor: marker,shouldFocus: false,map});
            activeInfoWindow = infowindow;
        });
    }
}
initMap();
function set_Map_Location_Id(chbox,site_name,latitude,longitude)
{
    const site_checkbox_list = document.getElementsByClassName("site_checkbox_list");
    for (let i = 0; i < site_checkbox_list.length; i++) {
        if((site_checkbox_list[i].id!=chbox.id)?(site_checkbox_list[i].checked):false)
        {site_checkbox_list[i].checked=false;break;}
    }
    const pierdata = [];
    if((chbox.checked)?((latitude!=0)&&(longitude!=0)):false)
    {pierdata[0]={"position":{"lat":latitude,"lng":longitude},"label":{"text":"A","color":"white"},"draggable":false,"msg":"<b style='color:black;'>Site name : "+site_name+"</b>"};}
    if(chbox.checked)
    {$("#site_name_select").html("From "+site_name);$('#main_table_div').show();}
    else
    {$("#site_name_select").html("Choose Site Name");$('#main_table_div').hide();}
    init_piermarkers(pierdata);
}
(function($) {
    var table = $('#main_table').DataTable({
        "ordering": false,
        "dom": 'lBfrtip',
        "buttons": ['excel', 'print']/* ,
        "lengthMenu": [
            [10, 25, 50,100, -1],
            [10, 25, 50,100, 'All'],
        ] */
    });
    $('#main_table_div').hide();
})(jQuery);
