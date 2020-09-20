<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Детали заявки ID <?php echo $order->id; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if ($order->status != 4) : ?>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Обработать
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php if (!$order->status) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/accept/' . $order->id.'/'.$from); ?>">Принять</a>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/uncorrectset/' . $order->id.'/'.$from); ?>">Исправить фото</a>
                    <?php endif; ?>
                    <?php if ($order->status != 3) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/reject/' . $order->id.'/'.$from); ?>">Отказать</a>
                    <?php endif; ?>
                    <?php if ($order->status == 2) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/created/' . $order->id).'/'.$from; ?>">Создать
                            аккаунт</a>
                    <?php endif; ?>
                    <?php if ($this->user->ismanager == 0): ?>
                        <a class="dropdown-item text-danger"
                           href="<?php echo base_url('my/orders/delete_order/' . $order->id).'/'.$from; ?>">Удалить</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <?php if ($this->user->ismanager == 0): ?>
                <a href="<?php echo base_url('my/orders/delete_order/' . $order->id).'/'.$from;; ?>"
                   class="btn btn-outline-danger btn-sm">Удалить</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (внешняя сторона)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_vu_1); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (обратная сторона)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_vu_2); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Свидетельство о регистрации ТС (сторона 1)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_sts_1); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Свидетельство о регистрации ТС (сторона 2)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_sts_2); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Паспорт (основной разворот)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_pass_1); ?>" class="w-100">
            </div>
        </div>

        <?php if ($order->registration == 1) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    Паспорт (прописка)
                </div>
                <div class="card-body p-0">
                    <img src="<?php echo base_url('docs/' . $order->doc_pass_2); ?>" class="w-100">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($order->registration == 2) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    Регистрация (бланк 1)
                </div>
                <div class="card-body p-0">
                    <img src="<?php echo base_url('docs/' . $order->doc_reg_1); ?>" class="w-100">
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Регистрация (бланк 2)
                </div>
                <div class="card-body p-0">
                    <img src="<?php echo base_url('docs/' . $order->doc_reg_2); ?>" class="w-100">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($order->doc_license_1) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    Лицензия (сторона 1)
                </div>
                <div class="card-body p-0">
                    <img src="<?php echo base_url('docs/' . $order->doc_license_1); ?>" class="w-100">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($order->doc_license_2) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    Лицензия (сторона 2)
                </div>
                <div class="card-body p-0">
                    <img src="<?php echo base_url('docs/' . $order->doc_license_2); ?>" class="w-100">
                </div>
            </div>
        <?php endif; ?>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (спереди)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_auto_1); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (левый бок)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_auto_2); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (сзади)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_auto_3); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (правый бок)
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_auto_4); ?>" class="w-100">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Личная фотография
            </div>
            <div class="card-body p-0">
                <img src="<?php echo base_url('docs/' . $order->doc_face); ?>" class="w-100">
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
                    <?php if (!$order->status) : ?>
                        <p class="text-primary">Новая</p>
                    <?php elseif ($order->status == 1) : ?>
                        <p class="text-danger">Отказано</p>
                    <?php elseif ($order->status == 2) : ?>
                        <p class="text-success">Принята</p>
                    <?php elseif ($order->status == 3) : ?>
                        <p class="text-success">Создан аккаунт</p>
                    <?php elseif ($order->status == 5) : ?>
                        <p class="text-danger">Исправить фото</p>
                    <?php else : ?>
                        <p class="text-muted">Неполная</p>
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
                    <p><?php echo $order->created; ?></p>
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
                    <p><?php echo $order->name; ?></p>
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
                    <p>+<?php echo $order->phone; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <span data-feather="navigation" class="text-success"></span>
                </div>
                <div class="col-md-11">
                    <p class="mb-1"><strong>Город работы</strong></p>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-11">
                    <?php if ($order->cityjob == 1) : ?>
                        <p>Москва и МО</p>
                    <?php else : ?>
                        <p>Московская область</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <span data-feather="map-pin" class="text-success"></span>
                </div>
                <div class="col-md-11">
                    <p class="mb-1"><strong>Прописка</strong></p>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-11">
                    <?php if ($order->registration == 1) : ?>
                        <p>Российская Федерация</p>
                    <?php else : ?>
                        <p>СНГ</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>