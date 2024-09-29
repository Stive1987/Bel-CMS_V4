if (typeof jQuery === 'undefined') {
	throw new Error('BEL-CMS requires jQuery')
}
(function($) {
    "use strict";

    $('input[rel="gp"]').each(function() {
        $(this).val(randString($(this)));
    });

    $(".getNewPass").click(function(){
        var field = $('input[rel="gp"]');
        field.val(randString(field));
    });

})(jQuery);

function randString(id) {
    var dataSet = $(id).attr('data-character-set').split(',');  
    var possible = '';
    if($.inArray('a-z', dataSet) >= 0){
        possible += 'abcdefghijklmnopqrstuvwxyz';
    }
    if($.inArray('A-Z', dataSet) >= 0){
        possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    if($.inArray('0-9', dataSet) >= 0){
        possible += '0123456789';
    }
    if($.inArray('#', dataSet) >= 0){
        possible += '![]{}()%&*$#^<>~@|';
    }
    var text = '';
    for(var i=0; i < $(id).attr('data-size'); i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}