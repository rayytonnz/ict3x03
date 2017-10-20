$(document).ready(function () {
    $('.OTPnumber').hide();
    $('tr td.expand').find("p").hide();
    $('tr td.expand').find("button").hide();

    $('.clickable-row').click(function (e) {
        $('tr td.expand').find("p").hide();
        $('tr td.expand').find("button").hide();
        $('tr td.tdcredit').css('background-color', '#C0C0C0');
        e.stopPropagation();

        $('button.expand_button').html("+");

        var $target = $(e.target);
        $target.closest('tr').children('td').css('background-color', '#000');
        if ($target.closest("td").attr("colspan") > 1) {
            $target.slideUp();
        } else {
            $target.closest("tr").next().find("p").slideToggle();
            $target.closest("tr").next().find("button").slideToggle();
            $target.closest("tr").find("button").html("-");
        }
    });

    $('button.buttoncredit').click(function (e) {
        var OTPnumber = $(e.target).val();
        var arr = OTPnumber.split(',');
        alert("You have chosen " + arr[1]);
        $('.OTPnumber').show();  
        $("p.value").text("You have Selected " + arr[1] + " with the value of " + arr[2]);
        $("input.credit_otppid").attr('value', arr[0]);
    });

    $("form").submit(function () {
        var phone_number = $("input.phone_number").val();
        if (phone_number.length != 8) {
            alert("Length of Mobile number must be 8!");
            $("#error_message").text("Length of mobile number cannot be more than 8!");
            return false;
        }
        if (isNaN(phone_number)) {
            alert("Mobile number must be integer!");
            $("#error_message").text("Mobile number must be integer!");
            return false;
        }
        return true;
    });

    $("input.phone_number").on('keyup',function (e) {
        if ($(this).val().length > 8) {
            $("#error_message").text("Length of mobile number cannot be more than 8!");
        }else if (isNaN($(this).val())) {
            $("#error_message").text("Mobile number must be integer!");
        }else{
             $("#error_message").text("Acceptable");
        }
    });

});

