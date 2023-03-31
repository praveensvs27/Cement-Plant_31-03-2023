function add_plant(){
    $("#modal-form #modal-title").html("Add New Plant");
    $("#modal-form #Plant_Id").val("0");
    $("#modal-form #Plant_Type_Id").val("");
    $("#modal-form #Plant").val("");
    $("#modal-form #Company_Id").val("");
    $("#modal-form #Latitude").val("");
    $("#modal-form #Longitude").val("");
    $("#modal-form #City").val("");
    $("#modal-form #State_Id").val("");
    $("#modal-form #Contact_Person_name").val("");
    $("#modal-form #Contact_Phone_number").val("");
    $("#modal-form #Contact_Email").val("");
    $("#modal-form #Address").val("");
    $("#modal-form #Status").val("1");
    $("#modal-form #modal-submit-btn").html("SUBMIT");
    $("#basicModal").modal("show");
}
function edit_plant(Plant_Id,Plant_Type_Id,Plant,Company_Id,Latitude,Longitude,City,State_Id,Contact_Person_name,Contact_Phone_number,Contact_Email,Address,Status){
    $("#modal-form #modal-title").html("Update Plant");
    $("#modal-form #Plant_Id").val(Plant_Id);
    $("#modal-form #Plant_Type_Id").select2("val", Plant_Type_Id);
    $("#modal-form #Plant").val(Plant);
    $("#modal-form #Company_Id").select2("val", Company_Id);
    $("#modal-form #Latitude").val(Latitude);
    $("#modal-form #Longitude").val(Longitude);
    $("#modal-form #City").val(City);
    $("#modal-form #State_Id").select2("val", State_Id);
    $("#modal-form #Contact_Person_name").val(Contact_Person_name);
    $("#modal-form #Contact_Phone_number").val(Contact_Phone_number);
    $("#modal-form #Contact_Email").val(Contact_Email);
    $("#modal-form #Address").val(Address);
    $("#modal-form #Status").val(Status=='1'?1:0);
    $("#modal-form #modal-submit-btn").html("UPDATE");
    $("#basicModal").modal("show");
}
function set_main_table_content()
{
    jQuery.ajax({type: "GET",url: "/Plant-retrieve",
        success: function(data) {
            var tb_cont="";
            for (let i = 0; i < data.length; i++) {
                var data1=data[i];
                tb_cont+="<tr><td>"+(i+1)+"</td><td>"+data1["plant_type"]+"</td><td>"+data1["plant"]+"</td><td>"+data1["company"]+"</td><td>"+data1["latitude"]+"</td><td>"+data1["longitude"]+"</td><td>"+data1["city"]+"</td><td>"+data1["state_name"]+"</td><td>"+data1["address"]+"</td><td>"+data1["contact_person_name"]+"</td><td>"+data1["contact_phone_no"]+"</td><td>"+data1["contact_email"]+"</td><td>"+(data1["status"]==1?"Active":"Inactive")+"</td><td style='text-align:center;'><button class='btn btn-success' onclick=\"edit_plant('"+data1["id"]+"','"+data1["plant_type_id"]+"','"+data1["plant"]+"','"+data1["company_id"]+"','"+data1["latitude"]+"','"+data1["longitude"]+"','"+data1["city"]+"','"+data1["state_id"]+"','"+data1["contact_person_name"]+"','"+data1["contact_phone_no"]+"','"+data1["contact_email"]+"','"+data1["address"]+"','"+data1["status"]+"');\"><i class='fa fa-pencil'></i></button>&nbsp;<button class='btn btn-danger' onclick='Delete_Confirm("+data1["id"]+");'><i class='fa fa-trash'></i></button></td></tr>";
            }
            $('#main_table').DataTable().destroy();
            $("#main_table_content").html(tb_cont);
            $('#main_table').DataTable().draw();
        }
    });
}
(function($) {
    var table = $('#main_table').DataTable({
        "ordering": false
    });
    $("#modal-form #Plant_Type_Id").select2();
    $("#modal-form #Company_Id").select2();
    $("#modal-form #State_Id").select2();
    set_main_table_content();
})(jQuery);
function submit_btn(Plant_Id,Plant_Type_Id,Plant,Company_Id,Latitude,Longitude,City,State_Id,Contact_Person_name,Contact_Phone_number,Contact_Email,Address,Status)
{
    var valu={Plant:Plant,Plant_Id:Plant_Id};
    jQuery.ajax({type: "GET",url: "/Plant-count",data:valu,
        success: function(data) {
            var cnt=parseInt(data);
            if(cnt==0){
                if(Plant_Id=="0")
                {
                    var valu={Plant_Type_Id:Plant_Type_Id,Plant:Plant,Company_Id:Company_Id,Latitude:Latitude,Longitude:Longitude,City:City,State_Id:State_Id,Contact_Person_name:Contact_Person_name,Contact_Phone_number:Contact_Phone_number,Contact_Email:Contact_Email,Address:Address,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Plant-insert",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
                else
                {
                    var valu={Plant_Id:Plant_Id,Plant_Type_Id:Plant_Type_Id,Plant:Plant,Company_Id:Company_Id,Latitude:Latitude,Longitude:Longitude,City:City,State_Id:State_Id,Contact_Person_name:Contact_Person_name,Contact_Phone_number:Contact_Phone_number,Contact_Email:Contact_Email,Address:Address,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Plant-update",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
            }else{
                $('#msg_box').html("Plant name already exist.");
            }
        }
    });
}
function Delete_Confirm(Plant_Id)
{
    if(Plant_Id!="")
    {
        Swal.fire({
            title: 'Do you want to Delete Plant?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            denyButtonText: 'Cancel',
            }).then((result) => {
                if(result["value"]){delete_btn(Plant_Id);}
            }
        );
    }else{alert("Plant not selected.");}
}
function delete_btn(Plant_Id){
    var valu={Plant_Id:Plant_Id};
    jQuery.ajax({type: "GET",url: "/Plant-delete",data:valu,
        success: function(data) {Swal.fire('Deleted successfully!', '', 'success');set_main_table_content();}
    });
}
