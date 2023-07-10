<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$title?> | Badut</title>
    <link href="<?= base_url('')?>assets/css/main.css" rel="stylesheet" />
    <link href="<?= base_url('')?>assets/css/blog.css" rel="stylesheet" />

    <link rel="shortcut icon" href="https://badutmemori.github.io/dist/img/patrick.png" type="image/x-icon">

    <!-- font awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- SwipperJS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    
  
    </script>
    <script>
      if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    </script>
    <style>
      .swiper {
        width: 240px;
        height: 320px;
      }
      .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        font-size: 22px;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <!-- Header Start -->
    <header class="absolute top-0 left-0 z-10 flex w-full items-center bg-transparent">
      <div class="container" data-aos="fade-down" data-aos-duration="500">
        <div class="relative flex items-center justify-between">
          <div class="px-4">
            <a href="<?=base_url();?>" class="block py-6 text-lg font-bold text-primary">badutpunyamemori</a>
          </div>
          <div class="flex items-center px-4">
            <button id="hamburger" name="hamburger" type="button" class="absolute right-4 block lg:hidden">
              <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
              <span class="hamburger-line transition duration-300 ease-in-out"></span>
              <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
            </button>

            <nav
              id="nav-menu"
              class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg dark:bg-dark dark:shadow-slate-500 lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none lg:dark:bg-transparent"
            >
              <ul class="block lg:flex">
                <li class="group">
                  <a href="<?=site_url('')?>" class="mx-8 flex py-2 text-base text-dark group-hover:text-primary dark:text-white">Beranda</a>
                </li>
                <li class="group">
                  <a href="<?=site_url('')?>#about" class="mx-8 flex py-2 text-base text-dark group-hover:text-primary dark:text-white">Tentang Badut</a>
                </li>
                <li class="group">
                  <a href="<?=site_url('')?>#member" class="mx-8 flex py-2 text-base text-dark group-hover:text-primary dark:text-white">Member</a>
                </li>
                <li class="group">
                  <a href="<?=site_url('blog')?>" class="mx-8 flex py-2 text-base text-dark group-hover:text-primary dark:text-white">Blog</a>
                </li>
                <li class="group">
                  <a href="#contact" class="mx-8 flex py-2 text-base text-dark group-hover:text-primary dark:text-white">Contact</a>
                </li>
                <li class="group">
                  <a href="<?=site_url('login')?>" class="mx-8 flex py-2 text-base text-dark group-hover:text-primary dark:text-white">Login</a>
                </li>
                <li class="mt-3 flex items-center pl-8 lg:mt-0">
                  <div class="flex">
                    <span class="mr-2 text-sm text-slate-500">light</span>
                    <input type="checkbox" class="hidden" id="dark-toggle" />
                    <label for="dark-toggle">
                      <div class="flex h-5 w-9 cursor-pointer items-center rounded-full bg-slate-500 p-1">
                        <div class="toggle-circle h-4 w-4 rounded-full bg-white transition duration-300 ease-in-out"></div>
                      </div>
                    </label>
                    <span class="ml-2 text-sm text-slate-500">dark</span>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- Header End -->