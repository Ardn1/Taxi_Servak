	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Менеджер контента</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
        	<div class="table-responsive">
			  	<table class="table table-hover">
			    	<thead>
			    		<tr>
			    			<th>Название</td>
			    			<th></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($pages as $data) : ?>
			    		<tr>
			    			<td><?php echo $data->name;?></td>
			    			<td class="text-right">
			    				<a href="<?php echo base_url('my/pages/edit/'.$data->id);?>" class="btn btn-outline-secondary btn-sm">Изменить</a>
			    			</td>
			    		</tr>
			    		<?php endforeach; ?>
			    	</tbody>
			  	</table>
			</div>
        </div>
    </div>