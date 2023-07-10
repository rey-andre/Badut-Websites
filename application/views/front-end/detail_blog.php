    <!-- Blog Section Start -->
    <section id="blog" name="top" class="bg-slate-100 pt-36 pb-32 dark:bg-dark">
        <div class="container">
            <div class="w-full px-4">
                <div class="mx-auto mb-1 max-w-xl text-center">
                  <h4 class="mb-2 text-lg font-semibold text-primary">Galeri</h4>
                  <h2 class="mb-0 text-3xl font-bold text-dark dark:text-white
                  sm:text-4xl lg:text-5xl"><?=$blog->judul;?></h2>               
                </div>
                <div class="container">
                    <ul class="flex">
                        <li>
                            <h4 class="mb-2 text-sm lg:text-lg font-medium text-primary"><i class="fa-solid fa-user"></i> <?=$admin->name?></h4>
                        </li>
                        <li class="px-4">
                            <p class="mb-2 text-sm lg:text-lg font-medium text-secondary"><i class="fa-solid fa-calendar-days"></i> <?= date('d F Y', $blog->tanggal); ?></p>
                        </li>
                    </ul>
                    <img src="<?=base_url('assets/img/blog/'.$blog->gambar);?>" alt="Progamming" class="w-full rounded-lg mb-4">
                    <div class="tulisan-blog">
                        <p class="text-md font-medium text-secondary md:text-lg">
                            <?=($blog->isi);?>
                        </p>
                    </div>
                </div>
              </div>
        </div>
    </section>
    <!-- Blog Section End -->