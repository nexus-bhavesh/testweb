$(document).ready(function () {

    var lastBoxOpened = 0;
    var dataId1 = $("#group1_in1").attr('data-id');
    var dataId2 = $("#group1_tv1").attr('data-id');
    var dataId3 = $("#group1_ph1").attr('data-id');
    var y_rdo_partner = $("#y_rdo_partner").attr('data-id');
    var n_rdo_partner = $("#group1_ph1").attr('data-id');
    // partner type
    var PdataId1 = $("#rdo_ptype_1").attr('data-id');
    var PdataId2 = $("#rdo_ptype_2").attr('data-id');
    var PdataId3 = $("#rdo_ptype_3").attr('data-id');
    var PdataId4 = $("#rdo_ptype_4").attr('data-id');

    var h_solvabiliteit = $("#h_solvabiliteit").val();    
    var h_liquiditeit = $("#h_liquiditeit").val();

    var data = {
        action: 'ffc_final_result',
        is_ajax: 1
    };
    $.post(ffc.ajaxurl, data, function (response) {
        /* Do Response Process */
        data = $.parseJSON(response);
          
        if(h_solvabiliteit == '' && h_liquiditeit == '') { 
            $('#p_notcompleted').html(data.sol_liq_wrong_notice); 
        } else if(h_solvabiliteit == '') {
            $('#p_notcompleted').html(data.sol_wrong_notice); 
        } else if(h_liquiditeit == ''){
            $('#p_notcompleted').html(data.liq_wrong_notice);
        }
               
    });


    // Start partner type selection
    if (y_rdo_partner == '1') {
        $('#y_rdo_partner').click();
        $("#div_box4_1").hide();        
        $("#div_box4").show();

        var h_solvabiliteitp = $("#h_solvabiliteitp").val();
        var h_liquiditeitp = $("#h_liquiditeitp").val();



        var data = {
        action: 'ffc_final_result',
        is_ajax: 1
    };
    $.post(ffc.ajaxurl, data, function (response) {
        /* Do Response Process */
        data = $.parseJSON(response);

         if(h_solvabiliteitp == '' && h_liquiditeitp == '') {
            $('#p_notcompleted').html(data.p_sol_liq_wrong_notice); 
        } else if(h_solvabiliteitp == '') {
            $('#p_notcompleted').html(data.p_sol_wrong_notice); 
        } else if(h_liquiditeitp == ''){ 
            $('#p_notcompleted').html(data.p_liq_wrong_notice);
            
        }     
               
    });
    } else {
        $("#div_box4").hide();
        $("#div_box5").hide();
    }

    if (PdataId1 == '1') {
        $("#rdo_ptype_1").click();

        $("#h_partnertypeselection").val('1');        
        $("#div_box4_1").show();

        var pyear = $('#h_partneryearselection').val();
        $("#div_rangeslider").html('<input id="single_slider_2" type="hidden" value="'+pyear+'"/><div class="gray-line1"></div><div class="gray-line2"></div><div class="gray-line3"></div>');
        $("#div_rangeslider").removeClass('demo-output2');

        $("#div_loondienst").show();
        $("#div_box4_1").hide();
        $("#div_forhalfyearp").hide();
         load_year_range_partner_session('1');
         incomedata_calculation();
    } else {
            $("#div_loondienst").hide();
            $("#div_box4_1").show();
            $("#div_forhalfyearp").show();
    }
    if (PdataId4 == '4') {
        $("#rdo_ptype_4").click();
        $("#h_partnertypeselection").val('4');
        $("#div_box4_1").show();

        var pyear = $('#h_partneryearselection').val();
        $("#div_rangeslider").html('<input id="single_slider_2" type="hidden" value="'+pyear+'"/><div class="gray-line1"></div><div class="gray-line2"></div><div class="gray-line3"></div>');
        $("#div_rangeslider").removeClass('demo-output2');

        $("#div_inkomensgegevensp_1").show();
        $("#div_inkomensgegevensp_2").show();
        $("#div_inkomensgegevensp_3").show();

         load_year_range_partner_session('4');
         incomedata_calculation();
    }  else {

        $("#div_inkomensgegevensp_1").hide();
        $("#div_inkomensgegevensp_2").hide();
        $("#div_inkomensgegevensp_3").hide();
    } 
    if (PdataId3 == '3') {
        $("#rdo_ptype_3").click();
        $("#h_partnertypeselection").val('3');
        var pyear = $('#h_partneryearselection').val();
        $("#div_box4_1").show();

        $("#div_rangeslider").html('<input id="single_slider_2" type="hidden" value="'+pyear+'"/><div class="gray-line1"></div><div class="gray-line2"></div><div class="gray-line3"></div>');
        $("#div_rangeslider").removeClass('demo-output2');
        load_year_range_partner_session('3');
        //$('#single_slider_2').jRange('setValue', '3');

        $("#div_winstuitondernemingp_1").show();
        $("#div_winstuitondernemingp_2").show();
        $("#div_winstuitondernemingp_3").show();
        incomedata_calculation();
    }

    $("#div_box5").show();
    if (PdataId2 == '2') {
        $("#rdo_ptype_2").click();
        $("#h_partnertypeselection").val('2');
        $("#div_box4_1").show();
        $("#div_rangeslider").append('<div class="gray-line4"></div>');

       $("#div_rangeslider").addClass('demo-output2');
        load_year_range_partner_session('2');
        incomedata_calculation();
        
    }     

    function load_year_range_partner_session(typeselection){

        var value = $('#single_slider_2').val();
       
    if (typeselection == '2') {
        var range_from = 0;
        var range_scale = [0.5, 1.0, 2.0, 3.0];
    } else {
        var range_from = 1;
        var range_scale = [1, 2, 3];
    }
    $("#single_slider_2").jRange({
        from: range_from,
        to: 3,
        step: 1,
        scale: range_scale,
        format: "%s",
        width: 500,
        showLabels: false,
        snap: true,
        onstatechange: function (value) {
            
            $("#div_winstuitondernemingp").hide();

            

            if (typeselection != '1') {
                $("#h_partneryearselection").val(value);

                if (value == '0') {
                    $("#div_forhalfyearp").show();
                } else if (value == "1") {
                    $("#div_forhalfyearp").hide();
                    if (typeselection == '4') {
                        $("#div_inkomensgegevensp_2 :input").attr("disabled", true);
                        $("#div_inkomensgegevensp_3 :input").attr("disabled", true);
                    } else {
                        $("#div_winstuitondernemingp").show();
                        $("#div_winstuitondernemingp_2 :input").attr("disabled", true);
                        $("#div_winstuitondernemingp_3 :input").attr("disabled", true);
                    }

                    $("#div_solvabiliteitp_2 :input").attr("disabled", true);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", true);

                    $("#div_liquiditeitp_2 :input").attr("disabled", true);
                    $("#div_liquiditeitp_3 :input").attr("disabled", true);
                } else if (value == "2") {
                    $("#div_forhalfyearp").hide();
                    if (typeselection == '4') {
                        $("#div_inkomensgegevensp_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevensp_3 :input").attr("disabled", true);
                    } else {
                        $("#div_winstuitondernemingp").show();
                        $("#div_winstuitondernemingp_2 :input").attr("disabled", false);
                        $("#div_winstuitondernemingp_3 :input").attr("disabled", true);
                    }

                    $("#div_solvabiliteitp_2 :input").attr("disabled", false);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", true);

                    $("#div_liquiditeitp_2 :input").attr("disabled", false);
                    $("#div_liquiditeitp_3 :input").attr("disabled", true);
                } else if (value == "3") {
                    $("#div_forhalfyearp").hide();
                    if (typeselection == '4') {
                        $("#div_inkomensgegevensp_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevensp_3 :input").attr("disabled", false);
                    } else {
                        $("#div_winstuitondernemingp").show();
                        $("#div_winstuitondernemingp_2 :input").attr("disabled", false);
                        $("#div_winstuitondernemingp_3 :input").attr("disabled", false);
                    }

                    $("#div_solvabiliteitp_2 :input").attr("disabled", false);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", false);

                    $("#div_liquiditeitp_2 :input").attr("disabled", false);
                    $("#div_liquiditeitp_3 :input").attr("disabled", false);
                }
            } else {
                $("#div_solvabiliteitp_2 :input").attr("disabled", true);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", true);

                    $("#div_liquiditeitp_2 :input").attr("disabled", true);
                    $("#div_liquiditeitp_3 :input").attr("disabled", true);
            }
        }
    });

    $("#div_winstuitondernemingp").hide();            

    if (typeselection != '1') {
        $("#h_partneryearselection").val(value);

        if (value == '0') {

            if (value == "0") {
                $("#div_forhalfyear").show();
                $("#div_winstuitonderneming").hide();

                if( $("#txt_eigenvermogenp_1").val() != '' ||  $("#txt_balanstotaalp_1").val() != '' ){
                $('#card_sol_11').click();
                } 
                if($("#txt_vlottendeactivap_1").val() != '' ||  $("#txt_kortvreemdvermogenp_1").val() != '' ) {
                    $('#card_liq_22').click();
                }
            } else {
                $("#div_forhalfyear").hide();
                $("#div_winstuitonderneming").show();
            }
            $("#div_forhalfyearp").show();
            $("#div_solvabiliteitp_2 :input").attr("disabled", true);
            $("#div_solvabiliteitp_3 :input").attr("disabled", true);

            $("#div_liquiditeitp_2 :input").attr("disabled", true);
            $("#div_liquiditeitp_3 :input").attr("disabled", true);
            incomedata_calculation();
        } else if (value == "1") {
            $("#div_forhalfyearp").hide();

            if( $("#txt_eigenvermogenp_1").val() != '' ||  $("#txt_balanstotaalp_1").val() != '' ){
                $('#card_sol_11').click();
            } 
            if($("#txt_vlottendeactivap_1").val() != '' ||  $("#txt_kortvreemdvermogenp_1").val() != '' ) {
                $('#card_liq_22').click();
            }
            if (typeselection == '4') {
                $("#div_inkomensgegevensp_2 :input").attr("disabled", true);
                $("#div_inkomensgegevensp_3 :input").attr("disabled", true);
            } else {
                $("#div_winstuitondernemingp").show();
                $("#div_winstuitondernemingp_2 :input").attr("disabled", true);
                $("#div_winstuitondernemingp_3 :input").attr("disabled", true);
            }

            $("#div_solvabiliteitp_2 :input").attr("disabled", true);
            $("#div_solvabiliteitp_3 :input").attr("disabled", true);

            $("#div_liquiditeitp_2 :input").attr("disabled", true);
            $("#div_liquiditeitp_3 :input").attr("disabled", true);
            incomedata_calculation();
        } else if (value == "2") {
            $("#div_forhalfyearp").hide();

            if( $("#txt_eigenvermogenp_1").val() != '' ||  $("#txt_balanstotaalp_1").val() != '' || $("#txt_eigenvermogenp_2").val() != '' || $("#txt_balanstotaalp_2").val() != '' ){
                $('#card_sol_11').click();
            } 
            if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactivap_2").val() != '' || $("#txt_kortvreemdvermogenp_2").val() != '' ) {
                $('#card_liq_22').click();
            }

            if (typeselection == '4') {
                $("#div_inkomensgegevensp_2 :input").attr("disabled", false);
                $("#div_inkomensgegevensp_3 :input").attr("disabled", true);
            } else {
                $("#div_winstuitondernemingp").show();
                $("#div_winstuitondernemingp_2 :input").attr("disabled", false);
                $("#div_winstuitondernemingp_3 :input").attr("disabled", true);
            }

            $("#div_solvabiliteitp_2 :input").attr("disabled", false);
            $("#div_solvabiliteitp_3 :input").attr("disabled", true);

            $("#div_liquiditeitp_2 :input").attr("disabled", false);
            $("#div_liquiditeitp_3 :input").attr("disabled", true);
            incomedata_calculation();
        } else if (value == "3") {
            $("#div_forhalfyearp").hide();

            if( $("#txt_eigenvermogenp_1").val() != '' ||  $("#txt_balanstotaalp_1").val() != '' || $("#txt_eigenvermogenp_2").val() != '' || $("#txt_balanstotaalp_2").val() != '' || $("#txt_eigenvermogenp_3").val() != '' || $("#txt_balanstotaalp_3").val() != '' ){
                $('#card_sol_11').click();
            } 
            if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactivap_2").val() != '' || $("#txt_kortvreemdvermogenp_2").val() != '' || $("#txt_vlottendeactivap_3").val() != '' || $("#txt_kortvreemdvermogenp_3").val() != '' ) {
                $('#card_liq_22').click();
            }

            if (typeselection == '4') {
                $("#div_inkomensgegevensp_2 :input").attr("disabled", false);
                $("#div_inkomensgegevensp_3 :input").attr("disabled", false);
            } else {
                $("#div_winstuitondernemingp").show();
                $("#div_winstuitondernemingp_2 :input").attr("disabled", false);
                $("#div_winstuitondernemingp_3 :input").attr("disabled", false);
            }

            $("#div_solvabiliteitp_2 :input").attr("disabled", false);
            $("#div_solvabiliteitp_3 :input").attr("disabled", false);

            $("#div_liquiditeitp_2 :input").attr("disabled", false);
            $("#div_liquiditeitp_3 :input").attr("disabled", false);
            incomedata_calculation();
        }
    } else {

            if( $("#txt_eigenvermogenp_1").val() != '' ||  $("#txt_balanstotaalp_1").val() != '' ){
                $('#card_sol_11').click();
            } 
            if($("#txt_vlottendeactivap_1").val() != '' ||  $("#txt_kortvreemdvermogenp_1").val() != '' ) {
                $('#card_liq_22').click();
            }

            $("#div_solvabiliteitp_2 :input").attr("disabled", true);
            $("#div_solvabiliteitp_3 :input").attr("disabled", true);

            $("#div_liquiditeitp_2 :input").attr("disabled", true);
            $("#div_liquiditeitp_3 :input").attr("disabled", true);
            incomedata_calculation();
    }
}
    
