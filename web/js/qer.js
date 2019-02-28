$('#exit').on('click', function() {
	//alert('exit='+$.session);
	location.href='index.php';
});
$('[data-trigger="edit"]').on('click', function() {
	//alert($(this).data('item'));
	location.href='index.php?r=site/edit&as='+$(this).data('item');
});
$('[data-trigger="del"]').on('click', function() {
	$("[name='book_id']").val($(this).data('item'));
	$("button").submit();
});
//													form avtor
$('#avtor_sel').on('change', function() {
	if($(this).val()=='add'){
		ttl='Добавить автора';
		btn='добавить';
	}
	else{
		ttl='Редактировать автора';
		btn='редактировать';
	}
	$('#ttl_avtor').html(ttl);
	$('#btn_avtor').html(btn);
});
//													form book
$('#book_edt').ready(function(){	
	dta=$('#book_sel').val();
	eqwer(dta);
	
});
$('#book_sel').on('change', function(){	
	dta=$(this).val();
	eqwer(dta);
});

function eqwer(dta){
	if(dta=='' || dta=='add'){
		ttl='Добавить книгу';
		btn='добавить';
		val_book=0;
		
		$('#book_name').val('');
		$('#book_year').val('');
		$('#book_genre').val('');
		$('#book_page').val('');
		$('#book_img').attr('src','art/site/non.png');
	}
	else{		
		ttl='Редактировать книгу';
		btn='редактировать';
		val_book=$('#book_sel :selected').closest('optgroup').prop('label');
		
		var data = {};
		data['bid'] = dta;
		$.getJSON(
			'/weron/web/index.php?r=data/get_book',//$(this).data('url'), //URL
			data, // GET-параметры
			function(response, statusCode, xhr) {// Обработчик ответа сервера
				$('#book_name').val(response['name']);
				$('#book_year').val(response['year']);
				$('#book_genre').val(response['genre']);
				$('#book_page').val(response['page']);
				if(response['src']!='') $('#book_img').attr('src','art/book/'+decodeURIComponent(val_book)+'/'+response['src']);
				else $('#book_img').attr('src','art/site/non.png');
				//alert(str);
			}
		);
    }
	$('#book_avtor option').each(function(){
		//alert(this.text);
		$('#book_avtor :contains('+this.text+')').removeAttr("selected");
		});
	if(val_book==0) $('#book_avtor :first').attr("selected", true);
	else $('#book_avtor :contains('+val_book+')').attr("selected", true);
	$('#ttl_book').html(ttl);
	$('#btn_book').html(btn);	
}

$('#book_avtor').on('change', function() {
	val_avtor=$('#book_avtor :selected').text();
	//alert(val_avtor);
	$('#book_sel optgroup').each(function(){		
		$('#book_sel optgroup').show();
		if($('#book_avtor :selected').index()>0) $('#book_sel optgroup[label!="'+val_avtor+'"]').hide();
		});
});


/*
$("[data-trigger=viber]").on("click", function() {
	//alert('z');
	//alert($(this).data('item'));
	var data = {};
	data['bid'] = $(this).data('item');
	data['sel_filter'] = $("[name='sel_filter']").val();
	data['inp_filter'] = $("[name='inp_filter']").val();
	data['sel_type'] = $("[name='sel_type']").val();
	data['sel_sort'] = $("[name='sel_sort']").val();
	//alert($("[name='sel_filter']").val());
	$.getJSON(
		'/weron/web/index.php?r=data/del_book',//$(this).data('url'), //URL
		data, // GET-параметры
		// Обработчик ответа сервера
        function(response, statusCode, xhr) {
			str='';
			for(customer in response) str+='<tr><td>'+response[customer]["avtor"]+'</td><td>'+response[customer]["name"]+'</td><td align="center">'+response[customer]['year']+'</td><td>'+response[customer]['genre']+'</td><td align="center">'+response[customer]['page']+'</td><td align="center"><img class="pointer" src="art/site/edit.png" alt="Редактировать" />&nbsp&nbsp;<img class="pointer" src="art/site/delete.png" data-trigger="viber" data-item="'+response[customer]['id']+'" alt="Удалить" /></td></tr>';
			
			//alert($(body_all).html());
			$(body_all).html(str);
			alert(str);
			//for(customer in response) alert(customer+'|'+response[customer]['name']);
        }
    );
});

/*

<tbody id="body_all">
<?php foreach ($customers as $customer){ ?>
	<tr><td><?=$customer['avtors']['name']?></td><td><?=$customer['name']?></td><td align="center"><?=$customer['year']?></td><td><?=$customer['genre']?></td><td align="center"><?=$customer['page']?></td><?php ($session!='Гость'?print '<td align="center"><img class="pointer" src="art/site/edit.png" alt="Редактировать" />&nbsp&nbsp;<img class="pointer" src="art/site/delete.png" data-trigger="viber" data-item="'.$customer['id'].'"  data-url="'.\yii\helpers\Url::to(['/data/del_book']).'" alt="Редактировать" /></td>':'') ?></tr>
<?php } ?>
</tbody> 

// Вешаем обработчик события onchange
$("[data-trigger=dep-drop]").on("change", function() {
    // Собираем данные для отправки в действие контроллера
    var data = {};
    data[$(this).attr("data-name")] = $(this).val();
    // Контейнер для помещения ответа от сервера
    var target = $(this).attr("data-target");
    // Непосредственно отправка запроса на сервер
    $.getJSON(
        $(this).attr("data-url"), //URL
        data, // GET-параметры
        // Обработчик ответа сервера
        function(response, statusCode, xhr) {
            var slct = $(target); // jQuery-объект целевого тега
            slct.empty(); // Очищаем текущие <option>
 
            // Обходим каждый элемент массива из ответа сервера
            for (el in response) {
                // И добавляем его в конец <select>
                $("<option value=\"" + el + "\">" + response[el] + "</option>").appendTo(slct);
            }
 
            slct.removeAttr("disabled"); // Удаляем атрибут запрещающий изменение <select>
        }
    );
});

*/