	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Изменение SMS шаблона: <?php echo $template->name;?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url('my/templates/update_template/'.$template->id)) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Статус</label>
                                <select class="form-control form-control-sm" name="status">
							      	<option value="0" <?php if (!$template->status) : ?>selected<?php endif; ?>>Выключено</option>
							      	<option value="1" <?php if ($template->status) : ?>selected<?php endif; ?>>Включено</option>
							    </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Текст сообщения</label>
                                <textarea class="form-control form-control-sm" rows="5" name="message"><?php echo $template->message;?></textarea>
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