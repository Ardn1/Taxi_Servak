<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"
        integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA=="
        crossorigin="anonymous"></script>
<style>
    #rotater {

    }
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4" id="detail">Детали заявки ID <?php echo $order->id; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if ($order->status != 4) : ?>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Обработать
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php if ($order->status == 0 || $order->status == 5) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/accept/' . $order->id . '/' . $from); ?>">Принять</a>
                    <?php endif; ?>
                    <?php if (!$order->status) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/uncorrectset/' . $order->id . '/' . $from); ?>">Исправить фото</a>
                    <?php endif; ?>
                    <?php if ($order->status != 3) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/reject/' . $order->id . '/' . $from); ?>">Отказать</a>
                    <?php endif; ?>
                    <?php if ($order->status == 2) : ?>
                        <a class="dropdown-item" href="<?php echo base_url('my/orders/created/' . $order->id) . '/' . $from; ?>">Создать аккаунт</a>
                    <?php endif; ?>
                    <?php if ($this->user->ismanager == 0): ?>
                        <a class="dropdown-item text-danger" href="<?php echo base_url('my/orders/delete_order/' . $order->id) . '/' . $from; ?>">Удалить</a>
                    <?php endif; ?>
                    <a class="dropdown-item" style="cursor: pointer; " onclick="onClickDownload()">Скачать архив</a>
                </div>
            </div>
        <?php else : ?>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Обработать
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php if ($this->user->ismanager == 0): ?>
                        <a href="<?php echo base_url('my/orders/delete_order/' . $order->id) . '/' . $from; ?>" class="dropdown-item text-danger">Удалить</a>
                    <?php endif; ?>
                    <a class="dropdown-item movelink" onclick="onClickDownload()">Скачать архив</a>
                </div>
            </div>
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
                <img  src="<?php
                if (strpos($order->doc_vu_1, '.') !== false)
                    echo base_url('docs/' . $order->doc_vu_1);
                else echo 'data:image/jpg;base64,'.$order->doc_vu_1
                ?>" class="w-100" name="forZip">

            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (обратная сторона)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_vu_2, '.') !== false)
                    echo base_url('docs/' . $order->doc_vu_2);
                else echo 'data:image/jpg;base64,'.$order->doc_vu_2
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Свидетельство о регистрации ТС (сторона 1)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_sts_1, '.') !== false)
                    echo base_url('docs/' . $order->doc_sts_1);
                else echo 'data:image/jpg;base64,'.$order->doc_sts_1
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Свидетельство о регистрации ТС (сторона 2)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_sts_2, '.') !== false)
                    echo base_url('docs/' . $order->doc_sts_2);
                else echo 'data:image/jpg;base64,'.$order->doc_sts_2
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Паспорт (основной разворот)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_pass_1, '.') !== false)
                    echo base_url('docs/' . $order->doc_pass_1);
                else echo 'data:image/jpg;base64,'.$order->doc_pass_1
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <?php if ($order->registration != 1) : ?>
            <?php if ($order->doc_pass_2) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Паспорт с обратной стороны (если пластик)
                    </div>
                    <div class="card-body p-0">
                        <img  src="<?php
                        if (strpos($order->doc_pass_2, '.') !== false)
                            echo base_url('docs/' . $order->doc_pass_2);
                        else echo 'data:image/jpg;base64,'.$order->doc_pass_2
                        ?>" class="w-100" name="forZip">
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($order->registration == 2 || false) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    Регистрация (бланк 1)
                </div>
                <div class="card-body p-0">
                    <img  src="<?php
                    if (strpos($order->doc_reg_1, '.') !== false)
                        echo base_url('docs/' . $order->doc_reg_1);
                    else echo 'data:image/jpg;base64,'.$order->doc_reg_1
                    ?>" class="w-100" name="forZip">
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Регистрация (бланк 2)
                </div>
                <div class="card-body p-0">
                    <img  src="<?php
                    if (strpos($order->doc_reg_2, '.') !== false)
                        echo base_url('docs/' . $order->doc_reg_2);
                    else echo 'data:image/jpg;base64,'.$order->doc_reg_2
                    ?>" class="w-100" name="forZip">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($order->cityjob == 1) : ?>
            <?php if ($order->doc_license_1) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Лицензия (сторона 1)
                    </div>
                    <div class="card-body p-0">
                        <img  src="<?php
                        if (strpos($order->doc_license_1, '.') !== false)
                            echo base_url('docs/' . $order->doc_license_1);
                        else echo 'data:image/jpg;base64,'.$order->doc_license_1
                        ?>" class="w-100" name="forZip">
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($order->doc_license_2) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Лицензия (сторона 2)
                    </div>
                    <div class="card-body p-0">
                        <img  src="<?php
                        if (strpos($order->doc_license_2, '.') !== false)
                            echo base_url('docs/' . $order->doc_license_2);
                        else echo 'data:image/jpg;base64,'.$order->doc_license_2
                        ?>" class="w-100" name="forZip">
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (спереди)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_auto_1, '.') !== false)
                    echo base_url('docs/' . $order->doc_auto_1);
                else echo 'data:image/jpg;base64,'.$order->doc_auto_1
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (левый бок)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_auto_2, '.') !== false)
                    echo base_url('docs/' . $order->doc_auto_2);
                else echo 'data:image/jpg;base64,'.$order->doc_auto_2
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (сзади)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_auto_3, '.') !== false)
                    echo base_url('docs/' . $order->doc_auto_3);
                else echo 'data:image/jpg;base64,'.$order->doc_auto_3
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Автомобиль (правый бок)
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_auto_4, '.') !== false)
                    echo base_url('docs/' . $order->doc_auto_4);
                else echo 'data:image/jpg;base64,'.$order->doc_auto_4
                ?>" class="w-100" name="forZip">
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Личная фотография
            </div>
            <div class="card-body p-0">
                <img  src="<?php
                if (strpos($order->doc_face, '.') !== false)
                    echo base_url('docs/' . $order->doc_face);
                else echo 'data:image/jpg;base64,'.$order->doc_face
                ?>" class="w-100" name="forZip">
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
                        Москва и МО
                    <?php endif; ?>
                    <?php if ($order->cityjob == 2) : ?>
                        Московская область
                    <?php endif; ?>
                    <?php if ($order->cityjob == 3) : ?>
                        Санкт-Петербург
                    <?php endif; ?>
                    <?php if ($order->cityjob == 4) : ?>
                        Екатеринбург
                    <?php endif; ?>
                    <?php if ($order->cityjob == 5) : ?>
                        Казань
                    <?php endif; ?>
                    <?php if ($order->cityjob == 6) : ?>
                        Краснодар
                    <?php endif; ?>
                    <?php if ($order->cityjob == 7) : ?>
                        Красноярск
                    <?php endif; ?>
                    <?php if ($order->cityjob == 8) : ?>
                        Новосибирск
                    <?php endif; ?>
                    <?php if ($order->cityjob == 9) : ?>
                        Омск
                    <?php endif; ?>
                    <?php if ($order->cityjob == 10) : ?>
                        Пермь
                    <?php endif; ?>
                    <?php if ($order->cityjob == 11) : ?>
                        Самара
                    <?php endif; ?>
                    <?php if ($order->cityjob == 12) : ?>
                        Саратов
                    <?php endif; ?>
                    <?php if ($order->cityjob == 13) : ?>
                        Ульяновск
                    <?php endif; ?>
                    <?php if ($order->cityjob == 14) : ?>
                        Ярославль
                    <?php endif; ?>
                    <?php if ($order->cityjob == 15) : ?>
                        Другой
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1">
                    <span data-feather="map-pin" class="text-success"></span>
                </div>
                <div class="col-md-11">

                    <p class="mb-1"><strong>Гражданство</strong></p>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-11">
                    <?php if ($order->registration == 1) : ?>
                        <p>Россия</p>
                    <?php endif ; ?>
                    <?php if ($order->registration == 2) : ?>
                        <p>СНГ</p>
                    <?php endif ; ?>
                    <?php if ($order->registration == 3) : ?>
                        <p>Другое</p>
                    <?php endif ; ?>
                </div>
            </div>
        </div>
    </div>

</div>
