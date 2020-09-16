	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Заявки на аренду: <span class="text-danger">отказано</span></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="<?php echo base_url('my/rent');?>" class="btn btn-sm btn-outline-success">Новые</a>
                <a href="<?php echo base_url('my/rent/accept');?>" class="btn btn-sm btn-outline-success">Принятые</a>
                <a href="<?php echo base_url('my/rent/fail');?>" class="btn btn-sm btn-success">Отказано</a>
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
			    			<th>Получено</th>
			    			<th></th>
			    			<th>Клиент</th>
			    			<th>Возраст</th>
			    			<th>Город</th>
			    			<th>Телефон</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($rent as $data) : ?>
			    		<tr>
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
			    				<?php endif; ?>
			    			</td>
			    			<td><?php echo $data->first_name;?> <?php echo $data->last_name;?></td>
			    			<td><?php echo $data->age;?></td>
			    			<td>
			    				<?php if ($data->city == 1) : ?>
			    				Москва
			    				<?php endif; ?>
			    			</td>
			    			<td>+<?php echo $data->phone;?></td>
			    			<td class="text-right">
			    				<div class="dropdown">
								  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    	Обработать
								  	</button>
								  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								  		<?php if (!$data->status) : ?>
								    	<a class="dropdown-item" href="<?php echo base_url('my/rent/success/'.$data->id);?>">Направить на аренду</a>
								    	<a class="dropdown-item" href="<?php echo base_url('my/rent/reject/'.$data->id);?>">Отказать</a>
								    	<?php endif; ?>
								    	<a class="dropdown-item text-danger" href="<?php echo base_url('my/rent/delete/'.$data->id);?>">Удалить</a>
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