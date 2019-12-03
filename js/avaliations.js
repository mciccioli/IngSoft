$(function(){
	var average = $('.ratingAverage').attr('data-average');
	function avaliacao(average){
		average = (Number(average)*20);
		$('.bg').css('width', 0);		
		$('.barra .bg').animate({width:average+'%'}, 500);
	}
	
	avaliacao(average);

	
});
