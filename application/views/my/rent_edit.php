<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Детали заявки ID <?php echo $rent->id;?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if ($rent->status != 4) : ?>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Обработать
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php if (!$rent->status) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/rent/success/'.$rent->id);?>">Направить на аренду</a>
                    <?php endif; ?>
                    <?php if ($rent->status != 2) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/rent/reject/'.$rent->id);?>">Отказать</a>
                    <?php endif; ?>
                    <a class="dropdown-item text-danger" href="<?php echo base_url('my/rent/delete/'.$rent->id);?>">Удалить</a>
                </div>
            </div>
        <?php else : ?>
            <a href="<?php echo base_url('my/orders/delete_rent/'.$rent->id);?>" class="btn btn-outline-danger btn-sm">Удалить</a>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8">


        <div class="card mb-3">
            <div class="card-header">
                Паспорт (основной разворот)
            </div>
            <div class="card-body p-0">
               <img src="<?php echo base_url('docs/'.$rent->pass1);?>" class="w-100">
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Паспорт (страница с пропиской)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/'.$rent->pass2);?>" class="w-100">
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (внешняя сторона)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/'.$rent->vu1);?>" class="w-100">
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (обратная сторона)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/'.$rent->vu2);?>" class="w-100">
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="sticky-top">
            <div class="row">
                <div class="col-md-1">
                    <span data-feather="flag" class="text-success"></span>
                </div>
                <div class="col-md-11">
                    <p class="mb-1"><strong>Статус заявки</strong></p>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-11">
                    <?php if (!$rent->status) : ?>
                        <p class="text-primary">Новая</p>
                    <?php elseif($rent->status == 1) : ?>
                        <p class="text-success">Принятая</p>
                    <?php elseif($rent->status == 2) : ?>
                        <p class="text-danger">Отказаная</p>
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
                    <p><?php echo $rent->created;?></p>
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
                    <p><?php echo $rent->first_name.' '.$rent->last_name;?></p>
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
                    <p>+<?php echo $rent->phone;?></p>
                </div>
            </div>
        </div>
    </div>

</div>