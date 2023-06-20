    
    window.onload = hideErrorMessages();

    function hideErrorMessages(){
        $("#error_date").hide();
        $("#error_amount").hide();
        $("#error_amount2").hide();
        $("#edit-error_date").hide();
        $("#edit-error_amount").hide();
        $("#edit-error_amount2").hide();
        hide_loading();
    }

    $(document).ready( function () {

        //$('#dataTables-user-log').DataTable();
        $('#dataTables-user-list').DataTable({
            "bFilter": true,
            "paging":   false,
            //"iDisplayLength": 20,
            "order": [[ 0, "asc" ]]
            //"bDestroy": true,
        });
     } );

    function edit_amount_popup(id,date,amount){
        $( "#edit-amount_id" ).val(id);
        $( "#edit-transfer_date" ).val(date);
        $( "#edit-amount" ).val(amount);
        $('#editAmountSubmit').attr("onclick","update_amount("+id+")");
    }

    $( "#addTeaSubmit" ).click(function() {
        hideErrorMessages();
        show_loading();
        var i=0;
        var date = $("#transfer_date").val();
        var amount = $("#amount").val().trim();
        
        if(date == ""){
            $("#error_date").show();
            i++;
        }
        if(amount == ""){
            $("#error_amount").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val() + "Daily_tea/add_amount/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {date: date, amount:amount},
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
        }else{
            hide_loading();
        }
            
    });

    function update_amount(id){
        hideErrorMessages();
        show_loading();
        var i=0;
        var date = $('#edit-transfer_date').val();
        var amount = $('#edit-amount').val().trim();

        if(date == ""){
            $("#edit-error_date").show();
            i++;
        }

        if(amount == ""){
            $("#edit-error_amount").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"Daily_tea/update_amount/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {id:id, date:date, amount:amount},
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
    }



