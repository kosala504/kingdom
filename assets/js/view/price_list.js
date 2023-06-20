    
    window.onload = hideErrorMessages();

    function hideErrorMessages(){
        $("#edit-error_price").hide();
        $("#edit-error_price2").hide();
        $("#error_month").hide();
        $("#error_year").hide();
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

    function edit_price_popup(price_id,amount,price_type){
        $( "#edit-price-id" ).val(price_id);
        $( "#p_type" ).html(price_type);
        $( "#edit-price" ).val(amount);
        $('#editPriceSubmit').attr("onclick","update_prices("+price_id+")");
    }

    function update_prices(price_id){
        hideErrorMessages();
        show_loading();
        var i=0;
        var price_type = $('#p_type').html();
        var amount = $('#edit-price').val().trim();
        var month = $('#month').val();
        var year = $('#year').val();

        if(amount == ""){
            $("#edit-error_price").show();
            hide_loading();
            i++;
        }
        else if (!amount.match(/[0-9]/)) {
            $("#edit-error_price2").show();
            hide_loading();
            i++;
        }
        if(month == 0){
            $("#error_month").show();
            hide_loading();
            i++;
        }
        if(year == 0){
            $("#error_year").show();
            hide_loading();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"prices/update_price/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {price_id:price_id, price_type:price_type, amount:amount, month:month, year:year},
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


