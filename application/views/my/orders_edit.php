<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"
        integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA=="
        crossorigin="anonymous"></script>
<style>
    #rotater {

    }
</style>
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
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/orders/accept/' . $order->id . '/' . $from); ?>">Принять</a>
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/orders/uncorrectset/' . $order->id . '/' . $from); ?>">Исправить фото</a>
                    <?php endif; ?>
                    <?php if ($order->status != 3) : ?>
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/orders/reject/' . $order->id . '/' . $from); ?>">Отказать</a>
                    <?php endif; ?>
                    <?php if ($order->status == 2) : ?>
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/orders/created/' . $order->id) . '/' . $from; ?>">Создать
                            аккаунт</a>
                    <?php endif; ?>
                    <?php if ($this->user->ismanager == 0): ?>
                        <a class="dropdown-item text-danger"
                           href="<?php echo base_url('my/orders/delete_order/' . $order->id) . '/' . $from; ?>">Удалить</a>
                    <?php endif; ?>
                    <a class="dropdown-item" onclick="onClickDownload()">Скачать архив</a>
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
                        <a class="dropdown-item" onclick="onClickDownload()">Скачать архив</a>
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
                ?>" class="w-100">

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

        <?php if ($order->registration != 1) : ?>
            <?php if ($order->doc_pass_2) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Паспорт с обратной стороны (если пластик)
                    </div>
                    <div class="card-body p-0">
                        <img src="<?php echo base_url('docs/' . $order->doc_pass_2); ?>" class="w-100">
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
        <?php if ($order->cityjob == 1) : ?>
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

<script>
    let rotateAngle = 90;

    function rotate(image) {
        image.setAttribute("style", "transform: rotate(" + rotateAngle + "deg)");
        rotateAngle = rotateAngle + 90;
    }

    function onClickDownload() {
        var zip = new JSZip();
        for (var i = 0; i < 5; i++) {
            var txt = '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'
            zip.file("file" + i + ".jpg", txt, {base64: true});
        }
        zip.generateAsync({
            type: "base64"
        }).then(function(content) {
            window.location.href = "data:application/zip;base64," + content;
        });
    }


</script>