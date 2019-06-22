$(function(){

	$('.favorite').click(function(){
		$('.photo-list').css('display','none');
		$('.favorite-list').css('display','flex');
	});


	$('.photo').click(function(){
		$('.favorite-list').css('display','none');
		$('.photo-list').css('display','flex');
	});

	$('.flash_message').fadeOut(3000);

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

//トップもっと見るボタン
function moreLook(){
	var page = $('.photo-param').val();
	$.ajax({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
	url:'/posts/moreLook',
	type:'GET',
	datatype:'json',
	data:{
		page_number:page
		}
	})
	.done(function(data){
		var res = JSON.parse(data);
		$.each(res,function(index,value){
			var id = res[index].id;
			var file_name = res[index].file_name;
			console.log(res[index].id);
			$('#top-photo').find('.row').append('<div class="mx-auto" style="margin-top:20px"><a class="ph-style-base" href="posts/' + id + '"><img class="ph-style" src="storage/' + file_name + '"width="300px" height="200px"></a>');
		}) 
		
		var page_number = parseInt(page)
		page_number = page_number + 1
		$('.photo-param').val(page_number);

	})
	.fail(function(data){
		alert(data.responseJSON);
	})
}

//フォロ-ボタン機能
function rmaddFollow(){
	$('.follow').addClass('disabled');
	$('.follow').html('✔︎フォロー');
// 	var id = $(".post-id").val();
// 	if($('.good').hasClass('color-red')){
// 		var rmaddflag = 'rm';
// 	}
// 	else{
// 		var rmaddflag = 'add';
// 	}
// 	$.ajax({
// 		headers:{
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		},
// 		url:'/likes',
// 		type:'POST',
// 		datatype:'json',
// 		data:{
// 			item:id,
// 			flag:rmaddflag
// 		}
// 	})
// 	.done(function(data){
// 		var res = JSON.parse(data);
// 		$('.good-count').html(res.good_count);

// 		if(rmaddflag==='rm'){
// 			$('.fas').removeClass('color-red');
// 		}
// 		else{
// 			$('.fas').addClass('color-red');

// 		}
// 	})
// 	.fail(function(data){
// 		alert(data.responseJSON);
// 	})
}

