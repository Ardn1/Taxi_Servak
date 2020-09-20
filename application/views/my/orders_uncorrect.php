<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Заявки на: <span class="text-success">исправление фото</span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a href="<?php echo base_url('my/orders');?>" class="btn btn-sm btn-outline-success">Новые</a>
            <a href="<?php echo base_url('my/orders/short');?>" class="btn btn-sm btn-outline-success">Неполные</a>
            <a href="<?php echo base_url('my/orders/accepting');?>" class="btn btn-sm btn-outline-success">Принятые</a>
            <a href="<?php echo base_url('my/orders/success');?>" class="btn btn-sm btn-outline-success">Успешные</a>
            <a href="<?php echo base_url('my/orders/uncorrect');?>" class="btn btn-sm btn-success">Исправить фото</a>
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
                            <td><?php echo $data->created;?></td>
                            <td><?php echo $data->name;?></td>
                            <td>
                                <?php if ($data->cityjob == 1) : ?>
                                    Москва и МО
                                <?php else : ?>
                                    Московская область
                                <?php endif; ?>
                            </td>
                            <td><?php echo $data->phone;?></td>
                            <td class="text-right">
                                <a href="<?php echo base_url('my/orders/edit/'.$data->id);?>" class="btn btn-outline-secondary btn-sm">Смотреть</a>
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