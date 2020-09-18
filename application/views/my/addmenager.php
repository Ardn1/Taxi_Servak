<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Добавление новых менеджеров</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url("my/AddManager/update_manager")) ?>
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




        <div class="row">
        <div class="col-md-12">
        	<?php if ($total_records) : ?>
        	<div class="">
			  	<table class="table table-hover">
			    	<thead>
			    		<tr>
			    			<th>Email</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($rent as $data) : ?>
			    		<tr>
			    			<td><?php echo $data->email;?></td>
			    			<td class="text-right">
			    				<div class="dropdown">
								  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    	Обработать
								  	</button>
								  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								    	<a class="dropdown-item" href="<?php echo base_url('my/rent/success/'.$data->id);?>">Изменить пароль</a>
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
        		<h5>Менеджеров пока нет</h5>
        	</div>
        	<?php endif; ?>
        </div>
    </div>




    </div>