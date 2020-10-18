	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Обратная связь: <span class="text-danger">архив</span></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="<?php echo base_url('my/feedback');?>" class="btn btn-sm btn-outline-success">Новые</a>
                <a href="<?php echo base_url('my/feedback/archive');?>" class="btn btn-sm btn-success">Архив</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        	<?php if ($total_records) : ?>
        	<div class="table-responsive">
			  	<table class="table table-hover">
			    	<thead>
			    		<tr>
						<th><input type="checkbox" id ="all"></th>
							<th>
							<?php if ($this->user->ismanager==0): ?>
                                            <a class="btn btn-outline-secondary btn-sm" onclick = "RemoveAll()" style="cursor: pointer">Удалить</a>
                                        <?php endif;?>
							</th>
			    			<th>Получено</th>
			    			<th>Клиент</th>
			    			<th>Телефон</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($messages as $data) : ?>
			    		<tr>
							<td width="3%"><input type="checkbox" id = "one_ch" IDForAPI = "<?php echo $data->id;?>" style="width =5%" unchecked/></td>
							<td width="7%"></td>
			    			<td width="20%"><?php echo $data->created;?></td>
			    			<td><?php echo $data->name;?></td>
			    			<td><?php echo $data->phone;?></td>
			    			<td class="text-right">
			    				<a href="<?php echo base_url('my/feedback/edit/'.$data->id);?>" class="btn btn-outline-secondary btn-sm">Смотреть</a>
			    			</td>
			    		</tr>
			    		<?php endforeach; ?>
			    	</tbody>
			  	</table>
			</div>
        	<?php else : ?>
        	<div class="text-center mt-5">
        		<img src="<?php echo base_url('themes/bootstrap/img/1.svg');?>" class="empty-img mb-4">
        		<h5>Сообщений пока нет</h5>
        		<p class="text-muted">Но они обязательно будут</p>
        	</div>
        	<?php endif; ?>
        </div>
    </div>

    <?php if (!empty($links)) : ?>
	    <div class="row mt-3">
	        <div class="col-md-12">
	            <?php echo $links ?>
	        </div>
	    </div>
	<?php endif; ?>

<script>
	var main = document.querySelector("#all");
	var all = document.querySelectorAll("#one_ch");
	var urlDelete = "<?php echo base_url('my/feedback/delete_message/');?>"	

	for(var i=0; i<all.length; i++) {  // 1 и 2 пункт задачи
		all[i].onclick = function() {
			var sum = 0;
			for(var i = 0; i < all.length; i++) { 
				if (all[i].checked == true)
					sum++;
			}
			main.checked = sum == all.length;
			main.indeterminate = sum > 0 && sum < all.length;
		}
	}

	main.onclick = function() {  // 3
		for(var i=0; i<all.length; i++) {
			all[i].checked = this.checked;
		}
	}


	async function RemoveAll() {  
		for(var i = 0; i < all.length; i++) 
		{ 
			if (all[i].checked == true)
				await removeOne(all[i].getAttribute("IDForAPI"));
		}
		location.reload();
		//swal ( "Телефон" ,  "Успешно удален!" ,  "success" )
	}

	async function removeOne(id)
	{
		await $.get(urlDelete + id + '/-1', {
			}, onAjaxSuccess);
	}

	function onAjaxSuccess(data)
	{
	//	if (data==="Отправлено"){
     //       swal ( "Сообщение" ,  "Успешно разослано" ,  "success" )
     //   } else {
      //      swal ( "Сообщение" ,  data ,  "error" )
     //   }
	}

</script>