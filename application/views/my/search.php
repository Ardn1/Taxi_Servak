	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Результаты поиска по номеру: <span class="text-primary"><?php echo $phone; ?></span></h1>
    </div>

    <div class="row">
        <div class="col-md-12">
        	<h5>Заявки на регистрацию - <?php echo $total_restration; ?></h5>
        	<?php if ($total_restration) : ?>
        		<?php foreach ($restration as $data1) : ?>
        			<p><a href="<?php echo base_url('my/orders/edit/'.$data1->id);?>" target="_blank">#<?php echo $data1->id;?> Заявка от <?php echo $data1->created;?></a></p>
        		<?php endforeach; ?>
        	<?php else : ?>
        	<p>Ничего не найдено</p>
        	<?php endif; ?>
        	<hr>
        </div>
        <div class="col-md-12">
        	<h5>Заявки на аренду - <?php echo $total_rent; ?></h5>
        	<?php if ($total_rent) : ?>
        		<?php foreach ($rent as $data2) : ?>
        			<p>#<?php echo $data2->id;?> Заявка от <?php echo $data2->created;?>, статус <?php if ($data2->status == 2) : ?><span class="text-danger">Отказано</span><?php endif; ?><?php if ($data2->status == 1) : ?><span class="text-success">Направлено в аренду</span><?php endif; ?><?php if (!$data2->status) : ?><span class="text-primary">Новая</span><?php endif; ?></p>
        		<?php endforeach; ?>
        	<?php else : ?>
        	<p>Ничего не найдено</p>
        	<?php endif; ?>
        	<hr>
        </div>
        <div class="col-md-12">
        	<h5>Обратная связь - <?php echo $total_feedback; ?></h5>
        	<?php if ($total_feedback) : ?>
        		<?php foreach ($feedback as $data3) : ?>
        			<p><a href="<?php echo base_url('my/feedback/edit/'.$data3->id);?>" target="_blank">#<?php echo $data3->id;?> Сообщение от <?php echo $data3->created;?></a></p>
        		<?php endforeach; ?>
        	<?php else : ?>
        	<p>Ничего не найдено</p>
        	<?php endif; ?>
        	<hr>
        </div>
    </div>