// End partner type
    if(dataId1 == 'in1') { 
       $("#group1_in1").click(); 
        var boxNumber = parseInt($(this).parents('.desc').attr("data-box"));
        //check if the data-box was succesfully retrieved. If not, first option chosen, reset all of it
        if (isNaN(boxNumber)) {
            boxNumber = 0;
        }   
        var groupval = 'in1';
        var target = $("#" + groupval);
        var newBoxOpened = target.attr("data-box");
        //check if the last opened box was an earlier one than the newly clicked one
        if (lastBoxOpened > boxNumber) {
            //hide boxes beyond the one we opened now
            $('.desc').each(function () {
                //if box number is bigger than the currently clicked box, close them.
                if ($(this).attr("data-box") > boxNumber) {
                    $(this).hide();
                    //uncheck the previously selected radio buttons in now hidden things
                    $('input', this).prop("checked", false);
                }
            });
        }
        //render target box
        target.show();
        $('[data-toggle="popover"]').popover();
        //update last opened box to the newly opened one
        lastBoxOpened = newBoxOpened;
        $("#div_box2").show();
        $("#div_box3").show();
        $("#h_typeselection").val(groupval);

        if (groupval == 'in1') {
            $("#h_yearselection").val('0');
        } else {
            $("#h_yearselection").val('1');
        }

        if (groupval == 'in1') {

            $("#div_inkomensgegevens_1").hide();
            $("#div_inkomensgegevens_2").hide();
            $("#div_inkomensgegevens_3").hide();

            $("#div_solvabiliteit_2 :input").attr("disabled", true);
            $("#div_solvabiliteit_3 :input").attr("disabled", true);

            $("#div_liquiditeit_2 :input").attr("disabled", true);
            $("#div_liquiditeit_3 :input").attr("disabled", true);
           
            $("#single_slider_first").jRange({
                from: 0,
                to: 3,
                step: 1,
                scale: [0.5, 1.0, 2.0, 3.0],
                format: "%s",
                width: 500,
                showLabels: false,
                snap: true,
                onstatechange: function (value) { 
                    $("#h_yearselection").val(value);
                    if (value == "0") {
                        $("#div_forhalfyear").show();
                        $("#div_winstuitonderneming").hide();
                        $('#h_yearselection').val(value);
                    } else {
                        $("#div_forhalfyear").hide();
                        $("#div_winstuitonderneming").show();
                    }

                    if (value == "1") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", true);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", true);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", true);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                        $('#h_yearselection').val(value);
                    } else if (value == "2") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                        $('#h_yearselection').val(value);
                    } else if (value == "3") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", false);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", false);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", false);
                        $('#h_yearselection').val(value);
                    }
                    incomedata_calculation();
                }
            });
            var value = $("#single_slider_first").val();
                       
            if (value == "0") {
                $("#div_forhalfyear").show();
                $("#div_winstuitonderneming").hide();
                $('#h_yearselection').val(value);
                incomedata_calculation();
            } else {
                $("#div_forhalfyear").hide();
                $("#div_winstuitonderneming").show();
            }

            if (value == "1") {
                $('#h_yearselection').val(value);

                if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' ){
                    $('#card_collapse_11').click();
                } 
                if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' ) {
                    $('#card_collapse_22').click();
                }
                $("#div_winstuitonderneming_2 :input").attr("disabled", true);
                $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                $("#div_solvabiliteit_2 :input").attr("disabled", true);
                $("#div_solvabiliteit_3 :input").attr("disabled", true);

                $("#div_liquiditeit_2 :input").attr("disabled", true);
                $("#div_liquiditeit_3 :input").attr("disabled", true);
                incomedata_calculation();
            } else if (value == "2") {
                $('#h_yearselection').val(value);
                if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' || $("#txt_eigenvermogen_2").val() != '' || $("#txt_balanstotaal_2").val() != '' ){
                    $('#card_collapse_11').click();
                } 
                if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactiva_2").val() != '' || $("#txt_kortvreemdvermogen_2").val() != '' ) {
                    $('#card_collapse_22').click();
                }
                $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                $("#div_solvabiliteit_2 :input").attr("disabled", false);
                $("#div_solvabiliteit_3 :input").attr("disabled", true);

                $("#div_liquiditeit_2 :input").attr("disabled", false);
                $("#div_liquiditeit_3 :input").attr("disabled", true);
                incomedata_calculation();
            } else if (value == "3") {
                $('#h_yearselection').val(value);
                if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' || $("#txt_eigenvermogen_2").val() != '' || $("#txt_balanstotaal_2").val() != '' || $("#txt_eigenvermogen_3").val() != '' || $("#txt_balanstotaal_3").val() != '' ){
                    $('#card_collapse_11').click();
                } 
                if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactiva_2").val() != '' || $("#txt_kortvreemdvermogen_2").val() != '' || $("#txt_vlottendeactiva_3").val() != '' || $("#txt_kortvreemdvermogen_3").val() != '' ) {
                    $('#card_collapse_22').click();
                }
                $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                $("#div_winstuitonderneming_3 :input").attr("disabled", false);

                $("#div_solvabiliteit_2 :input").attr("disabled", false);
                $("#div_solvabiliteit_3 :input").attr("disabled", false);

                $("#div_liquiditeit_2 :input").attr("disabled", false);
                $("#div_liquiditeit_3 :input").attr("disabled", false);
                incomedata_calculation();
            }
            incomedata_calculation();
           // $('#single_slider_first').jRange('setValue', '3');
        }
    } 
    if(dataId3 == 'ph1') { 
        $("#group1_ph1").click();
        $('#in1').hide();
        //$('#tv1').hide();
        $('#div_forhalfyear').hide();

        var boxNumber = parseInt($(this).parents('.desc').attr("data-box"));

        //check if the data-box was succesfully retrieved. If not, first option chosen, reset all of it
        if (isNaN(boxNumber)) {
            boxNumber = 0;
        }

        var groupval = 'ph1';
        var target = $("#" + groupval);
        var newBoxOpened = target.attr("data-box");
        //check if the last opened box was an earlier one than the newly clicked one
        if (lastBoxOpened > boxNumber) {
            //hide boxes beyond the one we opened now
            $('.desc').each(function () {
                //if box number is bigger than the currently clicked box, close them.
                if ($(this).attr("data-box") > boxNumber) {
                    $(this).hide();
                    //uncheck the previously selected radio buttons in now hidden things
                    $('input', this).prop("checked", false);
                }
            });
        }
        //render target box
        target.show();
        $('[data-toggle="popover"]').popover();
        //update last opened box to the newly opened one
        lastBoxOpened = newBoxOpened;
        $("#div_box2").show();
        $("#div_box3").show();
        $("#h_typeselection").val(groupval);

        if (groupval == 'ph1') {
            $("#div_holding").show();
            $("#div_holdingtext").show();
            $('input[name="onoffswitch3"]').click(function(){
                if($(this).prop("checked") == true){
                    $('#div_holdingtext').hide();
                } else {
                    $('#div_holdingtext').show();
                }
            });
        }
        if (groupval == 'ph1') {
        $("#div_forhalfyear").hide();
            $("#div_winstuitonderneming").hide();
            $("#div_inkomensgegevens_1").show();
            $("#div_inkomensgegevens_2").show();
            $("#div_inkomensgegevens_3").show();
            $("#single_slider_ph1").jRange({
                from: 1,
                to: 3,
                step: 1,
                scale: [1.0, 2.0, 3.0],
                format: "%s",
                width: 500,
                showLabels: false,
                snap: true,
                onstatechange: function (value) {
                    $("#h_yearselection").val(value);
                    if (value == "1") {
                        $('#h_yearselection').val(value);
                        $("#div_inkomensgegevens_2 :input").attr("disabled", true);
                        $("#div_inkomensgegevens_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", true);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", true);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "2") {
                        $('#h_yearselection').val(value);
                        $("#div_inkomensgegevens_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevens_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "3") {
                        $('#h_yearselection').val(value);
                        $("#div_inkomensgegevens_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevens_3 :input").attr("disabled", false);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", false);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", false);
                    }
                    incomedata_calculation();
                }
            });
           var value = $("#single_slider_ph1").val();

            if (value == "1") {
                $('#h_yearselection').val(value);
                if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' ){
                    $('#card_collapse_11').click();
                } 
                if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' ) {
                    $('#card_collapse_22').click();
                }
                $("#div_inkomensgegevens_2 :input").attr("disabled", true);
                $("#div_inkomensgegevens_3 :input").attr("disabled", true);

                $("#div_solvabiliteit_2 :input").attr("disabled", true);
                $("#div_solvabiliteit_3 :input").attr("disabled", true);

                $("#div_liquiditeit_2 :input").attr("disabled", true);
                $("#div_liquiditeit_3 :input").attr("disabled", true);
            } else if (value == "2") {
                $('#h_yearselection').val(value);
                 if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' || $("#txt_eigenvermogen_2").val() != '' || $("#txt_balanstotaal_2").val() != '' ){
                    $('#card_collapse_11').click();
                } 
                if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactiva_2").val() != '' || $("#txt_kortvreemdvermogen_2").val() != '' ) {
                    $('#card_collapse_22').click();
                }
                $("#div_inkomensgegevens_2 :input").attr("disabled", false);
                $("#div_inkomensgegevens_3 :input").attr("disabled", true);

                $("#div_solvabiliteit_2 :input").attr("disabled", false);
                $("#div_solvabiliteit_3 :input").attr("disabled", true);

                $("#div_liquiditeit_2 :input").attr("disabled", false);
                $("#div_liquiditeit_3 :input").attr("disabled", true);
            } else if (value == "3") {
                $('#h_yearselection').val(value);
                if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' || $("#txt_eigenvermogen_2").val() != '' || $("#txt_balanstotaal_2").val() != '' || $("#txt_eigenvermogen_3").val() != '' || $("#txt_balanstotaal_3").val() != '' ){
                    $('#card_collapse_11').click();
                } 
                if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactiva_2").val() != '' || $("#txt_kortvreemdvermogen_2").val() != '' || $("#txt_vlottendeactiva_3").val() != '' || $("#txt_kortvreemdvermogen_3").val() != '' ) {
                    $('#card_collapse_22').click();
                }
                $("#div_inkomensgegevens_2 :input").attr("disabled", false);
                $("#div_inkomensgegevens_3 :input").attr("disabled", false);

                $("#div_solvabiliteit_2 :input").attr("disabled", false);
                $("#div_solvabiliteit_3 :input").attr("disabled", false);

                $("#div_liquiditeit_2 :input").attr("disabled", false);
                $("#div_liquiditeit_3 :input").attr("disabled", false);
            }
            incomedata_calculation();
        }     
    }
    if(dataId2 == 'tv1') {
        $("#group1_tv1").click();
        $('#in1').hide(); $('#ph1').hide();
        var boxNumber = parseInt($(this).parents('.desc').attr("data-box"));

        //check if the data-box was succesfully retrieved. If not, first option chosen, reset all of it
        if (isNaN(boxNumber)) {
            boxNumber = 0;
        }

        var groupval = 'tv1';
        var target = $("#" + groupval);
        var newBoxOpened = target.attr("data-box");
        //check if the last opened box was an earlier one than the newly clicked one
        if (lastBoxOpened > boxNumber) {
            //hide boxes beyond the one we opened now
            $('.desc').each(function () {
                //if box number is bigger than the currently clicked box, close them.
                if ($(this).attr("data-box") > boxNumber) {
                    $(this).hide();
                    //uncheck the previously selected radio buttons in now hidden things
                    $('input', this).prop("checked", false);
                }
            });
        }
        //render target box
        target.show();
        $('[data-toggle="popover"]').popover();
        //update last opened box to the newly opened one
        lastBoxOpened = newBoxOpened;
        $("#div_box2").show();
        $("#div_box3").show();
        $("#h_typeselection").val(groupval);

        if (groupval == 'tv1') {
            $("#div_winstuitonderneming").show();
            $("#div_forhalfyear").hide();
            $("#div_inkomensgegevens_1").hide();
            $("#div_inkomensgegevens_2").hide();
            $("#div_inkomensgegevens_3").hide();

            $("#div_solvabiliteit_2 :input").attr("disabled", true);
            $("#div_solvabiliteit_3 :input").attr("disabled", true);

            $("#div_liquiditeit_2 :input").attr("disabled", true);
            $("#div_liquiditeit_3 :input").attr("disabled", true);
            $("#single_slider_tv1").jRange({
                from: 1,
                to: 3,
                step: 1,
                scale: [1.0, 2.0, 3.0],
                format: "%s",
                width: 500,
                showLabels: false,
                snap: true,
                onstatechange: function (value) {
                    $("#h_yearselection").val(value);
                    if (value == "1") {
                        $('#h_yearselection').val(value);
                        $("#div_winstuitonderneming_2 :input").attr("disabled", true);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", true);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", true);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "2") {
                        $('#h_yearselection').val(value);
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "3") {
                        $('#h_yearselection').val(value);
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", false);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", false);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", false);
                    }
                    incomedata_calculation();
                }                
            });
            var value = $("#single_slider_tv1").val();
                if (value == "1") {
                    $('#h_yearselection').val(value);
                    if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' ){
                        $('#card_collapse_11').click();
                    } 
                    if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' ) {
                        $('#card_collapse_22').click();
                    }
                    $("#div_winstuitonderneming_2 :input").attr("disabled", true);
                    $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                    $("#div_solvabiliteit_2 :input").attr("disabled", true);
                    $("#div_solvabiliteit_3 :input").attr("disabled", true);

                    $("#div_liquiditeit_2 :input").attr("disabled", true);
                    $("#div_liquiditeit_3 :input").attr("disabled", true);
                } else if (value == "2") {
                    $('#h_yearselection').val(value);
                    if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' || $("#txt_eigenvermogen_2").val() != '' || $("#txt_balanstotaal_2").val() != '' ){
                        $('#card_collapse_11').click();
                    } 
                    if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactiva_2").val() != '' || $("#txt_kortvreemdvermogen_2").val() != '' ) {
                        $('#card_collapse_22').click();
                    }
                    $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                    $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                    $("#div_solvabiliteit_2 :input").attr("disabled", false);
                    $("#div_solvabiliteit_3 :input").attr("disabled", true);

                    $("#div_liquiditeit_2 :input").attr("disabled", false);
                    $("#div_liquiditeit_3 :input").attr("disabled", true);
                } else if (value == "3") {
                    $('#h_yearselection').val(value);
                    if( $("#txt_eigenvermogen_1").val() != '' ||  $("#txt_balanstotaal_1").val() != '' || $("#txt_eigenvermogen_2").val() != '' || $("#txt_balanstotaal_2").val() != '' || $("#txt_eigenvermogen_3").val() != '' || $("#txt_balanstotaal_3").val() != '' ){
                        $('#card_collapse_11').click();
                    } 
                    if($("#txt_vlottendeactiva_1").val() != '' ||  $("#txt_kortvreemdvermogen_1").val() != '' || $("#txt_vlottendeactiva_2").val() != '' || $("#txt_kortvreemdvermogen_2").val() != '' || $("#txt_vlottendeactiva_3").val() != '' || $("#txt_kortvreemdvermogen_3").val() != '' ) {
                        $('#card_collapse_22').click();
                    }
                    $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                    $("#div_winstuitonderneming_3 :input").attr("disabled", false);

                    $("#div_solvabiliteit_2 :input").attr("disabled", false);
                    $("#div_solvabiliteit_3 :input").attr("disabled", false);

                    $("#div_liquiditeit_2 :input").attr("disabled", false);
                    $("#div_liquiditeit_3 :input").attr("disabled", false);
                }
                incomedata_calculation();
        }
    }

    //$('#rdo_partner').val();
