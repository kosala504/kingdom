    
    window.onload = hideErrorMessages();

    function hideErrorMessages(){
        $("#error_month").hide();
        $("#error_date").hide();
        hide_loading();
    }

    function print_bill(){
        var i=0;
        var month = $("#month").val();
        var bill_date = $("#billing_date").val();

        if(month == "0"){
            alert('Please select month');
            i++;
        }
        if(bill_date == ""){
            alert('Please select billing date');
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"Print_bill/get_bill_details/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {month:month},
                error: ajax_error_handling
            });
        }
    }


