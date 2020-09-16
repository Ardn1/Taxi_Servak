	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Шаблоны оповещений</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
        	<div class="table-responsive">
			  	<table class="table table-hover">
			    	<thead>
			    		<tr>
			    			<th>Тип</th>
			    			<th>Название</td>
			    			<th>Статус</th>
			    			<th></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($templates as $data) : ?>
			    		<tr>
			    			<td width="10%">
			    				<?php if ($data->type == 1) : ?>
			    				<span data-feather="users" data-toggle="tooltip" data-placement="right" title="Регистрация"></span>
			    				<?php elseif ($data->type == 2) : ?>
			    				<span data-feather="clock" data-toggle="tooltip" data-placement="right" title="Аренда"></span>
			    				<?php elseif ($data->type == 3) : ?>
			    				<span data-feather="mail" data-toggle="tooltip" data-placement="right" title="Email для администратора"></span>
			    				<?php endif; ?>
			    			</td>
			    			<td><?php echo $data->name;?></td>
			    			<td>
			    				<?php if (!$data->status) : ?>
			    				<span class="badge badge-danger">Выключено</span>
			    				<?php else : ?>
			    				<span class="badge badge-success">Включено</span>
			    				<?php endif; ?>
			    			</td>
			    			<td class="text-right">
			    				<a href="<?php echo base_url('my/templates/edit/'.$data->id);?>" class="btn btn-outline-secondary btn-sm">Изменить</a>
			    			</td>
			    		</tr>
			    		<?php endforeach; ?>
			    	</tbody>
			  	</table>
			</div>
        </div>
    </div>