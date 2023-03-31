function add_company(){
    $("#modal-form #modal-title").html("Add New Plant Type");
    $("#modal-form #Company_Id").val("0");
    $("#modal-form #Company").val("");
    $("#modal-form #Group_Id").val("");
    $("#modal-form #Status").val("1");
    $("#modal-form #modal-submit-btn").html("SUBMIT");
    $("#basicModal").modal("show");
}
function edit_company(Company_Id,Company,Group_Id,Status){
    $("#modal-form #modal-title").html("Update Plant Type");
    $("#modal-form #Company_Id").val(Company_Id);
    $("#modal-form #Company").val(Company);
    $("#modal-form #Group_Id").val(Group_Id);
    $("#modal-form #Status").val(Status=='1'?1:0);
    $("#modal-form #modal-submit-btn").html("UPDATE");
    $("#basicModal").modal("show");
}
function set_main_table_content()
{
    jQuery.ajax({type: "GET",url: "/Company-retrieve",
        success: function(data) {
            var tb_cont="";
            for (let i = 0; i < data.length; i++) {var data1=data[i];tb_cont+="<tr><td>"+(i+1)+"</td><td>"+data1["company"]+"</td><td>"+data1["group"]+"</td><td>"+(data1["status"]==1?"Active":"Inactive")+"</td><td style='text-align:center;'><button class='btn btn-success' onclick=\"edit_company('"+data1["id"]+"','"+data1["company"]+"','"+data1["group_id"]+"','"+data1["status"]+"');\"><i class='fa fa-pencil'></i></button>&nbsp;<button class='btn btn-danger' onclick='Delete_Confirm("+data1["id"]+");'><i class='fa fa-trash'></i></button></td></tr>";}
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
function submit_btn(Company_Id,Company,Group_Id,Status)
{
    var valu={Company_Id:Company_Id,Company:Company};
    jQuery.ajax({type: "GET",url: "/Company-count",data:valu,
        success: function(data) {
            var cnt=parseInt(data);
            if(cnt==0){
                if(Company_Id=="0")
                {
                    var valu={Company:Company,Group_Id:Group_Id,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Company-insert",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
                else
                {
                    var valu={Company_Id:Company_Id,Company:Company,Group_Id:Group_Id,Status:Status};
                    jQuery.ajax({type: "GET",url: "/Company-update",data:valu,
                        success: function(data) {$('#basicModal').modal('hide');set_main_table_content();}
                    });
                }
            }else{
                $('#msg_box').html("Company name already exist.");
            }
        }
    });
}
function Delete_Confirm(Company_Id)
{
    if(Company_Id!="")
    {
        Swal.fire({
            title: 'Do you want to Delete Cement Company?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            denyButtonText: 'Cancel',
            }).then((result) => {
                if(result["value"]){delete_btn(Company_Id);}
            }
        );
    }else{alert("Company not selected.");}
}
function delete_btn(Company_Id){
    var valu={Company_Id:Company_Id};
    jQuery.ajax({type: "GET",url: "/Company-delete",data:valu,
        success: function(data) {Swal.fire('Deleted successfully!', '', 'success');set_main_table_content();}
    });
}