/****************************** on click event for 1st click *********************/

    var lastBoxOpened = 0;
    // based on selected type, related calculation forms showing
    $("input[name$='group1']").click(function () {
        $('#in1').hide();
        $('#ph1').hide();
        $('#tv1').hide();
        var boxNumber = parseInt($(this).parents('.desc').attr("data-box"));

        //check if the data-box was succesfully retrieved. If not, first option chosen, reset all of it
        if (isNaN(boxNumber)) {
            boxNumber = 0;
        }

        var groupval = $(this).val();
        var target = $("#" + groupval);
        var newBoxOpened = target.attr("data-box");
        //check if the last opened box was an earlier one than the newly clicked one
        if (lastBoxOpened > boxNumber) {
            //hide boxes beyond the one we opened now
            $('.desc').each(function () {
                //if box number is bigger than the currently clicked box, close them.
                if ($(this).attr("data-box") > boxNumber) {
                    $(this).hide();
                    //uncheck the previously selected radio buttons in now hidden things
                    $('input', this).prop("checked", false);
                }
            });
        }
        //render target box
        target.show();
        $('[data-toggle="popover"]').popover();
        //update last opened box to the newly opened one
        lastBoxOpened = newBoxOpened;
        $("#div_box2").show();
        $("#div_box3").show();
        $("#div_box5").hide();
        $("#h_typeselection").val(groupval);

        if (groupval == 'in1') {
            $("#h_yearselection").val('0');
        } else {
            $("#h_yearselection").val('1');
        }

        if (groupval == 'ph1') {
            $("#div_holding").show();
            $("#div_holdingtext").show();
            $('input[name="onoffswitch3"]').click(function(){
                if($(this).prop("checked") == true){
                    $('#div_holdingtext').hide();
                } else {
                    $('#div_holdingtext').show();
                }
            });

        } else {
            $("#div_holding").hide();
            $("#div_holdingtext").hide();
        }
        if (groupval == 'in1') {

            $("#div_inkomensgegevens_1").hide();
            $("#div_inkomensgegevens_2").hide();
            $("#div_inkomensgegevens_3").hide();

            $("#div_solvabiliteit_2 :input").attr("disabled", true);
            $("#div_solvabiliteit_3 :input").attr("disabled", true);

            $("#div_liquiditeit_2 :input").attr("disabled", true);
            $("#div_liquiditeit_3 :input").attr("disabled", true);

            $("#single_slider_first").jRange({
                from: 0,
                to: 3,
                step: 1,
                scale: [0.5, 1.0, 2.0, 3.0],
                format: "%s",
                width: 500,
                showLabels: false,
                snap: true,
                onstatechange: function (value) {

                    $("#h_yearselection").val(value);
                    if (value == "0") {
                        $("#div_forhalfyear").show();
                        $("#div_winstuitonderneming").hide();
                    } else {
                        $("#div_forhalfyear").hide();
                        $("#div_winstuitonderneming").show();
                    }

                    if (value == "1") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", true);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", true);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", true);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "2") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "3") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", false);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", false);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", false);
                    }
                    incomedata_calculation();
                }
            });
            $('#single_slider_first').jRange('updateRange', '0.5,3', '0');
        } else if (groupval == 'tv1') {
            $("#div_winstuitonderneming").show();
            $("#div_forhalfyear").hide();
            $("#div_inkomensgegevens_1").hide();
            $("#div_inkomensgegevens_2").hide();
            $("#div_inkomensgegevens_3").hide();

            $("#div_solvabiliteit_2 :input").attr("disabled", true);
            $("#div_solvabiliteit_3 :input").attr("disabled", true);

            $("#div_liquiditeit_2 :input").attr("disabled", true);
            $("#div_liquiditeit_3 :input").attr("disabled", true);
            $("#single_slider_tv1").jRange({
                from: 1,
                to: 3,
                step: 1,
                scale: [1.0, 2.0, 3.0],
                format: "%s",
                width: 500,
                showLabels: false,
                snap: true,
                onstatechange: function (value) {
                    $("#h_yearselection").val(value);
                    if (value == "1") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", true);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", true);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", true);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "2") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "3") {
                        $("#div_winstuitonderneming_2 :input").attr("disabled", false);
                        $("#div_winstuitonderneming_3 :input").attr("disabled", false);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", false);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", false);
                    }
                    incomedata_calculation();
                }
            });
            $('#single_slider_tv1').jRange('updateRange', '1,3', '1');
        } else {
            $("#div_forhalfyear").hide();
            $("#div_winstuitonderneming").hide();
            $("#div_inkomensgegevens_1").show();
            $("#div_inkomensgegevens_2").show();
            $("#div_inkomensgegevens_3").show();
            $("#single_slider_ph1").jRange({
                from: 1,
                to: 3,
                step: 1,
                scale: [1.0, 2.0, 3.0],
                format: "%s",
                width: 500,
                showLabels: false,
                snap: true,
                onstatechange: function (value) {
                    $("#h_yearselection").val(value);
                    if (value == "1") {
                        $("#div_inkomensgegevens_2 :input").attr("disabled", true);
                        $("#div_inkomensgegevens_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", true);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", true);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "2") {
                        $("#div_inkomensgegevens_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevens_3 :input").attr("disabled", true);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", true);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", true);
                    } else if (value == "3") {
                        $("#div_inkomensgegevens_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevens_3 :input").attr("disabled", false);

                        $("#div_solvabiliteit_2 :input").attr("disabled", false);
                        $("#div_solvabiliteit_3 :input").attr("disabled", false);

                        $("#div_liquiditeit_2 :input").attr("disabled", false);
                        $("#div_liquiditeit_3 :input").attr("disabled", false);
                    }
                    incomedata_calculation();
                }
            });
            $('#single_slider_ph1').jRange('updateRange', '1,3', '1');
        }
    });

    $("input.numbers").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else {
            return true;
        }
    });
    
    $('body').on('click', function (e) {
        $('[data-toggle=popover]').each(function () {
            // hide any open popovers when the anywhere else in the body is clicked
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

});

function incomedata_calculation() {

    var yearselection = $("#h_yearselection").val();
    var typeselection = $("#h_typeselection").val();
    var p_yearselection = $("#h_partneryearselection").val();
    var p_typeselection = $("#h_partnertypeselection").val();
    var halfyear_first = $("#txt_halfyear_first").val();
    var halfyear_second = $("#txt_halfyear_second").val();
    var halfyear_third = $("#txt_halfyear_third").val();
    var loondienst = $("#txt_loondienst").val();
    
    var totalincome = 0;
    var p_totalincome = 0;
    var hy_totalincome = 0;

    // calculation for Freelancer 0.5 Year    
    if (yearselection == '0' && typeselection == 'in1') {
        if (halfyear_third != '' && halfyear_first != '') {
            totalincome = ((parseFloat(halfyear_first) + parseFloat(halfyear_third))/2) * 0.9;
            totalincome = parseFloat(totalincome);
            totalincome = totalincome.toFixed(2);
        }
    } else if (yearselection == '1') {
        if (typeselection == 'ph1') { 
            // calculation for v.o.f
            var salaris_1 = $("#txt_salaris_1").val();
            var dividend_1 = $("#txt_dividend_1").val();
            var overwinst_1 = $("#txt_overwinst_1").val();
            if (salaris_1 != '' && dividend_1 != '' && overwinst_1 != '') {
                var average1 = (salaris_1 * 75) / 100;
                var average2 = (dividend_1 * 75) / 100;
                average2 = (average2 * 75) / 100;
                var average3 = (overwinst_1 * 75) / 100;
                average3 = (average3 * 75) / 100;

                var average = parseFloat(average1) + parseFloat(average2) + parseFloat(average3);
                totalincome = average.toFixed(2);
            }
        } else { 
            //calculation of Freelancer / B.V
            var average1 = $("#txt_winstuitonderneming_1").val();

            average = (average1 * 80) / 100;
            totalincome = average.toFixed(2);
        }
    } else if (yearselection == '2') {
        if (typeselection == 'ph1') {
            var salaris_1 = $("#txt_salaris_1").val();
            var salaris_2 = $("#txt_salaris_2").val();
            var dividend_1 = $("#txt_dividend_1").val();
            var dividend_2 = $("#txt_dividend_2").val();
            var overwinst_1 = $("#txt_overwinst_1").val();
            var overwinst_2 = $("#txt_overwinst_2").val();

            if (salaris_1 != '' && salaris_2 != '' && dividend_1 != '' && dividend_2 != '' && overwinst_1 != '' && overwinst_2 != '') {
                var average1 = (((parseInt(salaris_1) + parseInt(salaris_2)) / 2) * 90) / 100;

                var average2 = (((parseInt(dividend_1) + parseInt(dividend_2)) / 2) * 75) / 100;
                average2 = (average2 * 90) / 100;

                var average3 = (((parseInt(overwinst_1) + parseInt(overwinst_2)) / 2) * 75) / 100;
                average3 = (average3 * 90) / 100;

                var average = parseFloat(average1) + parseFloat(average2) + parseFloat(average3);
                totalincome = average.toFixed(2);
            }
        } else {
            var average1 = $("#txt_winstuitonderneming_1").val();
            var average2 = $("#txt_winstuitonderneming_2").val();

            var average = (parseFloat(average1) + parseFloat(average2)) / 2;
            average = (average * 90) / 100;
            totalincome = average.toFixed(2);
        }
    } else if (yearselection == '3') {
        if (typeselection == 'ph1') {
            var salaris_1 = $("#txt_salaris_1").val();
            var salaris_2 = $("#txt_salaris_2").val();
            var salaris_3 = $("#txt_salaris_3").val();
            var dividend_1 = $("#txt_dividend_1").val();
            var dividend_2 = $("#txt_dividend_2").val();
            var dividend_3 = $("#txt_dividend_3").val();
            var overwinst_1 = $("#txt_overwinst_1").val();
            var overwinst_2 = $("#txt_overwinst_2").val();
            var overwinst_3 = $("#txt_overwinst_3").val();

            if (salaris_1 != '' && salaris_2 != '' && salaris_3 != '' && dividend_1 != '' && dividend_2 != '' && dividend_3 != '' && overwinst_1 != '' && overwinst_2 != '' && overwinst_3 != '') {
                var average1 = (parseInt(salaris_1) + parseInt(salaris_2) + parseInt(salaris_3)) / 3;
                var average2 = (((parseInt(dividend_1) + parseInt(dividend_2) + parseInt(dividend_3)) / 3) * 75) / 100;
                var average3 = (((parseInt(overwinst_1) + parseInt(overwinst_2) + parseInt(overwinst_3)) / 3) * 75) / 100;
                var average = parseFloat(average1) + parseFloat(average2) + parseFloat(average3);
                totalincome = average.toFixed(2);
            }
        } else {
            var average1 = $("#txt_winstuitonderneming_1").val();
            var average2 = $("#txt_winstuitonderneming_2").val();
            var average3 = $("#txt_winstuitonderneming_3").val();

            var average = (parseFloat(average1) + parseFloat(average2) + parseFloat(average3)) / 3;
            totalincome = average.toFixed(2);
        }
    }    
    // Calculation for selected partner's income
    if (loondienst != '' && p_typeselection=='1') {
        p_totalincome = loondienst;
    } else if (p_yearselection == '0' && p_typeselection == '2') {
        var salaris_1 = $("#txt_halfyearp_first").val();
        var dividend_1 = $("#txt_halfyearp_second").val();
        var overwinst_1 = $("#txt_halfyearp_third").val();
        if (salaris_1 != '' && dividend_1 != '' && overwinst_1 != '') {
            var average = (parseInt(salaris_1) + parseInt(dividend_1) + parseInt(overwinst_1)) / 3;
            average = (average * 80) / 100;
            p_totalincome = average.toFixed(2);
        }
    } else if (p_yearselection == '1') {
        if (p_typeselection == '4') {
            var salaris_1 = $("#txt_salarisp_1").val();
            var dividend_1 = $("#txt_dividendp_1").val();
            var overwinst_1 = $("#txt_overwinstp_1").val();
            if (salaris_1 != '' && dividend_1 != '' && overwinst_1 != '') {
                var average1 = (salaris_1 * 75) / 100;
                var average2 = (dividend_1 * 75) / 100;
                average2 = (average2 * 75) / 100;
                var average3 = (overwinst_1 * 75) / 100;
                average3 = (average3 * 75) / 100;

                var average = parseFloat(average1) + parseFloat(average2) + parseFloat(average3);
                p_totalincome = average.toFixed(2);
            }
        } else {

            var average1 = $("#txt_winstuitondernemingp_1").val();
            
            if (average1 != '') {
                //var average = (average1 * 80) / 100;
                p_totalincome = average.toFixed(2);
            }
        }
    } else if (p_yearselection == '2') {
        if (p_typeselection == '4') {
            var salaris_1 = $("#txt_salarisp_1").val();
            var salaris_2 = $("#txt_salarisp_2").val();
            var dividend_1 = $("#txt_dividendp_1").val();
            var dividend_2 = $("#txt_dividendp_2").val();
            var overwinst_1 = $("#txt_overwinstp_1").val();
            var overwinst_2 = $("#txt_overwinstp_2").val();

            if (salaris_1 != '' && salaris_2 != '' && dividend_1 != '' && dividend_2 != '' && overwinst_1 != '' && overwinst_2 != '') {

                var average1 = (((parseInt(salaris_1) + parseInt(salaris_2)) / 2) * 90) / 100;

                var average2 = (((parseInt(dividend_1) + parseInt(dividend_2)) / 2) * 75) / 100;
                average2 = (average2 * 90) / 100;

                var average3 = (((parseInt(overwinst_1) + parseInt(overwinst_2)) / 2) * 75) / 100;
                average3 = (average3 * 90) / 100;

                var average = parseFloat(average1) + parseFloat(average2) + parseFloat(average3);
                p_totalincome = average.toFixed(2);
            }
        } else {
            var salaris_1 = $("#txt_winstuitondernemingp_1").val();
            var dividend_1 = $("#txt_winstuitondernemingp_2").val();

            if (salaris_1 != '' && dividend_1 != '') {
                var average = (parseInt(salaris_1) + parseInt(dividend_1)) / 2;
                average = (average * 90) / 100;
                p_totalincome = average.toFixed(2);
            }
        }
    } else if (p_yearselection == '3') {
        if (p_typeselection == '4') {
            var salaris_1 = $("#txt_salarisp_1").val();
            var salaris_2 = $("#txt_salarisp_2").val();
            var salaris_3 = $("#txt_salarisp_3").val();
            var dividend_1 = $("#txt_dividendp_1").val();
            var dividend_2 = $("#txt_dividendp_2").val();
            var dividend_3 = $("#txt_dividendp_3").val();
            var overwinst_1 = $("#txt_overwinstp_1").val();
            var overwinst_2 = $("#txt_overwinstp_2").val();
            var overwinst_3 = $("#txt_overwinstp_3").val();

            if (salaris_1 != '' && salaris_2 != '' && salaris_3 != '' && dividend_1 != '' && dividend_2 != '' && dividend_3 != '' && overwinst_1 != '' && overwinst_2 != '' && overwinst_3 != '') {

                var average1 = (parseInt(salaris_1) + parseInt(salaris_2) + parseInt(salaris_3)) / 3;

                var average2 = (((parseInt(dividend_1) + parseInt(dividend_2) + parseInt(dividend_3)) / 3) * 75) / 100;

                var average3 = (((parseInt(overwinst_1) + parseInt(overwinst_2) + parseInt(overwinst_3)) / 3) * 75) / 100;

                var average = parseFloat(average1) + parseFloat(average2) + parseFloat(average3);
                p_totalincome = average.toFixed(2);
            }
        } else {
            var salaris_1 = $("#txt_winstuitondernemingp_1").val();
            var dividend_1 = $("#txt_winstuitondernemingp_2").val();
            var overwinst_1 = $("#txt_winstuitondernemingp_3").val();
            if (salaris_1 != '' && dividend_1 != '' && overwinst_1 != '') {
                var average = (parseInt(salaris_1) + parseInt(dividend_1) + parseInt(overwinst_1)) / 3;
                p_totalincome = average.toFixed(2);
            }
        }
    }
   
    var ti_sum = parseFloat(p_totalincome) + parseFloat(totalincome);

    if (p_totalincome != 0 && p_totalincome != 'NULL') {
       var p_totalincome2 = (p_totalincome * 0.70);
        var totalincome_sum = parseFloat(totalincome) + parseFloat(p_totalincome2);
    } else {
        var totalincome_sum = parseFloat(totalincome);
    }    
    
    if ($.isNumeric(totalincome_sum) == false) {
        totalincome_sum = 0;
    }

    

    var data = {
        action: 'ffc_final_result',
        is_ajax: 1,
        totalincome: totalincome_sum,
        ti_sum: ti_sum
    };
    $.post(ffc.ajaxurl, data, function (response) {
        /* Do Response Process */

        data = $.parseJSON(response); 
        var maximale_hypotheek = parseFloat(data.maximale_hypotheek);
        var maandlasten = parseFloat(data.maandlasten);
        var total_income_disp = parseFloat(data.total_income_disp);
        var sol_liq_wrong_notice = data.sol_liq_wrong_notice;
        maximale_hypotheek = maximale_hypotheek.toFixed(3);
        maandlasten = maandlasten.toFixed(3);
        
       // total_income_disp = (no_partner_total_incm != '' || no_partner_total_incm != 'NULL' ) ? no_partner_total_incm : total_income_disp.toFixed(2);
       if(p_totalincome == '' || p_totalincome == '0'){
        total_income_disp = ti_sum;
       } else {
        total_income_disp = total_income_disp.toFixed(2);
       }
        

        if ($.isNumeric(maximale_hypotheek) == false) {
            maximale_hypotheek = 0;
        }
        if ($.isNumeric(maandlasten) == false) {
            maandlasten = 0;
        }

        var sub_title_txt_size = $('#sub_title_txt_size').val();

        var finalresult = "";
        finalresult += '<ul>';
        finalresult += '<li>';
        finalresult += '<h3 style="font-size:'+sub_title_txt_size+'px;">Uw totale toetsinkomen</h3>';
        finalresult += '<h4 style="font-size:'+sub_title_txt_size+'px;">&euro; <span>' + accounting.formatMoney(total_income_disp, "", 2, ".", ",") + '</span></h4></li>';
        finalresult += '<li>';
        finalresult += '<h3 style="font-size:'+sub_title_txt_size+'px;">Maximale hypotheek</h3>';
        finalresult += '<h4 style="font-size:'+sub_title_txt_size+'px;">&euro; <span>' + accounting.formatMoney(maximale_hypotheek, "", 2, ".", ",") + '</span></h4>';
        finalresult += '</li>';
        finalresult += '<li>';
        finalresult += '<h3 style="font-size:'+sub_title_txt_size+'px;">Maandlasten</h3>';
        finalresult += '<h4 style="font-size:'+sub_title_txt_size+'px;">&euro; <span>' + accounting.formatMoney(maandlasten, "", 2, ".", ",") + '</span></h4>';
        finalresult += '</li>';
        finalresult += '</ul>';

        //$('#p_notcompleted').html(sol_liq_wrong_notice);

        if (totalincome_sum != '0') {
            $("#h_totalincome").val(totalincome);
            $("#h_totalincomep").val(p_totalincome);
            $("#h_totalincome_sum").val(total_income_disp);
            $("#h_max_hypotheek").val(maximale_hypotheek);
            $("#h_maandlasten").val(maandlasten);
            $("#div_overzicht").html(finalresult);
            $("#div_overzicht").show();
        } else {
            $("#h_totalincome").val("0");
            $("#div_overzicht").html("");
            $("#div_overzicht").hide();
        }
    });
}

function calculate_solvabiliteit() {
    var yearselection = $("#h_yearselection").val();
    if (yearselection == '0' || yearselection == '1') {
        var eigenvermogen_1 = $("#txt_eigenvermogen_1").val();
        var balanstotaal_1 = $("#txt_balanstotaal_1").val();
        if (eigenvermogen_1 != '' && balanstotaal_1 != '') {
            var percent = (eigenvermogen_1 / balanstotaal_1) * 100;
            percent = percent.toFixed(2);
            $("#h_solvabiliteit").val(percent);
        }
    } else if (yearselection == '2') {
        
        var eigenvermogen_2 = $("#txt_eigenvermogen_2").val();        
        var balanstotaal_2 = $("#txt_balanstotaal_2").val();
        var eigenvermogen_1 = $("#txt_eigenvermogen_1").val();
        var balanstotaal_1 = $("#txt_balanstotaal_1").val();
        if (eigenvermogen_1 != '' && balanstotaal_1 != '') {
            var percent1 = (eigenvermogen_1 / balanstotaal_1) * 100;
            percent1 = percent1.toFixed(2);
        }
        if (eigenvermogen_2 != '' && balanstotaal_2 != '') {            
            var percent2 = (eigenvermogen_2 / balanstotaal_2) * 100;
            percent2 = percent2.toFixed(2);   

            if(percent1 != ''){
                percent2 = percent2 > percent1 ? percent2 : percent1;
            }       
        }
               
        $("#h_solvabiliteit").val(percent2);

    } else if (yearselection == '3') {
        
        var eigenvermogen_3 = $("#txt_eigenvermogen_3").val();        
        var balanstotaal_3 = $("#txt_balanstotaal_3").val();
         var eigenvermogen_2 = $("#txt_eigenvermogen_2").val();        
        var balanstotaal_2 = $("#txt_balanstotaal_2").val();

        if (eigenvermogen_2 != '' && balanstotaal_2 != '') {            
            var percent2 = (eigenvermogen_2 / balanstotaal_2) * 100;
            percent2 = percent2.toFixed(2);            
        }
        if (eigenvermogen_3 != '' && balanstotaal_3 != '') {            
            var percent3 = (eigenvermogen_3 / balanstotaal_3) * 100;
            percent3 = percent3.toFixed(2);

            if(percent2 != ''){
                percent3 = percent3 > percent2 ? percent3 : percent2;
            }
            $("#h_solvabiliteit").val(percent3);
        }
    }
    if($("#h_solvabiliteit").val()) {

        var data = {
        action: 'ffc_final_result',
        is_ajax: 1
    };
    $.post(ffc.ajaxurl, data, function (response) {
        /* Do Response Process */
        data = $.parseJSON(response);      
        if($("#h_liquiditeit").val()){
            $('#p_notcompleted').html('calculation is accurate !!!');
        } else {$('#p_notcompleted').html(data.liq_wrong_notice);}
       
    });
    }
    
}

function calculate_liquiditeit() {
    var yearselection = $("#h_yearselection").val();
    if (yearselection == '0' || yearselection == '1') {
        var vlottendeactiva_1 = $("#txt_vlottendeactiva_1").val();
        var kortvreemdvermogen_1 = $("#txt_kortvreemdvermogen_1").val();
        if (vlottendeactiva_1 != '' && kortvreemdvermogen_1 != '') {
            var percent = vlottendeactiva_1 / kortvreemdvermogen_1;
            percent = percent.toFixed(2);
            $("#h_liquiditeit").val(percent);
        }
    } else if (yearselection == '2') {

        var vlottendeactiva_2 = $("#txt_vlottendeactiva_2").val();
        var kortvreemdvermogen_2 = $("#txt_kortvreemdvermogen_2").val();

        var vlottendeactiva_1 = $("#txt_vlottendeactiva_1").val();
        var kortvreemdvermogen_1 = $("#txt_kortvreemdvermogen_1").val();
        if (vlottendeactiva_1 != '' && kortvreemdvermogen_1 != '') {
            var percent1 = vlottendeactiva_1 / kortvreemdvermogen_1;
            percent1 = percent1.toFixed(2);
        }
        if (vlottendeactiva_2 != '' && kortvreemdvermogen_2 != '') {
            var percent2 = vlottendeactiva_2 / kortvreemdvermogen_2;
            percent2 = percent2.toFixed(2);

            if(percent1 != ''){
                percent2 = percent1 > percent2 ? percent1 : percent2;
            }
            $("#h_liquiditeit").val(percent2);
        }
    } else if (yearselection == '3') {

        var vlottendeactiva_3 = $("#txt_vlottendeactiva_3").val();
        var kortvreemdvermogen_3 = $("#txt_kortvreemdvermogen_3").val();
        var vlottendeactiva_2 = $("#txt_vlottendeactiva_2").val();
        var kortvreemdvermogen_2 = $("#txt_kortvreemdvermogen_2").val();
         if (vlottendeactiva_2 != '' && kortvreemdvermogen_2 != '') {
            var percent2 = vlottendeactiva_2 / kortvreemdvermogen_2;
            percent2 = percent2.toFixed(2);
        }
        if (vlottendeactiva_3 != '' && kortvreemdvermogen_3 != '') {
            var percent3 = vlottendeactiva_3 / kortvreemdvermogen_3;
            percent3 = percent3.toFixed(2);
            if(percent2 != ''){
                percent3 = percent3 > percent2 ? percent3 : percent2;
            }
            $("#h_liquiditeit").val(percent3);
        }
    }

    if($("#h_liquiditeit").val() != ''){
        
        var data = {
        action: 'ffc_final_result',
        is_ajax: 1
        };
    $.post(ffc.ajaxurl, data, function (response) {
        /* Do Response Process */
        data = $.parseJSON(response);

        if($("#h_solvabiliteit").val() != '') {
            $('#p_notcompleted').html('calculation is accurate');
        } else {
             $('#p_notcompleted').html(data.sol_wrong_notice);
        }      
    });

    } 
}

function partner_selection() {
    var selected = $("input[name='rdo_partner']:checked").val();
    if (selected == '1') {
        $("#div_box4").show();
        $("#div_box4_1").hide();
        var data = {
        action: 'ffc_final_result',
        is_ajax: 1
    };
    $.post(ffc.ajaxurl, data, function (response) {
        /* Do Response Process */
        data = $.parseJSON(response);      

       $('#p_notcompleted').html(data.p_sol_liq_wrong_notice);
    });
    } else {
        $("#div_box4").hide();
        $("#div_box5").hide();
    }
}

$(document).ready(function () {
    $("input[name$='rdo_partnertype']").click(function () {
        var partnertypeval = $(this).val();
        $("#h_partnertypeselection").val(partnertypeval);
        $("#div_box4_1").show();
        if (partnertypeval == '1') {
            $("#div_loondienst").show();
            $("#div_box4_1").hide();
            $("#div_forhalfyearp").hide();
        } else {
            $("#div_loondienst").hide();
            $("#div_box4_1").show();
            $("#div_forhalfyearp").show();
        }
        if (partnertypeval == '4') {
            $("#div_inkomensgegevensp_1").show();
            $("#div_inkomensgegevensp_2").show();
            $("#div_inkomensgegevensp_3").show();
        } else {

            $("#div_inkomensgegevensp_1").hide();
            $("#div_inkomensgegevensp_2").hide();
            $("#div_inkomensgegevensp_3").hide();
        }

        $("#div_box5").show();
        if (partnertypeval == '2') {
            $("#div_rangeslider").html('<input id="single_slider_2" type="hidden" value="0"/><div class="gray-line1"></div><div class="gray-line2"></div><div class="gray-line3"></div><div class="gray-line4"></div>');
            $("#div_rangeslider").addClass('demo-output2');
        } else {
            $("#div_rangeslider").html('<input id="single_slider_2" type="hidden" value="0"/><div class="gray-line1"></div><div class="gray-line2"></div><div class="gray-line3"></div>');
            $("#div_rangeslider").removeClass('demo-output2');
        }
        load_year_range_partner();
        if (partnertypeval == '2') {
            $('#single_slider_2').jRange('updateRange', '0.5,3', '0');
        } else {
            $('#single_slider_2').jRange('setValue', '1');
        }

    });
});

function load_year_range_partner() {
    var typeselection = $("#h_partnertypeselection").val();

    if (typeselection == '2') {
        var range_from = 0;
        var range_scale = [0.5, 1.0, 2.0, 3.0];
    } else {
        var range_from = 1;
        var range_scale = [1, 2, 3];
    }
    $("#single_slider_2").jRange({
        from: range_from,
        to: 3,
        step: 1,
        scale: range_scale,
        format: "%s",
        width: 500,
        showLabels: false,
        snap: true,
        onstatechange: function (value) {
            
            $("#div_winstuitondernemingp").hide();

            

            if (typeselection != '1') {
                $("#h_partneryearselection").val(value);

                if (value == '0') {
                    $("#div_forhalfyearp").show();
                } else if (value == "1") {
                    $("#div_forhalfyearp").hide();
                    if (typeselection == '4') {
                        $("#div_inkomensgegevensp_2 :input").attr("disabled", true);
                        $("#div_inkomensgegevensp_3 :input").attr("disabled", true);
                    } else {
                        $("#div_winstuitondernemingp").show();
                        $("#div_winstuitondernemingp_2 :input").attr("disabled", true);
                        $("#div_winstuitondernemingp_3 :input").attr("disabled", true);
                    }

                    $("#div_solvabiliteitp_2 :input").attr("disabled", true);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", true);

                    $("#div_liquiditeitp_2 :input").attr("disabled", true);
                    $("#div_liquiditeitp_3 :input").attr("disabled", true);
                } else if (value == "2") {
                    $("#div_forhalfyearp").hide();
                    if (typeselection == '4') {
                        $("#div_inkomensgegevensp_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevensp_3 :input").attr("disabled", true);
                    } else {
                        $("#div_winstuitondernemingp").show();
                        $("#div_winstuitondernemingp_2 :input").attr("disabled", false);
                        $("#div_winstuitondernemingp_3 :input").attr("disabled", true);
                    }

                    $("#div_solvabiliteitp_2 :input").attr("disabled", false);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", true);

                    $("#div_liquiditeitp_2 :input").attr("disabled", false);
                    $("#div_liquiditeitp_3 :input").attr("disabled", true);
                } else if (value == "3") {
                    $("#div_forhalfyearp").hide();
                    if (typeselection == '4') {
                        $("#div_inkomensgegevensp_2 :input").attr("disabled", false);
                        $("#div_inkomensgegevensp_3 :input").attr("disabled", false);
                    } else {
                        $("#div_winstuitondernemingp").show();
                        $("#div_winstuitondernemingp_2 :input").attr("disabled", false);
                        $("#div_winstuitondernemingp_3 :input").attr("disabled", false);
                    }

                    $("#div_solvabiliteitp_2 :input").attr("disabled", false);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", false);

                    $("#div_liquiditeitp_2 :input").attr("disabled", false);
                    $("#div_liquiditeitp_3 :input").attr("disabled", false);
                }
            } else {
                $("#div_solvabiliteitp_2 :input").attr("disabled", true);
                    $("#div_solvabiliteitp_3 :input").attr("disabled", true);

                    $("#div_liquiditeitp_2 :input").attr("disabled", true);
                    $("#div_liquiditeitp_3 :input").attr("disabled", true);
            }
        }
    });
}
function calculate_solvabiliteitp() {

    var yearselection = $("#h_partneryearselection").val();
    if (yearselection == '0' || yearselection == '1') {
        var eigenvermogen_1 = $("#txt_eigenvermogenp_1").val();
        var balanstotaal_1 = $("#txt_balanstotaalp_1").val();
        if (eigenvermogen_1 != '' && balanstotaal_1 != '') {
            var percent = (eigenvermogen_1 / balanstotaal_1) * 100;
            percent = percent.toFixed(2);
            $("#h_solvabiliteitp").val(percent);
        }
    } else if (yearselection == '2') {

        var eigenvermogen_1 = $("#txt_eigenvermogenp_1").val();
        var balanstotaal_1 = $("#txt_balanstotaalp_1").val();
        if (eigenvermogen_1 != '' && balanstotaal_1 != '') {
            var percent = (eigenvermogen_1 / balanstotaal_1) * 100;
            percent = percent.toFixed(2);
        }
        var eigenvermogen_2 = $("#txt_eigenvermogenp_2").val();
        var balanstotaal_2 = $("#txt_balanstotaalp_2").val();
        if (eigenvermogen_2 != '' && balanstotaal_2 != '') {
            var percent2 = (eigenvermogen_2 / balanstotaal_2) * 100;
            percent2 = percent2.toFixed(2);

            if(percent != ''){
                percent2 = percent2 > percent ? percent2 : percent;
            }
            $("#h_solvabiliteitp").val(percent2);
        }
    } else if (yearselection == '3') {
        var eigenvermogen_2 = $("#txt_eigenvermogenp_2").val();
        var balanstotaal_2 = $("#txt_balanstotaalp_2").val();
        if (eigenvermogen_2 != '' && balanstotaal_2 != '') {
            var percent2 = (eigenvermogen_2 / balanstotaal_2) * 100;
            percent2 = percent2.toFixed(2);  
        }
        var eigenvermogen_3 = $("#txt_eigenvermogenp_3").val();
        var balanstotaal_3 = $("#txt_balanstotaalp_3").val();
        if (eigenvermogen_3 != '' && balanstotaal_3 != '') {
            var percent3 = (eigenvermogen_3 / balanstotaal_3) * 100;
            percent3 = percent3.toFixed(2);
            if(percent2 != ''){
                percent3 = percent3 > percent2 ? percent3 : percent2;
            }
            $("#h_solvabiliteitp").val(percent3);
        }
    }

    if($("#h_solvabiliteitp").val() != ''){

        var data = {
        action: 'ffc_final_result',
        is_ajax: 1
        };
        $.post(ffc.ajaxurl, data, function (response) {
            /* Do Response Process */
            data = $.parseJSON(response);      

           $('#p_notcompleted').html(data.p_liq_wrong_notice);
        });
    }
}

function calculate_liquiditeitp() {
    var yearselection = $("#h_partneryearselection").val();
    if (yearselection == '0' || yearselection == '1') {
        var vlottendeactiva_1 = $("#txt_vlottendeactivap_1").val();
        var kortvreemdvermogen_1 = $("#txt_kortvreemdvermogenp_1").val();
        if (vlottendeactiva_1 != '' && kortvreemdvermogen_1 != '') {
            var percent = vlottendeactiva_1 / kortvreemdvermogen_1;
            percent = percent.toFixed(2);
            $("#h_liquiditeitp").val(percent);
        }
    } else if (yearselection == '2') {
        var vlottendeactiva_2 = $("#txt_vlottendeactivap_2").val();
        var kortvreemdvermogen_2 = $("#txt_kortvreemdvermogenp_2").val();

        var vlottendeactiva_1 = $("#txt_vlottendeactivap_1").val();
        var kortvreemdvermogen_1 = $("#txt_kortvreemdvermogenp_1").val();
        if (vlottendeactiva_1 != '' && kortvreemdvermogen_1 != '') {
            var percent = vlottendeactiva_1 / kortvreemdvermogen_1;
            percent = percent.toFixed(2);
            $("#h_liquiditeitp").val(percent);
        }
        if (vlottendeactiva_2 != '' && kortvreemdvermogen_2 != '') {
            var percent2 = vlottendeactiva_2 / kortvreemdvermogen_2;
            percent2 = percent2.toFixed(2); 
            if(percent != '') {
                percent2 = percent > percent2 ? percent : percent2;
            }          
            $("#h_liquiditeitp").val(percent2);
        }
    } else if (yearselection == '3') {
        var vlottendeactiva_2 = $("#txt_vlottendeactivap_2").val();
        var kortvreemdvermogen_2 = $("#txt_kortvreemdvermogenp_2").val();

        var vlottendeactiva_3 = $("#txt_vlottendeactivap_3").val();
        var kortvreemdvermogen_3 = $("#txt_kortvreemdvermogenp_3").val();

         if (vlottendeactiva_2 != '' && kortvreemdvermogen_2 != '') {
            var percent2 = vlottendeactiva_2 / kortvreemdvermogen_2;
            percent2 = percent2.toFixed(2);            
        }

        if (vlottendeactiva_3 != '' && kortvreemdvermogen_3 != '') {
            var percent3 = vlottendeactiva_3 / kortvreemdvermogen_3;

             if(percent2 != '') {
                percent3 = percent2 > percent3 ? percent2 : percent3;
            }          
            $("#h_liquiditeitp").val(percent3);            
        }
    }
        var data = {
        action: 'ffc_final_result',
        is_ajax: 1
        };
        $.post(ffc.ajaxurl, data, function (response) {
            /* Do Response Process */
            data = $.parseJSON(response);

            if($("#h_liquiditeitp").val() != ''){
                if($("#h_solvabiliteitp").val() == ''){
                $('#p_notcompleted').html(data.p_sol_wrong_notice);
                } else {$('#p_notcompleted').html('calculation is accurate');} 
            } else {
                $('#p_notcompleted').html(data.p_liq_wrong_notice);
            }
          
        });
     
}