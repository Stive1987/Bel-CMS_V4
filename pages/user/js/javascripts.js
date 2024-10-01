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

    $('.user_add_avatar').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
		$('body').append('<div class="danger" id="alrt_bel_cms">Chargement...</div>');
        $.ajax({
            url: url,
            dataType: 'html',
			type: 'GET',
            success : function(data) {
				console.log(data);
				$('#alrt_bel_cms').addClass('success').empty().append('Avatar mise en place');
			},
			complete: function() {
				bel_cms_alert_box_end(3250);
				setTimeout(function() {
					location.reload(true);
				}, 3250);
			},
			beforeSend:function() {
				$('#alrt_bel_cms').animate({ top: '0px' }, 300);
			},
        });
    });
	
    $('.user_del_avatar').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
		$('body').append('<div class="danger" id="alrt_bel_cms">Chargement...</div>');
        $.ajax({
            url: url,
            dataType: 'html',
			type: 'GET',
            success : function(data) {
				console.log(data);
				$('#alrt_bel_cms').addClass('success').empty().append('Image effacé');
			},
			complete: function() {
				bel_cms_alert_box_end(3250);
				setTimeout(function() {
					//location.reload(true);
				}, 3250);
			},
			beforeSend:function() {
				$('#alrt_bel_cms').animate({ top: '0px' }, 300);
			},
        });
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