<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Рассылка на выбранные номера</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="" style="width:95%; margin-left: 2.5%"> 
                            <label>Сообщение</label>
                            <input type="" class="form-control form-control-sm" name="textSMS" id="textSMS">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" baseURL = "<?php echo base_url('my/mailing/sendSMS/');?>" onclick="sendAll(this)">Отправить</button>
                </div>
            </div>
        </div>
	</div>

	<div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url("my/Mailing/addphone")) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="" style="width:95%; margin-left: 2.5%"> 
                            <label>Телефон</label>
                            <input type="" class="form-control form-control-sm" name="phone">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Добавить</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
	</div>

    <div class="row">
        <div class="col-md-12">
        	<?php if ($total_records) : ?>
        	<div class="">
			  	<table class="table table-hover">
			    	<thead>
			    		<tr>
							<th><input type="checkbox" id ="all"></th>
							<th>Номер телефона</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($phones as $data) : ?>
			    		<tr>
							<td width="3%"><input type="checkbox" id = "one_ch" phoneForAPI = "<?php echo $data->phone;?>" style="width =5%" unchecked/></td>
							<td width="75%"><?php echo $data->phone;?></td> 
							
			    			<td class="text-right">
			    				<div class="dropdown">
								  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    	Обработать
								  	</button>
								  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								    	<a class="dropdown-item text-danger" href="<?php echo base_url('my/mailing/delete/'.$data->id);?>">Удалить</a>
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
        		<h5>Телефонов для рассылки пока нет</h5>
        		<p class="text-muted"></p>
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

	function sendAll(obj)
	{
		let input = document.querySelector("#textSMS");
		for(var i = 0; i < all.length; i++) 
		{ 
			if (all[i].checked == true)
				sendOne(obj.getAttribute("baseURL"), input.value, all.getAttribute("phoneForAPI"));
		}
	}

	function sendOne(url, text, phone)
	{
		let input = document.querySelector("#textSMS");
		$.get(
		url,
		{
			phones: phone,
			textSMS: text,
		},
			onAjaxSuccess
		);
	}

	function onAjaxSuccess(data)
	{
		alert(data);
	}
	
</script>