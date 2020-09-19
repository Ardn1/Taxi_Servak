<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title;?></title>

        <link href="<?php echo base_url();?>themes/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url();?>themes/bootstrap/css/admin.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
        <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
        <script src="<?php echo base_url();?>themes/bootstrap/js/config.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand d-none d-md-block col-sm-3 col-md-2 mr-0" href="#">Ситимобил API</a>
            <a class="navbar-brand d-block d-sm-none col-sm-3 col-md-2 mr-0 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ситимобил API</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?php echo base_url('my/orders');?>"><span data-feather="users" class="text-primary mr-3"></span> Регистрация</a>
                <a class="dropdown-item" href="<?php echo base_url('my/rent');?>"><span data-feather="clock" class="text-primary mr-3"></span> Аренда</a>
                <a class="dropdown-item" href="<?php echo base_url('my/feedback');?>"><span data-feather="mail" class="text-primary mr-3"></span> Обратная связь</a>
                <a class="dropdown-item" href="<?php echo base_url('my/pages');?>"><span data-feather="edit" class="text-primary mr-3"></span> Менеджер контента</a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Конфигурация</h6>
                <a class="dropdown-item" href="<?php echo base_url('my/sms');?>"><span data-feather="radio" class="text-primary mr-3"></span> SMS шлюз</a>
                <a class="dropdown-item" href="<?php echo base_url('my/templates');?>"><span data-feather="message-circle" class="text-primary mr-3"></span> Шаблоны оповещений</a>
                <a class="dropdown-item" href="<?php echo base_url('my/profile');?>"><span data-feather="lock" class="text-primary mr-3"></span> Пароль и Email</a>
                <a class="dropdown-item" href="<?php echo base_url('my/addmenager');?>"><span data-feather="user-plus" class="text-primary mr-3"></span> Менеджеры</a> 
            </div>
            <?php echo form_open(site_url("my/search"), array("class" => "w-100")) ?>
            <input class="form-control form-control-dark w-100" name="phone" type="text" placeholder="Поиск по телефону" aria-label="Search">
            <?php echo form_close(); ?>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="<?php echo base_url('my/logout');?>">Выход</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('orders'); ?>" href="<?php echo base_url('my/orders');?>">
                                    <span data-feather="users"></span>
                                     Регистрация
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('rent'); ?>" href="<?php echo base_url('my/rent');?>">
                                    <span data-feather="clock"></span>
                                    Аренда
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('feedback'); ?>" href="<?php echo base_url('my/feedback');?>">
                                    <span data-feather="mail"></span>
                                     Обратная связь
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('pages'); ?>" href="<?php echo base_url('my/pages');?>">
                                    <span data-feather="edit"></span>
                                    Менеджер контента
                                </a>
                            </li>
                        </ul>

                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Конфигурация</span>
                            <a class="d-flex align-items-center text-muted" href="#">
                                <span data-feather="settings"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('sms'); ?>" href="<?php echo base_url('my/sms');?>">
                                    <span data-feather="radio"></span>
                                    SMS шлюз
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('emails'); ?>" href="<?php echo base_url('my/emails');?>">
                                    <span data-feather="at-sign"></span>
                                    Email шлюз
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('templates'); ?>" href="<?php echo base_url('my/templates');?>">
                                    <span data-feather="message-circle"></span>
                                    Шаблоны оповещений
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('profile'); ?>" href="<?php echo base_url('my/profile');?>">
                                    <span data-feather="lock"></span>
                                    Пароль и Email
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo activate_menu('addmenager'); ?>" href="<?php echo base_url('my/addmenager');?>">
                                    <span data-feather="user-plus"></span>
                                    Менеджеры
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

                    <?php if ($this->session->flashdata('error')) : // Error message ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                        <?php echo $this->session->flashdata('error');?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')) : // Success message ?>
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        <?php echo $this->session->flashdata('success');?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php echo $contents;?>

                </main>
                
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="<?php echo base_url();?>themes/bootstrap/js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="<?php echo base_url();?>themes/bootstrap/js/admin.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>

    </body>
</html>