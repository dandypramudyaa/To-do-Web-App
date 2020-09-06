<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>Dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user" style="margin-top: 10px;"></i> Change Password
                <a href="<?= base_url(); ?>Myprofile/ubahpassword">
                    <button type="button" class="btn btn-info float-right">Ganti Password</button>
                </a>
            </div>
            <div class="card-body">

                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Change password is <?= $this->session->flashdata('flash') ?>!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('flash_error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Your old password is <?= $this->session->flashdata('flash_error') ?>!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('flash_error1')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Your new password is the <?= $this->session->flashdata('flash_error1') ?> as your old password!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url() ?>Profile/changepassword">
                    <div class="form-group row">
                        <label for="old" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="old" id="old" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="new" id="new" placeholder="New Password">
                            <small class="form-text" style="color: red;"><?php echo form_error('new'); ?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="joindate" class="col-sm-2 col-form-label">Retype new password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="new1" name="new1" placeholder="New Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2 mt-4">
                            <button class="btn btn-primary" type="submit" name="profile">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>