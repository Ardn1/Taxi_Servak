<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Добавление новых менеджеров</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url("my/AddMenager/updatemanager")) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="" style="width:42.5%; margin-left: 5%"> 
                            <label>Email адрес</label>
                            <input type="email" class="form-control form-control-sm" name="email">
                        </div>
                        <div class="" style="width:42.5%; margin-left: 5%">
                            <label>Пароль</label>
                            <input type="" class="form-control form-control-sm" name="password">
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
							<th>Email</th>
							<th>Новый пароль</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($users as $data) : ?>
			    		<tr>
							<td width="75%"><?php echo $data->email;?></td> 
							<td width="15%"><input type="password" class="form-control form-control-sm" id="newparol<?php echo $data->id;?>"></td>
			    			<td class="text-right">
			    				<div class="dropdown">
								  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    	Обработать
								  	</button>
								  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								    	<a class="dropdown-item" forPassword = "newparol<?php echo $data->id;?>" forPasswordID = "<?php echo $data->id;?>" baseURL = "<?php echo base_url('my/addmenager/update_password/');?>" onclick="setPasswordNew(this)">Сохранить пароль</a> 
								    	<a class="dropdown-item text-danger" href="<?php echo base_url('my/addmenager/delete/'.$data->id);?>" >Удалить</a>
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
        		<h5>Менаджеров пока нет</h5>
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
	function setPasswordNew(obj)
	{
		let i = document.getElementById(obj.getAttribute("forPassword"));
		$.get(
		obj.getAttribute("baseURL"),
		{
			id: obj.getAttribute("forPasswordID"),
			password: i.value,
		},
			onAjaxSuccess
		);
	}

	function onAjaxSuccess(data)
	{
		alert(data);
	}
</script>