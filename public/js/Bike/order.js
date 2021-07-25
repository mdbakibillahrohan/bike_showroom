$(function(){


    $( function() {
        $.ajax({
            type: 'GET',
            url:'/bikesearch_ajax',
            success: function (data) {
                var availableTags = [];
                for(var k in data){
                    availableTags.push(data[k].id + " : "+data[k].name+ " : "+data[k].engine_no);
                }
                $( "#name_tags" ).autocomplete({
                    source: availableTags
                });
            }
        });

    }); // function


    $('.newtag').on('change', function () {
        $('#tagsname').html('You selected: ' + this.value);
    }).change();
    $('.newtag').on('autocompleteselect', function (e, ui) {
        $('#tagsname').html('You selected: ' + ui.item.value);
        var string =(ui.item.value);
        var arr = string.split(" : ");
        var bikeid = arr[0];
        var bikename = arr[1];
        var chassis_no = arr[2];

        $.ajax({
            type: 'GET',
            url:'/bikedetails_select/'+bikeid,
            success: function (data) {
                $('#engine_no').val(data.engine_no);
                $('#chassis_no').val(data.chassis_no);
                $('#bike_details').val(data.details);
                $('#bikeid').val(data.bike_id);
                $('#identityid').val(data.identity_id);
                $('#bike_sell_price').val(data.sell_price);
                $('#discount_val').val(data.discount_price);
                $('#pay_amount').val(data.sell_price);
                $('#cash_payment').val('');
                $('#due_amount').val('');
                $("#bikelast_sellamount").val(data.sell_price);
            }
        }); // end ajax
    }); // auto select form end


    $('#engine_no').on('change', function(){
        var engninno = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/bikedetails_selectengineno/'+engninno,
            success: function (data) {
                //console.log(data);
                $('#name_tags').val(data.name);
                $('#chassis_no').val(data.chassis_no);
                $('#bike_details').val(data.details);
                $('#bike_id_store').val(data.bike_id);
                $('#bike_sell_price').val(data.sell_price);
                $('#discount_val').val(data.discount_price);
                $('#cash_payment').val('');
                $('#due_amount').val('');
                $('#bikeid').val(data.bike_id);
                $('#identityid').val(data.identity_id);
                $("#bikelast_sellamount").val(data.sell_price);
            }
        });
    });

    $('#cash_payment').on('change',function (){
        var cashpayment = $(this).val();
        var pay_amount = $("#pay_amount").val();
        var lastdue = pay_amount - cashpayment;
        $("#due_amount").val(lastdue);

        var bikesell_type = $("#bikesell_type").val();
        if (bikesell_type =="Cash"){
            $('#bikesell_type').focus();
            $('#submut_btn').attr('disabled','disabled');
            $(this).prop("disabled",true);
            $(this).attr("disabled","disabled");
        }else{
            $( "#submut_btn" ).prop( "disabled", false );
            $(this).prop("disabled",false);
            $(this).attr("disabled",false);
        }
    });

    $('#bikesell_type').on('change',function () {
        var type = $(this).val();
        if(type == "Cash"){
            $('.sell_typeappend').empty().append('');
        }else if(type == "Onetime"){
            $( "#submut_btn" ).prop( "disabled", false );
            $('.sell_typeappend').empty().append('<div class="sell_typeappend">\n' +
                '                                            <div class="form-row">\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Onetime Payment Date :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input type="date" class="form-control form-control-rounded" name="ontimepay_date" id="" required>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Onetime Payment Date !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +


                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Guarantor Name :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="guarantorname" placeholder="Guarantor Name" autocomplete="off" />\n' +
                '                                                </div>\n' +
                '\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Guarantor Address :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="guarantor_address" placeholder="Guarantor Address" autocomplete="off" />\n' +
                '                                                </div>\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Guarantor Mobile :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="guarantor_mobile" placeholder="Guarantor Mobile" autocomplete="off" />\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>');
        }else if(type == "Installment"){
            $( "#submut_btn" ).prop( "disabled", false );
            $('.sell_typeappend').empty().append('<div class="sell_typeappend">\n' +
                '                                            <div class="form-row">\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Installment No : <span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="installmentno" id="installment_countno" placeholder="Installment No 6/12" required="required" autocomplete="off"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Installment No !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Installment Amount :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="installmentamount" id="installment_amount" placeholder="Installment Amount" value="" required="required" autocomplete="off" />\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Installment Amount !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Installment Payment Date :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input type="date" class="form-control form-control-rounded" name="installment_payment_date" value="" required>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Installment Payment Date : !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Guarantor Name :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="guarantorname" placeholder="Guarantor Name" autocomplete="off" />\n' +
                '                                                </div>\n' +
                '\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Guarantor Address :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="guarantor_address" placeholder="Guarantor Address" autocomplete="off" />\n' +
                '                                                </div>\n' +
                '                                                <div class="col-md-3 mb-3">\n' +
                '                                                    <label class="form-control-label">Guarantor Mobile :<span class="tx-danger"> *</span></label>\n' +
                '                                                    <input class="form-control form-control-rounded" type="text" name="guarantor_mobile" placeholder="Guarantor Mobile" autocomplete="off" />\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>');


            $('#installment_countno').on('change',function (){
                var installment_no = $(this).val();

                var due_amount = $("#Interest_include_due").val();
                var installment_amount = due_amount / installment_no;
                var intall_flot = (installment_amount.toFixed(2));
                $("#installment_amount").val(intall_flot);
                $("#installment_amount_post").val(intall_flot);
            });

        }else{
            $('.sell_typeappend').empty().append('');
        }
    });

    $('#payment_way').on('change',function () {
        var waytype = $(this).val();
       // alert(waytype)
        if (waytype == "Cash Payment") {

            $('.payment_way_append').empty().append('');

        }else if(waytype == "Bank"){
            $('.payment_way_append').empty().append('<div class="payment_way_append">\n' +
'                                                            <div class="row">\n' +
'                                                                <div class="col-md-12 mb-3">\n' +
'                                                                    <label class="form-control-label">Bank Details :<span class="tx-danger"> *</span></label>\n' +
'                                                                    <input class="form-control form-control-rounded" type="text" name="bankdetails" placeholder="Bank Name, Check no, Date" required="required" autocomplete="off" />\n' +
'                                                                    <div class="invalid-feedback">\n' +
'                                                                        Please provide a valid Bank Details !\n' +
'                                                                    </div>\n' +
'                                                                </div>\n' +
'                                                            </div>\n' +
'                                                        </div>');
        }else if(waytype == "Card"){
            $('.payment_way_append').empty().append('<div class="payment_way_append">\n' +
    '                                                            <div class="row">\n' +
    '                                                                <div class="col-md-12 mb-3">\n' +
    '                                                                    <label class="form-control-label">Card Details :<span class="tx-danger"> *</span></label>\n' +
    '                                                                    <input class="form-control form-control-rounded" type="text" name="carddetails" placeholder="Card No And Name" required="required" autocomplete="off"/>\n' +
    '                                                                    <div class="invalid-feedback">\n' +
    '                                                                        Please provide a valid Card Details !\n' +
    '                                                                    </div>\n' +
    '                                                                </div>\n' +
    '                                                            </div>\n' +
    '                                                        </div>');
        }else if(waytype == "Mobile"){
            $('.payment_way_append').empty().append('<div class="payment_way_append">\n' +
'                                                            <div class="row">\n' +
'                                                                <div class="col-md-12 mb-3">\n' +
'                                                                    <label class="form-control-label">Mobile Bank Details :<span class="tx-danger"> *</span></label>\n' +
'                                                                    <input class="form-control form-control-rounded" type="text" name="mobilebankdetails" placeholder="Getaway, Getaway No " required="required" autocomplete="off" />\n' +
'                                                                    <div class="invalid-feedback">\n' +
'                                                                        Please provide a valid Mobile Bank Details !\n' +
'                                                                    </div>\n' +
'                                                                </div>\n' +
'                                                            </div>\n' +
'                                                        </div>');
        }else{
            $('.payment_way_append').empty().append('');
        }


    });

    $('#registration_amount').on('change',function (){
        var registration_amount = $(this).val();
        var vat_payment = $("#vat_payment").val();
        var totalpayamount = parseFloat(vat_payment) + parseFloat(registration_amount);
        $("#total_payment").val(totalpayamount);
    });


    $('#payment_add').on('change',function (){
        var payment_add = $(this).val();
        var total_payment = $("#total_payment").val();
        var registration_due = total_payment - payment_add;
        $("#registration_due").val(registration_due);
    });

    $('#discount_val').on('change',function (){
        var discount_val = $(this).val();
        var bike_sell_price = $("#bike_sell_price").val();
        var paymentamount = bike_sell_price - discount_val;
        $("#pay_amount").val(paymentamount);
        $("#bikelast_sellamount").val(paymentamount);
    });

    $('#Interest_amount').on('change',function (){
        var interest = $(this).val();
        var due_amount = $("#due_amount").val();
        var lastduesamount = parseFloat(due_amount) + parseFloat(interest);
        $("#Interest_include_due").val(lastduesamount);
        $("#Interest_include_due_last").val(lastduesamount);
    });




    // $("#customer_image").click(function(){
    //     var check = $(this).prop('checked');
    //     if(check == true) {
    //         var stat = "1";
    //         $('#check_customer_image').val(stat);
    //     } else {
    //         var stat = "0";
    //         $('#check_customer_image').val(stat);
    //     }
    // });
    //
    // $("#National_ID").click(function(){
    //     var check = $(this).prop('checked');
    //     if(check == true) {
    //         var stat = "1";
    //         $('#checkNational_ID').val(stat);
    //     } else {
    //         var stat = "0";
    //         $('#checkNational_ID').val(stat);
    //     }
    // });
    //
    // $("#Driving_License").click(function(){
    //     var check = $(this).prop('checked');
    //     if(check == true) {
    //         var stat = "1";
    //         $('#checkDriving_License').val(stat);
    //     } else {
    //         var stat = "0";
    //         $('#checkDriving_License').val(stat);
    //     }
    // });
    // $("#address_verify").click(function(){
    //     var check = $(this).prop('checked');
    //     if(check == true) {
    //         var stat = "1";
    //         $('#addressverify_data').val(stat);
    //     } else {
    //         var stat = "0";
    //         $('#addressverify_data').val(stat);
    //     }
    // });




});
