$(document).ready(function () {
    $(function () {  
    $(".hasDatepicker").datepicker({         
    autoclose: true,         
    todayHighlight: true 
    }).datepicker('update', new Date());
    });
    
    $("#pay1").click(function (e) { 
        e.preventDefault();
        $("#credit").show();
    });
});