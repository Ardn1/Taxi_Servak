<div class="row mt-auth">
    <div class="col-md-4 mx-auto text-center">
    	<h2>Авторизация</h2>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-4 mx-auto">
    	<?php echo form_open(site_url("sign/login")) ?>
        <div class="card">
		  	<div class="card-body">
		  		<?php if ($this->session->flashdata('error')) : // Error message ?>
		  		<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  	<?php echo $this->session->flashdata('error');?>
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
				<?php endif; ?>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="form-group">
						    <label>Email адрес</label>
						    <input type="email" class="form-control" name="email" autofocus="true">
						</div>
		    		</div>
		    		<div class="col-md-12">
		    			<div class="form-group">
						    <label>Пароль</label>
						    <input type="password" class="form-control" name="password">
						</div>
		    		</div>

		    		<div class="col-md-12">
		    			<button type="submit" class="btn btn-primary btn-block">Авторизоваться</button>
		    		</div>
		    	</div>
		  	</div>
		</div>
		<?php echo form_close(); ?>
    </div>
</div>