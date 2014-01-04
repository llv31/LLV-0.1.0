$(document).ready(function () {
    $('input.jq-datepicker').datepicker({
        changeMonth:true,
        changeYear:true,
        showOtherMonths:true,
        selectOtherMonths:true,
        numberOfMonths:2,
        minDate:0,
        maxDate:"+5Y",
        regional:"fr"
    });
    $('.arrivee').datepicker({
        changeMonth:true,
        changeYear:true,
        showOtherMonths:true,
        selectOtherMonths:true,
        numberOfMonths:2,
        minDate:0,
        maxDate:"+5Y",
        regional:"fr",
        onClose:function (selectedDate) {
            $(".depart").datepicker("option", "minDate", selectedDate);
        }
    });
    $('.depart').datepicker({
        changeMonth:true,
        changeYear:true,
        showOtherMonths:true,
        selectOtherMonths:true,
        numberOfMonths:2,
        minDate:0,
        maxDate:"+5Y",
        regional:"fr",
        onClose:function (selectedDate) {
            $(".arrivee").datepicker("option", "maxDate", selectedDate);
        }
    });

    /**
     *
     */
    $('.infobulle').popover(
        {
            placement:'top',
            trigger:'hover',
            html:true,
            container:'body'
        }
    )

    /**
     *
     */
    $("a.contact-button").click(function () {
        var $that = $(this),
            id = $that.attr('id'),
            $targetParent = $("select[name=location]"),
            $target = $targetParent.find('option[id=' + id + ']');
        $targetParent.find('option').attr('selected', '');
        $target.attr('selected', 'selected');
    });

    /**
     *
     */
    $("form[name=reservation]").validate(
        {
            rules:{
                nom:"required",
                prenom:"required",
                email:{
                    required:true,
                    email:true
                },
                telephone:{
                    required:true,
                    digits:true
                },
                adresse:"required",
                location:{
                    required:true,
                    minlength:1
                },
                adultes:{
                    required:true,
                    digits:true,
                    min:1
                },
                enfants:{
                    required:true,
                    digits:true
                },
                arrivee:{
                    required:true,
                    date:true
                },
                depart:{
                    required:true,
                    date:true
                },
                agezegaga:{
                    maxlength:0
                }
            },
            messages:{
                nom:"",
                prenom:"",
                email:"",
                telephone:"",
                adresse:"",
                location:"",
                adultes:"",
                enfants:"",
                arrivee:"",
                depart:""
            }
        }
    );
    $("form[name=question]").validate(
        {
            rules:{
                nom:"required",
                prenom:"required",
                message:"required",
                email:{
                    required:true,
                    email:true
                },
                telephone:{
                    required:true,
                    digits:true
                },
                agezegaga:{
                    maxlength:0
                }
            },
            messages:{
                nom:"",
                prenom:"",
                email:"",
                telephone:"",
                message:""
            }
        }
    );
});