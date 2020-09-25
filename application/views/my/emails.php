	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Email шлюз</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url("my/emails/update_email")) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Метод отправки</label>
                                <select class="form-control form-control-sm" name="method">
							      	<option value="0" <?php if (!$this->settings->method) : ?>selected<?php endif; ?>>PHP Codeigniter</option>
							      	<option value="1" <?php if ($this->settings->method) : ?>selected<?php endif; ?>>SMTP</option>
							    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email администратора</label>
                                <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $this->settings->email; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email отправителя</label>
                                <input type="email" class="form-control form-control-sm" name="sender" value="<?php echo $this->settings->sender; ?>">
                                <small class="text-muted">Существующий ящик</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SMTP порт</label>
                                <input type="text" class="form-control form-control-sm" name="port" value="<?php echo $this->settings->port; ?>">
                                <small class="text-muted">Только цифры</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SMTP хост</label>
                                <input type="text" class="form-control form-control-sm" name="host" value="<?php echo $this->settings->host; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SMTP пароль</label>
                                <input type="text" class="form-control form-control-sm" name="smtp_password" value="<?php echo $this->settings->smtp_password; ?>">
                                <small class="text-muted">Пароль от почтового ящика только для SMTP</small>
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
