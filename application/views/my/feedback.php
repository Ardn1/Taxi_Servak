	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Обратная связь: <span class="text-primary">новые</span></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="<?php echo base_url('my/feedback');?>" class="btn btn-sm btn-success">Новые</a>
                <a href="<?php echo base_url('my/feedback/archive');?>" class="btn btn-sm btn-outline-success">Архив</a>
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
			    			<th>Получено</th>
			    			<th>Клиент</th>
			    			<th>Телефон</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($messages as $data) : ?>
			    		<tr>
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