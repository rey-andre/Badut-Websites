

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>

                    <div class="row">
                            <div class="col-lg-6">
                                <!-- <?= $this->session->flashdata('alert'); ?> -->
                            </div>
                        </div>

                    <section style="background-color: #eee;">
                        <div class="container py-5">
                            <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="<?=base_url('assets/img/profile/') . $user['image'] ?>" alt="<?= $user['name']; ?>"
                                    class="img-thumbnail img-fluid">
                                    <h5 class="my-3"><?= $user['name']; ?></h5>
                                    <p class="text-muted mb-4"><small>Akun dibuat sejak <?= date('d F Y', $user['date_created']) ?></small></p>
                                    <div class="d-flex justify-content-center mb-2">
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= $user['name']; ?></p>
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= $user['email']; ?></p>
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Instagram</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">@<?= $user['instagram']; ?></p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <img src="https://badutmemori.github.io/dist/img/patrick.png" alt="badut" class="img-fluid mx-auto" width="300">
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


    