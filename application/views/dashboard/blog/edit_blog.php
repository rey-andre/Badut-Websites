

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>
                    <div class="container bg-white shadow py-3 mb-5 pr-5 rounded-lg">
                    <form action="<?php echo base_url('dashboard/blog/edit/'.$blog->id); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $blog->id; ?>">
                            <div class="form-group pb-3">
                                <label class="font-weight-bold" for="judul">Judul</label>
                                <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="text" class="form-control shadow-sm" id="judul" name="judul" value="<?= $blog->judul ?>">
                            </div>
                            <div class="form-group pb-3">
                                <label class="font-weight-bold" for="gambar">Gambar</label>
                                <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>'); ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/blog/') . $blog->gambar ;?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                            <label class="custom-file-label shadow-sm" for="gambar">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group pb-3">
                                <label class="font-weight-bold" for="isi">Tulisan</label>
                                <?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
                                <textarea name="isi" id="editor"><?= $blog->isi ?></textarea>
                            </div>
                            <?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary px-3 mx-auto shadow-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            
    