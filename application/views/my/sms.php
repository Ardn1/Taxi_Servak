
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">SMS шлюз</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url("my/sms/update_key")) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>API ключ</label>
                                <input type="text" class="form-control form-control-sm" name="key" value="<?php echo $this->settings->sms_api; ?>">
                                <small class="text-muted">Ключ доступен в Личном кабинете на сайте SMS.RU</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
