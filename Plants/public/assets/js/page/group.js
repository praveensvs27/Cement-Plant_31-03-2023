function add_group(){
    $("#modal-form #modal-title").html("Add New Group");
    $("#modal-form #Group_Id").val("0");
    $("#modal-form #Group").val("");
    $("#modal-form #Status").val("1");
    $("#modal-form #modal-submit-btn").html("SUBMIT");
    $("#basicModal").modal("show");
}
function edit_group(Group_Id,Group,Status){
    $("#modal-form #modal-title").html("Update Group");
    $("#modal-form #Group_Id").val(Group_Id);
    $("#modal-form #Group").val(Group);
    $("#modal-form #Status").val(Status=='1'?1:0);
    $("#modal-form #modal-submit-btn").html("UPDATE");
    $("#basicModal").modal("show");
}
function set_main_table_content()
{
    jQuery.ajax({type: "GET",url: "/Group-retrieve",
        success: function(data) {
            var tb_cont="";
            for (let i = 0; i < data.length; i++) {var data1=data[i];tb_cont+="<tr><td>"+(i+1)+"</td><td>"+data1["group"]+"</td><td>"+(data1["status"]==1?"Active":"Inactive")+"</td><td style='text-align:center;'><button class='btn btn-success' onclick=\"edit_group('"+data1["id"]+"','"+data1["group"]+"','"+data1["status"]+"');\"><i class='fa fa-pencil'></i></button>&nbsp;<button class='btn btn-danger' onclick='Delete_Confirm("+data1["id"]+");'><i class='fa fa-trash'></i></button></td></tr>";}
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
function submit_btn(Group_Id,Group,Status)
{
    var valu={Group_Id:Group_Id,Group:Group};
    jQuery.ajax({type: "GET",url: "/Group-count",data:valu,
        success: function(data) {
            var cnt=parseInt(data);
            if(cnt==0){
                if(Group_Id=="0")
                {
                    var valu={Group:Group,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Group-insert",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
                else
                {
                    var valu={Group_Id:Group_Id,Group:Group,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Group-update",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
            }else{
                $('#msg_box').html("Group name already exist.");
            }
        }
    });
}
function Delete_Confirm(Group_Id)
{
    if(Group_Id!="")
    {
        Swal.fire({
            title: 'Do you want to Delete Group?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            denyButtonText: 'Cancel',
            }).then((result) => {
                if(result["value"]){delete_btn(Group_Id);}
            }
        );
    }else{alert("Group not selected.");}
}
function delete_btn(Group_Id){
    var valu={Group_Id:Group_Id};
    jQuery.ajax({type: "GET",url: "/Group-delete",data:valu,
        success: function(data) {set_main_table_content();Swal.fire('Deleted successfully!', '', 'success');}
    });
}
