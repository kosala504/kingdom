    
    window.onload = hideErrorMessages();

     
    document.addEventListener('keydown', function (event) {
      if (event.keyCode === 13 && event.target.nodeName === 'INPUT') {
        var form = event.target.form;
        var index = Array.prototype.indexOf.call(form, event.target);
        form.elements[index + 1].focus();
        event.preventDefault();
      }
    });

    $(document).ready( function () {

        //$('#dataTables-user-log').DataTable();
        $('#dataTables-supplier-list').DataTable({
            "bFilter": true,
            "paging":   false,
            //"iDisplayLength": 20,
            "order": [[ 0, "asc" ]]
            //"bDestroy": true,
        });

        //CSV Import
            $('#import_csv').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:$("#base-url").val()+"Transactions/import/",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    $('#import_csv_btn').html('Importing...');
                },
                success:function(data)
                {
                    var data = $.parseJSON(data);
                    if(data.status=='success'){
                        location.reload();
                    }
                    else{
                        alert("Oops there is something wrong!");
                    }
                },
                error: ajax_error_handling
            })
        });

     } );

    $(document).ready(function() {
      $('#js-example-basic-single').select2({
      dropdownParent: $("#addTransaction")
      });
    });

    $(document).ready(function() {
      $('#edit-sup').select2({
      dropdownParent: $("#editTransaction")
      });
    });

    function getAmount(){
        var t_qty = $('#g_qty').val();
        var grn_tea = $('#grn_tea').val();
        $('#grn_tot').val(t_qty*grn_tea);

        var ad_in = $('#ad_in').val();
        $('#ad_tot').val(ad_in);

        var cash_adv = $('#cs_ad').val();
        $('#cs_tot').val(cash_adv);

        var welfare = $('#welfare').val();
        $('#wel_tot').val(welfare);

        $('#trans_qty').val(t_qty);
        var tran_tea = $('#trans').val();
        $('#trans_tot').val(t_qty*tran_tea);

        var man_qty = $('#man_qty').val();
        var manure = $('#manure').val();
        $('#man_tot').val(man_qty*manure);

        var mt_qty = $('#mt_qty').val();
        var mt = $('#mt').val();
        $('#mt_tot').val(mt_qty*mt);

        var kok = $('#kok').val();
        $('#kok_tot').val(kok);

        var othr = $('#othr').val();
        $('#othr_tot').val(othr);

        var t_tot  = parseFloat($('#grn_tot').val());
        var a_tot = parseFloat($('#ad_tot').val());
        g_tot = t_tot+a_tot;
        $('#gross_tot').val(g_tot);

        var c_tot  = parseFloat($('#cs_tot').val());
        var wl_tot  = parseFloat($('#wel_tot').val());
        var tr_tot  = parseFloat($('#trans_tot').val());
        var mn_tot  = parseFloat($('#man_tot').val());
        var mdt_tot  = parseFloat($('#mt_tot').val());
        var k_tot  = parseFloat($('#kok_tot').val());
        var o_tot  = parseFloat($('#othr_tot').val());
        ded_tot = c_tot+wl_tot+tr_tot+mn_tot+mdt_tot+k_tot+o_tot;
        $('#did_tot').val(ded_tot);

        var gross_tot  = parseFloat($('#gross_tot').val());
        var deduc_tot = parseFloat($('#did_tot').val());
        var net = gross_tot-deduc_tot;
        $('#net_pay').val(net);
    }

    function getAmountEdit(){
        var t_qty = $('#edit-g_qty').val();
        var grn_tea = $('#edit-grn_tea').val();
        $('#edit-grn_tot').val(t_qty*grn_tea);

        var ad_in = $('#edit-ad_in').val();
        $('#edit-ad_tot').val(ad_in);

        var cash_adv = $('#edit-cs_ad').val();
        $('#edit-cs_tot').val(cash_adv);

        var welfare = $('#edit-welfare').val();
        $('#edit-wel_tot').val(welfare);

        $('#edit-trans_qty').val(t_qty);
        var tran_tea = $('#edit-trans').val();
        $('#edit-trans_tot').val(t_qty*tran_tea);

        var man_qty = $('#edit-man_qty').val();
        var manure = $('#edit-manure').val();
        $('#edit-man_tot').val(man_qty*manure);

        var mt_qty = $('#edit-mt_qty').val();
        var mt = $('#edit-mt').val();
        $('#edit-mt_tot').val(mt_qty*mt);

        var kok = $('#edit-kok').val();
        $('#edit-kok_tot').val(kok);

        var othr = $('#edit-othr').val();
        $('#edit-othr_tot').val(othr);

        var t_tot  = parseFloat($('#edit-grn_tot').val());
        var a_tot = parseFloat($('#edit-ad_tot').val());
        g_tot = t_tot+a_tot;
        $('#edit-gross_tot').val(g_tot);

        var c_tot  = parseFloat($('#edit-cs_tot').val());
        var wl_tot  = parseFloat($('#edit-wel_tot').val());
        var tr_tot  = parseFloat($('#edit-trans_tot').val());
        var mn_tot  = parseFloat($('#edit-man_tot').val());
        var mdt_tot  = parseFloat($('#edit-mt_tot').val());
        var k_tot  = parseFloat($('#edit-kok_tot').val());
        var o_tot  = parseFloat($('#edit-othr_tot').val());
        ded_tot = c_tot+wl_tot+tr_tot+mn_tot+mdt_tot+k_tot+o_tot;
        $('#edit-did_tot').val(ded_tot);

        var gross_tot  = parseFloat($('#edit-gross_tot').val());
        var deduc_tot = parseFloat($('#edit-did_tot').val());
        var net = gross_tot-deduc_tot;
        $('#edit-net_pay').val(net);
    }

    function hideErrorMessages(){
        $("#error_id").hide();
        $("#error_date").hide();
        $("#error_no_data").hide();
        $("#edit-error_id").hide();
        $("#edit-error_date").hide();
        $("#edit-error_no_data").hide();
        hide_loading();
    }

    function edit_transaction_popup(trans_id,sup_id,sup_name,trans_date,tea_kg,tea_price,ad_income,cash_adv,welfare,transport,manure_kg,manure,made_kg,made_tea,kok_product,other_ded,ex,net){
        $("#edit-sup").select2("val",[sup_id]);
        $("#edit-transfer_date").val(trans_date);
        parseFloat($('#edit-g_qty').val(tea_kg));
        parseFloat($('#edit-grn_tot').val(tea_price));
        parseFloat($('#edit-ad_in').val(ad_income));
        parseFloat($('#edit-ad_tot').val(ad_income));
        parseFloat($('#edit-cs_ad').val(cash_adv));
        parseFloat($('#edit-cs_tot').val(cash_adv));
        parseFloat($('#edit-welfare').val(welfare));
        parseFloat($('#edit-wel_tot').val(welfare));
        parseFloat($('#edit-trans_tot').val(transport));
        parseFloat($('#edit-trans_qty').val(tea_kg));
        parseFloat($('#edit-man_qty').val(manure_kg));
        parseFloat($('#edit-manure').val(manure));
        parseFloat($('#edit-mt_qty').val(made_kg));
        parseFloat($('#edit-mt').val(made_tea));
        parseFloat($('#edit-kok').val(kok_product));
        parseFloat($('#edit-kok_tot').val(kok_product));
        parseFloat($('#edit-othr').val(other_ded));
        parseFloat($('#edit-othr_tot').val(other_ded));
        var t_tot  = parseFloat($('#edit-grn_tot').val());
        var a_tot = parseFloat($('#edit-ad_tot').val());
        g_tot = t_tot+a_tot;
        $('#edit-gross_tot').val(g_tot);

        var man_kg=parseFloat($('#edit-man_qty').val());
        var man = parseFloat($('#edit-manure').val());
        $('#edit-man_tot').val(man_kg*man);

        var mt_qty=parseFloat($('#edit-mt_qty').val());
        var mt = parseFloat($('#edit-mt').val());
        $('#edit-mt_tot').val(mt_qty*mt);


        parseFloat($('#edit-did_tot').val(ex));
        parseFloat($('#edit-net_pay').val(net));
        $('#editTransactionSubmit').attr("onclick","update_transaction("+trans_id+")");
    }

    function deactivate_confirmation(trans_id){
        $( "#trans_id" ).html(trans_id);
        $('#deactivateYesButton').attr("onclick","deactivate_submit("+trans_id+")");
    }

    function deactivate_submit(trans_id){
        show_loading();
            $.ajax({
                url: $("#base-url").val()+"Transactions/delete_transaction/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {trans_id:trans_id},
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

    function update_transaction(trans_id){
        hideErrorMessages();
        show_loading();
        var i=0;
        var sup_id = $("#edit-sup").val();
        var trans_date = $("#edit-transfer_date").val();
        var t_qty = parseFloat($('#edit-g_qty').val());
        var t_tot  = parseFloat($('#edit-grn_tot').val());
        var a_tot = parseFloat($('#edit-ad_in').val());
        var w_tot = parseFloat($('#edit-welfare').val());
        var c_tot  = parseFloat($('#edit-cs_ad').val());
        var tr_tot  = parseFloat($('#edit-trans_tot').val());
        var man_qty = parseFloat($('#edit-man_qty').val());
        var mn_tot  = parseFloat($('#edit-man_tot').val());
        var mt_qty  = parseFloat($('#edit-mt_qty').val());
        var mdt_tot  = parseFloat($('#edit-mt_tot').val());
        var k_tot  = parseFloat($('#edit-kok_tot').val());
        var o_tot  = parseFloat($('#edit-othr_tot').val());
        var net = parseFloat($('#edit-net_pay').val());
        if(sup_id == 0){
            $("#edit-error_id").show();
            i++;
        }
        if(trans_date == ""){
            $("#edit-error_date").show();
            i++;
        }
        if(net == 0){
            $("#edit-error_no_data").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"Transactions/update_transaction/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {trans_id:trans_id,sup_id:sup_id,trans_date:trans_date,t_qty:t_qty,t_tot:t_tot,a_tot:a_tot,c_tot,c_tot:c_tot,w_tot:w_tot,tr_tot:tr_tot,man_qty:man_qty,mn_tot:mn_tot,mt_qty:mt_qty,mdt_tot:mdt_tot,k_tot:k_tot,o_tot:o_tot},
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
          
    }


    $( "#newTransactionSubmit" ).click(function() {
        hideErrorMessages();
        show_loading();
        var i=0;
        var sup_id = $("#js-example-basic-single").val();
        var trans_date = $("#transfer_date").val();
        var t_qty = parseFloat($('#g_qty').val());
        var t_tot  = parseFloat($('#grn_tot').val());
        var a_tot = parseFloat($('#ad_in').val());
        var c_tot  = parseFloat($('#cs_ad').val());
        var w_tot  = parseFloat($('#welfare').val());
        var tr_tot  = parseFloat($('#trans_tot').val());
        var man_qty = parseFloat($('#man_qty').val());
        var mn_tot  = parseFloat($('#man_tot').val());
        var mt_qty  = parseFloat($('#mt_qty').val());
        var mdt_tot  = parseFloat($('#mt_tot').val());
        var k_tot  = parseFloat($('#kok_tot').val());
        var o_tot  = parseFloat($('#othr_tot').val());
        var net = parseFloat($('#net_pay').val());

        if(sup_id == 0){
            $("#error_id").show();
            i++;
        }
        if(trans_date == ""){
            $("#error_date").show();
            i++;
        }
        if(net == 0){
            $("#error_no_data").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val() + "Transactions/add_transaction/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {sup_id:sup_id,trans_date:trans_date,t_qty:t_qty,t_tot:t_tot,a_tot:a_tot,c_tot,c_tot:c_tot,w_tot:w_tot,tr_tot:tr_tot,man_qty:man_qty,mn_tot:mn_tot,mt_qty:mt_qty,mdt_tot:mdt_tot,k_tot:k_tot,o_tot:o_tot},
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


