<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Добавление новых менеджеров</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo form_open(site_url("my/AddMenager/updatemanager")) ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="" style="width:35%; margin-left: 3%">
                        <label>Email адрес</label>
                        <input type="email" class="form-control form-control-sm" name="email">
                    </div>
                    <div class="" style="width:35%; margin-left: 3%">
                        <label>Пароль</label>
                        <input type="" class="form-control form-control-sm" name="password">
                    </div>
                    <div class="column" style="width:20%; margin-left: 3%">
                        <label>Разрешить отправку сообщений</label> <br>
                        <input width="3%" type="checkbox" name = "ismessegesallow" style="width = 5%" unchecked value = "Yes"/>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Добавить</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php if ($total_records) : ?>
            <div class="">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Отправка сообщений</th>
                        <th>Новый пароль</th>
                        <th class="text-right text-success">Всего: <?php echo $total_records; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $data) : ?>
                        <tr>
                            <td width="60%"><?php echo $data->email; ?></td>
                            <?php if ($data->ismanager == 1) : ?>
                            <td width="15%"><input type="checkbox" id = "one_ch" IDAPI = "<?php echo $data->id;?>" onclick = "setEditingNew(this)" style="width =5%" checked/></td>
                            <?php elseif ($data->ismanager == 2) : ?>
                            <td width="15%"><input type="checkbox" id = "one_ch" IDAPI = "<?php echo $data->id;?>" onclick = "setEditingNew(this)" style="width =5%" unchecked/></td>
                            <?php endif; ?>
                            <td width="15%"><input type="password" class="form-control form-control-sm" id="newparol<?php echo $data->id; ?>"></td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Обработать
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" forPassword="newparol<?php echo $data->id; ?>"
                                           forPasswordID="<?php echo $data->id; ?>" onclick="setPasswordNew(this)">Сохранить пароль</a>
                                        <a class="dropdown-item text-danger"
                                           href="<?php echo base_url('my/addmenager/delete/' . $data->id); ?>">Удалить</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="text-center mt-5">
                <img src="<?php echo base_url('themes/bootstrap/img/2.svg'); ?>" class="empty-img mb-4">
                <h5>Менаджеров пока нет</h5>
                <p class="text-muted"></p>
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
    var baseurl = "<?php echo base_url('my/addmenager/update_password/');?>"
    var baseurlediting = "<?php echo base_url('my/addmenager/update_editing/');?>"
    async function setPasswordNew(obj) {
        let i = document.getElementById(obj.getAttribute("forPassword"));
        await $.get(
            baseurl,
            {
                id: obj.getAttribute("IDAPI"),
                password: i.value,
            },
            onAjaxSuccess
        );
		i.value = "";
    }

    async function setEditingNew(obj) {
        let i = obj.checked?1:2;
        await $.get(
            baseurlediting,
            {
                id: obj.getAttribute("IDAPI"),
                ismanager: i,
            },
            onAjaxSuccessCheck
        );
		i.value = "";
    }

    function onAjaxSuccessCheck(data) {
     //   if(data==="Успешно изменено"){
     //       swal ( "Уведомление" ,  "Успешно изменено!" ,  "success" )
     //   } else{
    //        swal ( "Уведомление" ,  data ,  "error" )
      //  }
    }

    function onAjaxSuccess(data) {
        if(data==="Успешно изменено"){
            swal ( "Уведомление" ,  "Успешно изменено!" ,  "success" )
        } else{
            swal ( "Уведомление" ,  data ,  "error" )
        }
    }
</script>