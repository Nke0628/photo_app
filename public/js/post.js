$(function(){

	$('.favorite').click(function(){
		$('.photo-list').css('display','none');
		$('.favorite-list').css('display','flex');
	});


	$('.photo').click(function(){
		$('.favorite-list').css('display','none');
		$('.photo-list').css('display','flex');
	});

});


//Ajaxいいねボタン機能
function rmaddGood(){
	var id = $(".post-id").val();
	if($('.good').hasClass('color-red')){
		var rmaddflag = 'rm';
	}
	else{
		var rmaddflag = 'add';
	}
	$.ajax({
		headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:'/likes',
		type:'POST',
		datatype:'json',
		data:{
			item:id,
			flag:rmaddflag
		}
	})
	.done(function(data){
		var res = JSON.parse(data);
		$('.good-count').html(res.good_count);

		if(rmaddflag==='rm'){
			$('.fas').removeClass('color-red');
		}
		else{
			$('.fas').addClass('color-red');

		}
	})
	.fail(function(data){
		alert(data.responseJSON);
	})
}

