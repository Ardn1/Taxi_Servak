<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Пароль и Email</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url("my/profile/update_profile")) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email адрес</label>
                                <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $this->user->email; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Новый пароль</label>
                                <input type="password" class="form-control form-control-sm" name="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Повтор пароля</label>
                                <input type="password" class="form-control form-control-sm" name="repassword">
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