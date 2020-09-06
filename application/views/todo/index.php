<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">My To-do List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>Dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">To-do List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-list-ul" style="margin-top: 10px;"></i> Task List
                <a href="<?= base_url(); ?>Todo/new">
                    <button type="button" class="btn btn-info float-right">+ Add New Task</button>
                </a>
            </div>
            <div class="card-body">

                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $this->session->flashdata('flash') ?> </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php foreach ($todo as $data) : ?>

                    <?php if ($data['status'] == 'Unfinished') : ?>
                        <div class="callout callout-danger">
                        <?php elseif ($data['status'] == 'Finished') : ?>
                            <div class="callout callout-success">
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="widget-content-left">
                                        <div class="widget-heading"><?= $data['tanggal'] ?>
                                            <?php if ($data['status'] == 'Unfinished') : ?>
                                                <div class="badge badge-danger ml-2">Unfinished</div>
                                            <?php elseif ($data['status'] == 'Finished') : ?>
                                                <div class="badge badge-success ml-2">Finished</div>
                                            <?php endif; ?>
                                            <div class="widget-heading"><?= $data['task'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="widget-content-right float-right">
                                        <button class="border-0 btn-transition btn btn-outline-success" data-toggle="modal" data-target="#modal-selesai<?= $data['id_tasklist'] ?>">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button class="border-0 btn-transition btn btn-outline-danger" data-toggle="modal" data-target="#modal-hapus<?= $data['id_tasklist'] ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal-selesai<?= $data['id_tasklist'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success">
                                                <h4 class="modal-title">Finished Task</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Have you completed this task?</h5>
                                            </div>
                                            <div class="modal-footer justify-content-between">

                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                                <a href="<?= base_url(); ?>Todo/finish/<?= $data['id_tasklist']; ?>">
                                                    <button type="button" class="btn btn-success">Yes, I finished</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal-hapus<?= $data['id_tasklist'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title">Success Modal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Do you want to delete this task?</h5>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                <a href="<?= base_url(); ?>Todo/delete/<?= $data['id_tasklist']; ?>">
                                                    <button type="submit" class="btn btn-danger">Yes, I want to delete it</button>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                            </div>
                            </div>
                        <?php endforeach; ?>

                        </div>

            </div>
        </div>
    </div>
</section>