require('./bootstrap');
let $ = require('jquery');
require('select2');
require('./main');

require('popper.js');

$(document).ready(()=> {
    $('.clients_select').select2();
    $("#check-all").click(function(){
        if ($("#check-all").is(':checked') ){
            $(".clients_select").find('option').prop("selected",true);
            $(".clients_select").trigger('change');
        } else {
            $(".clients_select").find('option').prop("selected",false);
            $(".clients_select").trigger('change');
        }
    });
});