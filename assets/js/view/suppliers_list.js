    
    window.onload = hideErrorMessages();

    function hideErrorMessages(){
        $("#error_id").hide();
        $("#error_id2").hide();
        $("#error_id3").hide();
        $("#error_id3").hide();
        $("#error_state").hide();
        $("#error_name").hide();
        $("#error_name2").hide();
        $("#error_last_name").hide();
        $("#error_last_name2").hide();
        $("#error_last_name2").hide();
        $("#error_nic").hide();
        $("#error_nic2").hide();
        $("#error_nic3").hide();
        $("#error_tel").hide();
        $("#error_tel2").hide();
        $("#error_email").hide();
        $("#error_email2").hide();
        $("#error_email3").hide();
        $("#error_address").hide();
        $("#error_acc_no").hide();
        $("#edit-error_id").hide();
        $("#edit-error_id2").hide();
        $("#edit-error_id3").hide();
        $("#edit-error_id3").hide();
        $("#edit-error_state").hide();
        $("#edit-error_name").hide();
        $("#edit-error_name2").hide();
        $("#edit-error_last_name").hide();
        $("#edit-error_last_name2").hide();
        $("#edit-error_last_name2").hide();
        $("#edit-error_nic").hide();
        $("#edit-error_nic2").hide();
        $("#edit-error_nic3").hide();
        $("#edit-error_tel").hide();
        $("#edit-error_tel2").hide();
        $("#edit-error_email").hide();
        $("#edit-error_email2").hide();
        $("#edit-error_email3").hide();
        $("#edit-error_address").hide();
        hide_loading();
    }

    $(document).ready( function () {

        //$('#dataTables-user-log').DataTable();
        $('#dataTables-supplier-list').DataTable({
            "bFilter": true,
            "paging":   false,
            //"iDisplayLength": 20,
            "order": [[ 0, "asc" ]]
            //"bDestroy": true,
        });
    });    

    function edit_supplier_popup(sup_id,state,f_name,l_name,nic,address,tel,email,bank,branch,holder,acc_no){
        $("#edit-sup_id").val(sup_id);
        $("#edit-state").val(state);
        $("#edit-f_name").val(f_name);
        $("#edit-l_name").val(l_name);
        $("#edit-nic").val(nic);
        $("#edit-address").val(address);
        $("#edit-tel").val(tel);
        $("#edit-email").val(email);
        $("#edit-bank").val(bank);
        $("#edit-branch").val(branch);
        $("#edit-holder").val(holder);
        $("#edit-acc_no").val(acc_no);
        $('#editSupplierSubmit').attr("onclick","update_supplier_details("+sup_id+")");
    }

    function deactivate_confirmation(l_name,sup_id){
        $( "#sup_name" ).html(l_name);
        $('#deactivateYesButton').attr("onclick","deactivate_submit('"+l_name+"',"+sup_id+")");
    }

    function deactivate_submit(l_name,sup_id){
        show_loading();
            $.ajax({
                url: $("#base-url").val()+"Suppliers/delete_supplier/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {l_name: l_name, sup_id:sup_id},
                success: function (result) {
                    var result = $.parseJSON(result);
                    if(result.status=='success'){
                        location.reload();
                    }
                    else{
                        alert("Oops there is something wrong!");
                    }
                },
                error: ajax_error_handling
            });
    }

    function update_supplier_details(sup_id){
        hideErrorMessages();
        show_loading();
        var i=0;
        var state = $("#edit-state").val();
        var f_name = $("#edit-f_name").val().trim();
        var l_name = $("#edit-l_name").val().trim();
        var nic = $("#edit-nic").val().trim();
        var tel = $("#edit-tel").val().trim();
        var email = $("#edit-email").val().trim();
        var address = $("#edit-address").val().trim();
        var bank = $("#edit-bank").val().trim();
        var branch = $("#edit-branch").val().trim();
        var holder = $("#edit-holder").val().trim();
        var acc_no = $("#edit-acc_no").val().trim();
        if(state == 0){
            $("#edit-error_state").show();
            i++;
        }
        if(f_name == ""){
            $("#edit-error_name").show();
            i++;
        }
        if(l_name == ""){
            $("#edit-error_last_name").show();
            i++;
        }
        if(nic == ""){
            $("#edit-error_nic").show();
            i++;
        }
        if(tel == ""){
            $("#edit-error_tel").show();
            i++;
        }
        else if ((tel).length!=10){
            $("#edit-error_tel2").show();
            i++;
        }
        /*if (!email.match(/^[\w -._]+@[\-0-9a-zA-Z_.]+?\.[a-zA-Z]{2,3}$/)) {
            $("#edit-error_email3").show();
            i++;
        }*/
        if(address == ""){
            $("#edit-error_address").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"Suppliers/update_supplier_details/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {sup_id: sup_id, state:state, f_name:f_name, l_name:l_name, nic:nic, tel:tel, email:email, address:address, bank:bank, branch:branch, holder:holder, acc_no:acc_no},
                success: function (result) {
                    var result = $.parseJSON(result);
                    if(result.status=='success'){
                        location.reload();
                    }
                    else if(result.status=='exist'){
                        $("#edit-error_email2").show();
                        hide_loading();
                    }
                    else if(result.status=='exist_nic'){
                        $("#edit-error_nic3").show();
                        hide_loading();
                    }
                    else{
                        alert("Oops there is something wrong!");
                    }
                },
                error: ajax_error_handling
            });
        }else{
            hide_loading();
        }
          
    }


    $( "#newSupplierSubmit" ).click(function() {
        hideErrorMessages();
        show_loading();
        var i=0;
        var sup_id = $("#sup_id").val().trim();
        var state = $("#state").val().trim();
        var f_name = $("#f_name").val().trim();
        var l_name = $("#l_name").val().trim();
        var nic = $("#nic").val().trim();
        var tel = $("#tel").val().trim();
        var email = $("#email").val().trim();
        var address = $("#address").val().trim();
        var bank = $("#bank").val().trim();
        var branch = $("#branch").val().trim();
        var holder = $("#holder").val().trim();
        var acc_no = $("#acc_no").val().trim();
        
        if(sup_id == ""){
            $("#error_id").show();
            i++;
        }
        if(state == 0){
            $("#error_state").show();
            i++;
        }
        if(f_name == ""){
            $("#error_name").show();
            i++;
        }
        if(l_name == ""){
            $("#error_last_name").show();
            i++;
        }
        if(nic == ""){
            $("#error_nic").show();
            i++;
        }
        if(tel == ""){
            $("#error_tel").show();
            i++;
        }
        else if ((tel).length!=10){
            $("#error_tel2").show();
            i++;
        }
        /*if(!email == ""){
            $("#error_email").show();
            i++;
        }
        else if (!email.match(/^[\w -._]+@[\-0-9a-zA-Z_.]+?\.[a-zA-Z]{2,3}$/)) {
            $("#error_email3").show();
            i++;
        }*/
        if(address == ""){
            $("#error_address").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val() + "Suppliers/add_supplier/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {sup_id: sup_id, state:state, f_name:f_name, l_name:l_name, nic:nic, tel:tel, email:email, address:address, bank:bank, branch:branch, holder:holder, acc_no:acc_no},
                success: function (result) {
                    var result = $.parseJSON(result);
                    if(result.status=='success'){
                        location.reload();
                    }
                    else if(result.status=='exist'){
                        $("#error_id3").show();
                        hide_loading();
                    }
                    else if(result.status=='exist_email'){
                        $("#error_email2").show();
                        hide_loading();
                    }
                    else if(result.status=='exist_nic'){
                        $("#error_nic3").show();
                        hide_loading();
                    }
                    else{
                        alert("Oops there is something wrong!");
                    }
                  
                },
                error: ajax_error_handling
            });
        }else{
            hide_loading();
        }
            
    });


