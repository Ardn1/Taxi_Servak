	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Заявки на регистрацию: <span class="text-success">успешные</span></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="<?php echo base_url('my/orders');?>" class="btn btn-sm btn-outline-success">Новые</a>
                <a href="<?php echo base_url('my/orders/short');?>" class="btn btn-sm btn-outline-success">Неполные</a>
                <a href="<?php echo base_url('my/orders/accepting');?>" class="btn btn-sm btn-outline-success">Принятые</a>
                <a href="<?php echo base_url('my/orders/success');?>" class="btn btn-sm btn-success">Успешные</a>
                <a href="<?php echo base_url('my/orders/uncorrect');?>" class="btn btn-sm btn-outline-success" id="corpho">Исправить фото</a>
                <a href="<?php echo base_url('my/orders/fail');?>" class="btn btn-sm btn-outline-success">Отказано</a>
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
                            <th>
                                <input type="checkbox" id ="all">
                            </th>
                            <th>
                                <div class="dropdown" id="mainB">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Обработать
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <?php if ($this->user->ismanager==0): ?>
                                            <a class="dropdown-item text-danger" onclick = "RemoveAll()" style="cursor: pointer">Удалить</a>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </th>
			    			<th>Получено</th>
			    			<th>Имя</th>
			    			<th>Город</th>
			    			<th>Телефон</th>
			    			<th class="text-right text-success">Всего: <?php echo $total_records;?></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php foreach ($orders as $data) : ?>
			    		<tr>
                            <td width="3%"><input type="checkbox" id = "one_ch" IDAPI = "<?php echo $data->id;?>" style="width =5%" unchecked/></td>
                            <td width="7%"></td>
			    			<td><?php echo $data->created;?></td>
			    			<td><?php echo $data->name;?></td>
                            <td>
			    				<?php if ($data->cityjob == 1) : ?>
			    					Москва и МО
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 2) : ?>
			    					Московская область
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 3) : ?>
			    					Санкт-Петербург
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 4) : ?>
			    					Екатеринбург
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 5) : ?>
			    					Казань
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 6) : ?>
			    					Краснодар
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 7) : ?>
			    					Красноярск
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 8) : ?>
			    					Новосибирск
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 9) : ?>
			    					Омск
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 10) : ?>
			    					Пермь
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 11) : ?>
			    					Самара
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 12) : ?>
			    					Саратов
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 13) : ?>
			    					Ульяновск
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 14) : ?>
			    					Ярославль
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 15) : ?>
			    					Воронеж
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 16) : ?>
			    					Нижний Новгород
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 17) : ?>
			    					Ростов-на-Дону
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 18) : ?>
			    					Тольятти
			    				<?php endif; ?>
                                <?php if ($data->cityjob == 19) : ?>
			    					Тюмень
                                <?php endif; ?>
                                <?php if ($data->cityjob == 20) : ?>
			    					Сочи
                                <?php endif; ?>
                                <?php if ($data->cityjob == 21) : ?>
			    					Челябинск
                                <?php endif; ?>
                                <?php if ($data->cityjob == 22) : ?>
			    					Другой
			    				<?php endif; ?>
			    			</td>
			    			<td><?php echo $data->phone;?></td>
			    			<td class="text-right">
			    				<a href="<?php echo base_url('my/orders/edit/'.$data->id).'/4';?>" class="btn btn-outline-secondary btn-sm">Смотреть</a>
			    			</td>
			    		</tr>
			    		<?php endforeach; ?>
			    	</tbody>
			  	</table>
			</div>
        	<?php else : ?>
        	<div class="text-center mt-5">
        		<img src="<?php echo base_url('themes/bootstrap/img/4.svg');?>" class="empty-img mb-4">
        		<h5>Заявок на регистрацию пока нет</h5>
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

    <script>
        var main = document.querySelector("#all");
        var all = document.querySelectorAll("#one_ch");

        var urlSuccsess = "<?php echo base_url('my/orders/accept/');?>"
        var urlReject = "<?php echo base_url('my/orders/reject/');?>"
        var urlDelete = "<?php echo base_url('my/orders/delete_order/');?>"
        var urlUncorrect = "<?php echo base_url('my/orders/uncorrectset/');?>"

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

        async function AcceptAll() {
            for(var i = 0; i < all.length; i++)
            {
                if (all[i].checked == true)
                    await acceptOne(all[i].getAttribute("IDAPI"));
            }
            location.reload();
        }
        async function DenyAll() {
            for(var i = 0; i < all.length; i++)
            {
                if (all[i].checked == true)
                    await denyOne(all[i].getAttribute("IDAPI"));
            }
            location.reload();
        }
        async function RemoveAll() {
            for(var i = 0; i < all.length; i++)
            {
                if (all[i].checked == true)
                    await removeOne(all[i].getAttribute("IDAPI"));
            }
            location.reload();
        }
        async function UncorrectAll() {
            for(var i = 0; i < all.length; i++)
            {
                if (all[i].checked == true)
                    await uncorrectOne(all[i].getAttribute("IDAPI"));
            }
            location.reload();
        }

        async function acceptOne(id)
        {
            await $.get(urlSuccsess + id + '/1', {
            }, onAjaxSuccess);
        }
        async function denyOne(id)
        {
            await $.get(urlReject + id + '/1', {
            }, onAjaxSuccess);
        }
        async function removeOne(id)
        {
            await $.get(urlDelete + id + '/0', {
            }, onAjaxSuccess);
        }
        async function uncorrectOne(id)
        {
            await $.get(urlUncorrect + id + '/1', {
            }, onAjaxSuccess);
        }

        function onAjaxSuccess(data) {}

        function corrector(){
            var text = document.querySelector("#corpho")
            var currentWidth = window.innerWidth;
            if(currentWidth<=1150) {
                text.style.width='125px'
                text.textContent="Исправить фото"
            }
            else {
                text.textContent="Исправить фото"
                text.style.width=''
            }
        }
        document.addEventListener("DOMContentLoaded", () => {
            corrector()
        });

        window.addEventListener('resize', function(event){
            corrector()
        });
    </script>

