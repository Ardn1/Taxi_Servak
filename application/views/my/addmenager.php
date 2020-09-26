<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Добавление новых менеджеров</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo form_open(site_url("my/Addmenager/updatemanager")) ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="column" style="width:100%; margin-left: 3%">
                        <div class="row">
                            <div class="" style="width:45%; margin-left: 3%">
                                <label>Email адрес</label>
                                <input type="email" class="form-control form-control-sm" name="email">
                            </div>
                            <div class="" style="width:45%; margin-left: 3%">
                                <label>Пароль</label>
                                <input type="" class="form-control form-control-sm" name="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="" style="width:45%; margin-left: 3%">
                                <label>Имя</label>
                                <input type="" class="form-control form-control-sm" name="name">
                            </div>
                            <div class="" style="width:45%; margin-left: 3%">
                                <label>Телефон</label>
                                <input type="phone" class="form-control form-control-sm" name="phone">
                            </div>
                        </div>    
                        <div class="column" style="width:50%; margin-left: 3%; margin-top: 1%">
                            <input width="5%" type="checkbox" name = "ismessegesallow" unchecked value = "Yes"/>
                            <label style="margin-left: 2%"> Разрешить отправку сообщений </label>
                        </div>
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
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Отправка сообщений</th>
                        <th>Новый пароль</th>
                        <th class="text-right text-success">Всего: <?php echo $total_records-1; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $data) : ?>
                        <?php if ($data->ismanager != 0) : ?>
                        <tr>
                            <td width="20%"><?php echo $data->email; ?></td>
                            <td width="20%"><input type="" class="form-control form-control-sm" id="newname<?php echo $data->id;?>" value="<?php echo $data->name; ?>"></td>
                            <td width="20%"><input type="" class="form-control form-control-sm" id="newphone<?php echo $data->id;?>" value="<?php echo $data->phone; ?>"></td>
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
                                        <a class="dropdown-item" 
                                         forID="<?php echo $data->id;?>" 
                                         onclick="setAllChanges(this)">Сохранить изменения</a>
                                        <a class="dropdown-item text-danger"
                                           href="<?php echo base_url('my/addmenager/delete/' . $data->id); ?>">Удалить</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
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
    var baseurlsave = "<?php echo base_url('my/addmenager/update_all/');?>"
    
    async function setAllChanges(obj) {
        let idThis = obj.getAttribute("forID");
        let parol = document.getElementById("newparol"+idThis);
        let name = document.getElementById("newname"+idThis).value;
        let phone = document.getElementById("newphone"+idThis).value;
        await $.get(
            baseurlsave,
            {
                id: idThis,
                password: parol.value,
                name: name,
                phone: phone,
            },
            onAjaxSuccess
        );
		parol.value = "";
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

/*    async function setPasswordNew(obj) {
        let i = obj.checked?1:2;
        await $.get(
            baseurlediting,
            {
                id: obj.getAttribute("IDAPI"),
                ismanager: i,
            },
            onAjaxSuccess
        );
		i.value = "";
    }*/


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