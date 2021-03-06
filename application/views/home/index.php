<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Dashboard</li>
                    <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Hello, <?= $user['nama'] ?></h1>
            <p class="lead">Welcome to the To-do web app, where you can make notes with your plans, so you don't forget your plans. Enjoy it.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Make to-do list now!</a>
            </p>
        </div>
    </div>
</section>