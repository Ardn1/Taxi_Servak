	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Заявки на аренду: <span class="text-primary">новые</span></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="<?php echo base_url('my/rent');?>" class="btn btn-sm btn-success">Новые</a>
				<a href="<?php echo base_url('my/rent/accept');?>" class="btn btn-sm btn-outline-success">Принятые</a>
				<a href="<?php echo base_url('my/rent/uncorrect');?>" class="btn btn-sm btn-outline-success">Исправить фото</a>
                <a href="<?php echo base_url('my/rent/fail');?>" class="btn btn-sm btn-outline-success">Отказано</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        	<?php if ($total_records) : ?>
        	<div class="">
			  	<table class="table table-hover">
			    	<thead>
			    		<tr>
							<th>
							<input type="checkbox" id ="all">
							</th>
							<th>
							<div class="dropdown" id="mainB">
								  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    	Обработать
								  	</button>
								  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								    	<a class="dropdown-item" onclick = "RentAll()">Направить на аренду</a>
										<a class="dropdown-item" onclick = "DenyAll()">Отказать</a>
										<a class="dropdown-item" onclick = "UncorrectAll()">Исправить фото</a>
                                        <?php if ($this->user->ismanager==0): ?>
                                            <a class="dropdown-item text-danger" onclick = "RemoveAll()">Удалить</a>
                                        <?php endif;?>
										
								</div>
							</div>
							</th>
			    			<th>Получено</th>
			    			<th></th>
			    			<th>Клиент</th>
			    			<th>Возраст</th>
			    			<th>Город</th>
			    			<th>Телефон</th>
							<th>Источник</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($rent as $data) : ?>
			    		<tr>
							<td width="3%"><input type="checkbox" id = "one_ch" IDAPI = "<?php echo $data->id;?>" style="width =5%" unchecked/></td>
							<td width="7%"></td>
			    			<td width="15%"><?php echo $data->created;?></td>
			    			<td width="5%">
			    				<?php if ($data->citizenship == 1) : ?>
			    				<img src="<?php echo base_url('themes/bootstrap/img/russia.png');?>" class="flag-img" data-toggle="tooltip" data-placement="right" title="Российская Федерация">
			    				<?php elseif ($data->citizenship == 2) : ?>
			    				<img src="<?php echo base_url('themes/bootstrap/img/belarus.png');?>" class="flag-img" data-toggle="tooltip" data-placement="right" title="Беларусь">
			    				<?php elseif ($data->citizenship == 3) : ?>
			    				<img src="<?php echo base_url('themes/bootstrap/img/kyrgyzstan.png');?>" class="flag-img" data-toggle="tooltip" data-placement="right" title="Киргизия">
			    				<?php elseif ($data->citizenship == 4) : ?>
			    				<img src="<?php echo base_url('themes/bootstrap/img/kazakhstan.png');?>" class="flag-img" data-toggle="tooltip" data-placement="right" title="Казахстан">
								<?php elseif ($data->citizenship == 5) : ?>
			    				<img src="<?php echo base_url('themes/bootstrap/img/other.png');?>" class="flag-img" data-toggle="tooltip" data-placement="right" title="Другое">
			    				<?php endif; ?>
			    			</td>
			    			<td><?php echo $data->first_name;?> <?php echo $data->last_name;?></td>
			    			<td><?php echo $data->age;?></td>
			    			<td>
			    				<?php if ($data->city == 1) : ?>
			    				Москва
			    				<?php endif; ?>
								<?php if ($data->city == 2) : ?>
								Санкт-Петербург
			    				<?php endif; ?>
								<?php if ($data->city == 3) : ?>
								Волгоград
			    				<?php endif; ?>
								<?php if ($data->city == 4) : ?>
								Воронеж
			    				<?php endif; ?>
								<?php if ($data->city == 5) : ?>
								Екатеринбург
			    				<?php endif; ?>
								<?php if ($data->city == 6) : ?>
								Казань
			    				<?php endif; ?>
								<?php if ($data->city == 7) : ?>
								Краснодар
			    				<?php endif; ?>
								<?php if ($data->city == 8) : ?>
								Красноярск
			    				<?php endif; ?>
								<?php if ($data->city == 9) : ?>
								Нижний Новгород
			    				<?php endif; ?>
								<?php if ($data->city == 10) : ?>
								Новосибирск
			    				<?php endif; ?>
								<?php if ($data->city == 11) : ?>
								Омск
			    				<?php endif; ?>
								<?php if ($data->city == 12) : ?>
								Пермь
			    				<?php endif; ?>
								<?php if ($data->city == 13) : ?>
								Ростов-на-Дону
			    				<?php endif; ?>
								<?php if ($data->city == 14) : ?>
								Самара
			    				<?php endif; ?>
								<?php if ($data->city == 15) : ?>
								Саратов
			    				<?php endif; ?>
								<?php if ($data->city == 16) : ?>
								Тольятти
			    				<?php endif; ?>
								<?php if ($data->city == 17) : ?>
								Тюмень
			    				<?php endif; ?>
								<?php if ($data->city == 18) : ?>
								Ульяновск
			    				<?php endif; ?>
								<?php if ($data->city == 19) : ?>
								Уфа
			    				<?php endif; ?>
								<?php if ($data->city == 20) : ?>
								Челябинск
			    				<?php endif; ?>
								<?php if ($data->city == 21) : ?>
								Энгельс
			    				<?php endif; ?>
								<?php if ($data->city == 22) : ?>
								Ярославль
			    				<?php endif; ?>
								<?php if ($data->city == 23) : ?>
								Другой
			    				<?php endif; ?>
			    			</td>
			    			<td>+<?php echo $data->phone;?></td>
							<td>
								<?php if ($data->api == 0) : ?>
			    					API 1
			    				<?php elseif ($data->api == 1) : ?>
									API 2
			    				<?php endif; ?>
							</td>
			    			<td class="text-right">
			    				<div class="dropdown">
								  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    	Обработать
								  	</button>
								  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								  		<?php if (!$data->status) : ?>
                                            <a class="dropdown-item" href="<?php echo base_url('my/rent/edit/'.$data->id).'/1';?>">Посмотреть заявку</a>
											<a class="dropdown-item" href="<?php echo base_url('my/rent/success/'.$data->id);?>">Направить на аренду</a>
											<a class="dropdown-item" href="<?php echo base_url('my/rent/uncorrectset/'.$data->id);?>">Исправить фото</a>
								    		<a class="dropdown-item" href="<?php echo base_url('my/rent/reject/'.$data->id);?>">Отказать</a>
								    	<?php endif; ?>
                                        <?php if ($this->user->ismanager==0): ?>
                                            <a class="dropdown-item text-danger" href="<?php echo base_url('my/rent/delete/'.$data->id.'/1');?>">Удалить</a>
                                        <?php endif;?>
								  	</div>
								</div>
			    			</td>
			    		</tr>
			    		<?php endforeach; ?>
			    	</tbody>
			  	</table>
			</div>
        	<?php else : ?>
        	<div class="text-center mt-5">
        		<img src="<?php echo base_url('themes/bootstrap/img/2.svg');?>" class="empty-img mb-4">
        		<h5>Заявок на аренду пока нет</h5>
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

	var urlSuccsess = "<?php echo base_url('my/rent/success/');?>"	
	var urlReject = "<?php echo base_url('my/rent/reject/');?>"	
	var urlDelete = "<?php echo base_url('my/rent/delete/');?>"	
	var urlUncorrect = "<?php echo base_url('my/rent/uncorrectset/');?>"	

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

	async function RentAll() {  
		for(var i = 0; i < all.length; i++) 
		{ 
			if (all[i].checked == true)
				await rentOne(all[i].getAttribute("IDAPI"));
		}
		location.reload();
	}
	async function DenyAll() {  
		for(var i = 0; i < all.length; i++) 
		{ 
			if (all[i].checked == true)
				await denyOne(all[i].getAttribute("IDAPI"));
		}
		location.reload();
	}
	async function RemoveAll() {  
		for(var i = 0; i < all.length; i++) 
		{ 
			if (all[i].checked == true)
				await removeOne(all[i].getAttribute("IDAPI"));
		}
		location.reload();
	}
	async function UncorrectAll() {  
		for(var i = 0; i < all.length; i++) 
		{ 
			if (all[i].checked == true)
				await uncorrectOne(all[i].getAttribute("IDAPI"));
		}
		location.reload();
	}

	async function rentOne(id)
	{
		await $.get(urlSuccsess + id + '/1', {
			}, onAjaxSuccess);
	}
	async function denyOne(id)
	{
		await $.get(urlReject + id + '/1', {
			}, onAjaxSuccess);
	}
	async function removeOne(id)
	{
		await $.get(urlDelete + id + '/0', {
			}, onAjaxSuccess);
	}
	async function uncorrectOne(id)
	{
		await $.get(urlUncorrect + id + '/1', {
			}, onAjaxSuccess);
	}

	function onAjaxSuccess(data)
	{
		/*if(data==="Отправлено"){
            swal ( "Уведомление" ,  "Успешно применено" ,  "success" )
        } else {
            swal ( "Уведомление" ,  data ,  "error" )
        }*/
	}

</script>