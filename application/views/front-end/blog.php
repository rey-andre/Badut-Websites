<!-- Blog Section Start -->
<section id="blog" name="top" class="bg-slate-100 pt-36 pb-32 dark:bg-dark">
      <div class="container">
        <div class="w-full px-4">
          <div class="mx-auto mb-16 max-w-xl text-center">
            <h4 class="mb-2 text-lg font-semibold text-primary">Blog</h4>
            <h2 class="mb-4 text-3xl font-bold text-dark dark:text-white
            sm:text-4xl lg:text-5xl">Blog Badut</h2>
            <p class="text-md font-medium text-secondary md:text-lg">Ini adalah blog dari badut🤡.</p>
          </div>
        </div>

        <div class="flex flex-wrap">
          <!-- looping di sini -->
          <?php foreach ($blog as $row) : ?>
            <div class="w-full px-4 md:w-1/2 xl:w-1/3">
              <div class="mb-10 overflow-hidden rounded-xl bg-white shadow-lg dark:bg-slate-800">
                <img src="<?= base_url('assets/img/blog/'.$row->gambar); ?>" alt="<?= $row->slug; ?>" class="w-full">
                <div class="py-8 px-6">
                  <h3>
                    <a href="<?= base_url('blog/'). $row->slug ?>" class="mb-3 block truncate text-xl font-semibold text-dark hover:text-primary dark:text-white dark:hover:text-primary">
                      <?php
                      $judul = $row->judul;
                      if (strlen($judul) >= 32) {
                        $judul = substr(strip_tags($judul),0,32). '...';
                      }
                      echo $judul;
                      ?>
                    </a>
                  </h3>
                  <ul class="flex justify-between">
                    <li>
                      <h4 class="mb-2 text-sm font-medium text-primary"><i class="fa-solid fa-user"></i> <?= $row->name; ?></h4>
                    </li>
                    <li>
                        <p class="mb-2 text-sm font-medium text-secondary"><i class="fa-solid fa-calendar-days"></i> <?= date('d F Y', $row->tanggal); ?></p>
                    </li>
                  </ul>
                  <p class="mb-6 text-base font-medium text-dark dark:text-secondary">
                  <?php
                      $isi = $row->isi;
                      if (strlen($isi) >= 65) {
                        $isi = substr(strip_tags($isi),0,65). '...';
                      } else {
                        $isi = strip_tags($isi);
                      }
                      echo $isi;
                      ?>
                  </p>
                  <a href="<?= base_url('blog/'). $row->slug ?>" class="rounded-lg bg-primary py-2 px-4 text-sm font-medium text-white hover:opacity-80">Lihat Blog</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- Blog Section End -->