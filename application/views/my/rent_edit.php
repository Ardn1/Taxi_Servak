<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"
        integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA=="
        crossorigin="anonymous"></script>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4" id="detail">Детали заявки ID <?php echo $rent->id; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if ($rent->status != 4) : ?>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Обработать
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php if ($rent->status == 0 || $rent->status == 3) : ?>
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/rent/success/' . $rent->id . '/' . $from); ?>">Направить на аренду</a>
                    <?php endif; ?>
                    <?php if ($rent->status == 0 || $rent->status == 2): ?>
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/rent/uncorrectset/' . $rent->id . '/' . $from); ?>">Исправить фото</a>
                    <?php endif; ?>
                    <?php if ($rent->status == 0): ?>
                        <a class="dropdown-item"
                           href="<?php echo base_url('my/rent/reject/' . $rent->id . '/' . $from); ?>">Отказать</a>
                    <?php endif; ?>
                    <?php if ($this->user->ismanager == 0): ?>
                        <a class="dropdown-item text-danger"
                           href="<?php echo base_url('my/rent/delete/' . $rent->id . '/' . $from); ?>">Удалить</a>
                    <?php endif; ?>
                    <a style="cursor: pointer" class="dropdown-item pointer" onclick="onClickDownload()" style="cursor: pointer">Скачать архив</a>
                </div>
            </div>
        <?php else : ?>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Обработать
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a href="<?php echo base_url('my/orders/delete_rent/' . $rent->id . '/' . $from); ?>" class="btn btn-outline-danger btn-sm">Удалить</a>
                    <a class="dropdown-item" onclick="onClickDownload()" style="cursor: pointer">Скачать архив</a>
                </div>
            </div>
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
                <img src="<?php
                if (strpos($rent->pass1, '.') !== false)
                    echo base_url('docs/' . $rent->pass1);
                else echo 'data:image/jpg;base64,' . $rent->pass1
                ?>" class="w-100" name="forZip">
            </div>
        </div>
        <?php if ($rent->citizenship == 1) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    Паспорт (страница с пропиской)
                </div>
                <div class="card-body p-0">
                    <img src="<?php
                    if (strpos($rent->pass2, '.') !== false)
                        echo base_url('docs/' . $rent->pass2);
                    else echo 'data:image/jpg;base64,' . $rent->pass2
                    ?>" class="w-100" name="forZip">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($rent->citizenship != 1) : ?>
            <?php if ($rent->pass2) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Паспорт с обратной стороны (если пластик)
                    </div>
                    <div class="card-body p-0">
                        <img src="<?php
                        if (strpos($rent->pass2, '.') !== false)
                            echo base_url('docs/' . $rent->pass2);
                        else echo 'data:image/jpg;base64,' . $rent->pass2
                        ?>" class="w-100" name="forZip">
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (внешняя сторона)
            </div>
            <div class="card-body p-0">
                <img src="<?php
                if (strpos($rent->vu1, '.') !== false)
                    echo base_url('docs/' . $rent->vu1);
                else echo 'data:image/jpg;base64,' . $rent->vu1
                ?>" class="w-100" name="forZip">
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                Водительское удостоверение (обратная сторона)
            </div>
            <div class="card-body p-0">
                <img src="<?php
                if (strpos($rent->vu2, '.') !== false)
                    echo base_url('docs/' . $rent->vu2);
                else echo 'data:image/jpg;base64,' . $rent->vu2
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
                    <?php if (!$rent->status) : ?>
                        <p class="text-primary">Новая</p>
                    <?php elseif ($rent->status == 1) : ?>
                        <p class="text-success">Принятая</p>
                    <?php elseif ($rent->status == 2) : ?>
                        <p class="text-danger">Отказаная</p>
                    <?php elseif ($rent->status == 3) : ?>
                        <p class="text-danger">Исправить фото</p>
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
                    <p><?php echo $rent->created; ?></p>
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
                    <p><?php echo $rent->first_name . ' ' . $rent->last_name; ?></p>
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
                    <p>+<?php echo $rent->phone; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <span data-feather="smartphone" class="text-success"></span>
                </div>
                <div class="col-md-11">
                    <p class="mb-1"><strong>Источник</strong></p>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-11">
                                <?php if ($rent->api == 0) : ?>
			    					APP 1
			    				<?php elseif ($rent->api == 1) : ?>
									APP 2
			    				<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
