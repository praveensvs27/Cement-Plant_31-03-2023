function add_plant_type(){
    $("#modal-form #modal-title").html("Add New Plant Type");
    $("#modal-form #Plant_Type_Id").val("0");
    $("#modal-form #Plant_Type").val("");
    $("#modal-form #Status").val("1");
    $("#modal-form #modal-submit-btn").html("SUBMIT");
    $("#basicModal").modal("show");
}
function edit_plant_type(Plant_Type_Id,Plant_Type,Status){
    $("#modal-form #modal-title").html("Update Plant Type");
    $("#modal-form #Plant_Type_Id").val(Plant_Type_Id);
    $("#modal-form #Plant_Type").val(Plant_Type);
    $("#modal-form #Status").val(Status=='1'?1:0);
    $("#modal-form #modal-submit-btn").html("UPDATE");
    $("#basicModal").modal("show");
}
function set_main_table_content()
{
    jQuery.ajax({type: "GET",url: "/Plant_Type-retrieve",
        success: function(data) {
            var tb_cont="";
            for (let i = 0; i < data.length; i++) {var data1=data[i];tb_cont+="<tr><td>"+(i+1)+"</td><td>"+data1["plant_type"]+"</td><td>"+(data1["status"]==1?"Active":"Inactive")+"</td><td style='text-align:center;'><button class='btn btn-success' onclick=\"edit_plant_type('"+data1["id"]+"','"+data1["plant_type"]+"','"+data1["status"]+"');\"><i class='fa fa-pencil'></i></button>&nbsp;<button class='btn btn-danger' onclick='Delete_Confirm("+data1["id"]+");'><i class='fa fa-trash'></i></button></td></tr>";}
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
    set_main_table_content();
})(jQuery);
function submit_btn(Plant_Type_Id,Plant_Type,Status)
{
    var valu={Plant_Type_Id:Plant_Type_Id,Plant_Type:Plant_Type};
    jQuery.ajax({type: "GET",url: "/Plant_Type-count",data:valu,
        success: function(data) {
            var cnt=parseInt(data);
            if(cnt==0){
                if(Plant_Type_Id=="0")
                {
                    var valu={Plant_Type:Plant_Type,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Plant_Type-insert",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
                else
                {
                    var valu={Plant_Type_Id:Plant_Type_Id,Plant_Type:Plant_Type,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Plant_Type-update",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
            }else{
                $('#msg_box').html("Plant type already exist.");
            }
        }
    });
}
function Delete_Confirm(Plant_Type_Id)
{
    if(Plant_Type_Id!="")
    {
        Swal.fire({
            title: 'Do you want to Delete Plant Type?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            denyButtonText: 'Cancel',
            }).then((result) => {
                if(result["value"]){delete_btn(Plant_Type_Id);}
            }
        );
    }else{alert("Plant Type not selected.");}
}
function delete_btn(Plant_Type_Id){
    var valu={Plant_Type_Id:Plant_Type_Id};
    jQuery.ajax({type: "GET",url: "/Plant_Type-delete",data:valu,
        success: function(data) {Swal.fire('Deleted successfully!', '', 'success');set_main_table_content();}
    });
}
