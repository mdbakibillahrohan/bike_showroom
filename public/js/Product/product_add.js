$(function(){

    $('#categorydata_id').on('change', function(){
        var catid = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'categorydataid/'+catid,
            success: function (data) {
                //console.log(data);
                var select = '';
                if (data[0] != null){
                    select += '<option value="">Sub Category</option>';
                    $.each(data, function (index, obj) {
                        select += ('<option value="'+ obj.id +'">' + obj.subcategory_name + '</option>');
                    });
                }
                $('#subcategoryid').html(select);

            }
        });
    });


    $('#selltype_id').on('change',function () {
        var type = $(this).val();
        if(type == "Color"){
            $('.sell_type').empty().append('<div class="sell_type">\n' +
                '                                            <div class="form-row">\n' +
                '                                                <div class="col-md-4 mb-3">\n' +
                '                                                    <label for="symbol">Symbol</label>\n' +
                '                                                    <input class="form-control" type="text" name="Symbol" id="symbol" placeholder="Red, Black, Yellow" required="required"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Color !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>');
        }else if(type == "Size"){
            $('.sell_type').empty().append('<div class="form-row">\n' +
                '                                                <div class="col-md-4 mb-3">\n' +
                '                                                    <label for="symbol">Symbol</label>\n' +
                '                                                    <input class="form-control" type="text" name="Symbol" id="symbol" placeholder="32, 34, 36" required="required"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Size !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>');
        }else if(type == "Dozen"){
            $('.sell_type').empty().append('<div class="form-row">\n' +
                '                                                <div class="col-md-4 mb-3">\n' +
                '                                                    <label for="symbol">Symbol</label>\n' +
                '                                                    <input class="form-control" type="text" name="Symbol" id="symbol" placeholder="12 pic" required="required"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Dozen pic !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>');
        }else if(type == "Gram"){
            $('.sell_type').empty().append('<div class="form-row">\n' +
                '                                                <div class="col-md-4 mb-3">\n' +
                '                                                    <label for="symbol">Symbol</label>\n' +
                '                                                    <input class="form-control" type="text" name="Symbol" id="symbol" placeholder="100 Gram, 500 gram" required="required"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Gram Unit !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>');
        }else if(type == "ML"){
            $('.sell_type').empty().append('<div class="form-row">\n' +
                '                                                <div class="col-md-4 mb-3">\n' +
                '                                                    <label for="symbol">Symbol</label>\n' +
                '                                                    <input class="form-control" type="text" name="Symbol" id="symbol" placeholder="100 ML, 50 Ml" required="required"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Gram Unit !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>');
        }else if(type == "Pic"){
            $('.sell_type').empty().append('<div class="form-row">\n' +
                '                                                <div class="col-md-4 mb-3">\n' +
                '                                                    <label for="symbol">Symbol</label>\n' +
                '                                                    <input class="form-control" type="text" name="Symbol" id="symbol" placeholder="Any Symbol"/>\n' +
                '                                                    <div class="invalid-feedback">\n' +
                '                                                        Please provide a valid Gram Unit !\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>');
        }else{
            $('.sell_type').empty().append('');
        }
    })
});
