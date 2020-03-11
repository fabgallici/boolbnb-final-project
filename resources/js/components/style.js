module.exports = {

    buttonChange: function(){
        $(".show-hide").click(function(){
            $(this).text($(this).text() == 'Mostra negli annunci' ? 'Nascondi dagli annunci' : 'Mostra negli annunci');
            $(this).css('opacity') === '1' ? $(this).css({'opacity':'0.3'}) : $(this).css({'opacity':'1'});
        });
    },


//
}
