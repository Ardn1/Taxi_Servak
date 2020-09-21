<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Изменение названий таксопарков</h1>
</div>

<div class="row">
    <div class="col-md-12">
            <div class="">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Город</th>
                        <th>Таксопарк</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $data) : ?>
                        <tr>
                            <td width="50%"><?php echo $data->city;?></td>
                            <td width="50%"><input type="" class="form-control form-control-sm" idForBD="<?php echo $data->id;?>" oninput="setAllChanges(this)" value="<?php echo $data->name;?>"></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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
    var baseurlsave = "<?php echo base_url('my/taxopark/update_all/');?>"
    async function setAllChanges(obj) {
        let idThis = obj.getAttribute("idForBD");
        let name = obj.value;
        await $.get(
            baseurlsave,
            {
                id: idThis,
                name: name,
            },
            onAjaxSuccess
        );
    }

    function onAjaxSuccess(data) {
     //   if(data==="Успешно изменено"){
     //       swal ( "Уведомление" ,  "Успешно изменено!" ,  "success" )
     //   } else{
     //       swal ( "Уведомление" ,  "Не у" ,  "error" )
      //  }
    }
</script>