jQuery.noConflict();jQuery(document).ready(function(jQuery){jQuery("#formpost").validate({rules:{postTitle:{required:true,minlength:3},signupMobile:{required:true,digits:true,minlength:10,}},messages:{postTitle:{required:"Please provide your name",minlength:"minimum 3 characters required",},signupMobile:{required:"Please provide your mobile no",digits:"Only digits are allowed",minlength:"Only 10 characters are allowed",}}});});