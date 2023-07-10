

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
								List Blog
							</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Gambar</th>
                                            <th>Tanggal</th>
                                            <th>Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php $no=1; foreach ($blog as $row) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->judul ?></td>
                                            <td>
                                                <img src="<?=base_url('assets/img/blog/') . $row->gambar ?>" alt="<?= $row->slug ?>" width="300">
                                            </td>
                                            <td><?= date('d F Y', $row->tanggal) ?></td>
                                            <td><?= $row->name ?></td>
                                            <td>
                                                <a href="<?= base_url('dashboard/blog/edit/'.$row->id);?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-fw fa-pen"></i>
                                                </a>
                                                <a href="<?= base_url('dashboard/blog/hapus/'.$row->id);?>" class="btn btn-sm btn-danger" id="btn-hapus">
                                                    <i class="fas fa-fw fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            

            
    