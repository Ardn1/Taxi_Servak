	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Детали сообщения ID <?php echo $message->id;?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        	<div class="dropdown">
			  	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Обработать
			  	</button>
			  	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
			  		<?php if (!$message->status) : ?>
			    	<a class="dropdown-item" href="<?php echo base_url('my/feedback/in_archive/'.$message->id);?>">Переместить в архив</a>
			    	<?php endif; ?>
                    <?php if ($this->user->ismanager==0): ?>
			    	<a class="dropdown-item text-danger" href="<?php echo base_url('my/feedback/delete_message/'.$message->id);?>">Удалить</a>
                    <?php endif;?>
			  	</div>
			</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
        	<div class="card">
			  	<div class="card-body">
			    	<?php echo $message->message;?>
			  	</div>
			</div>
        </div>
        <div class="col-md-4">
        	<div class="row">
        		<div class="col-md-1">
        			<span data-feather="flag" class="text-success"></span>
        		</div>
        		<div class="col-md-11">
        			<p class="mb-1"><strong>Статус сообщения</strong></p>
        		</div>
        		<div class="col-md-1">
        			
        		</div>
        		<div class="col-md-11">
        			<?php if (!$message->status) : ?>
        			<p>Новое</p>
        			<?php else : ?>
        			<p class="text-danger">В архиве</p>
        			<?php endif; ?>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-1">
        			<span data-feather="calendar" class="text-success"></span>
        		</div>
        		<div class="col-md-11">
        			<p class="mb-1"><strong>Дата получения</strong></p>
        		</div>
        		<div class="col-md-1">
        			
        		</div>
        		<div class="col-md-11">
        			<p><?php echo $message->created;?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-1">
        			<span data-feather="user" class="text-success"></span>
        		</div>
        		<div class="col-md-11">
        			<p class="mb-1"><strong>Имя клиента</strong></p>
        		</div>
        		<div class="col-md-1">
        			
        		</div>
        		<div class="col-md-11">
        			<p><?php echo $message->name;?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-1">
        			<span data-feather="phone" class="text-success"></span>
        		</div>
        		<div class="col-md-11">
        			<p class="mb-1"><strong>Телефон клиента</strong></p>
        		</div>
        		<div class="col-md-1">
        			
        		</div>
        		<div class="col-md-11">
        			<p>+<?php echo $message->phone;?></p>
        		</div>
        	</div>
        </div>
    </div>