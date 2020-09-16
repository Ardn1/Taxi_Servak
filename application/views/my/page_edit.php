
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Изменение страницы: <?php echo $page->name;?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(site_url('my/pages/update_page/'.$page->id)) ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Контент страницы</label>
                                <textarea name="content" id="editor"><?php echo $page->content; ?></textarea>
                                <small class="text-muted">Не забывайте обварачивать текст в [p] теги</small><br>
                                <small class="text-danger">Для этой формы отключены XSS фильтры</small>
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

    <script>
        CKEDITOR.replace('editor', {
          customConfig: '<?php echo base_url();?>themes/bootstrap/js/config.js'
        });
    </script>