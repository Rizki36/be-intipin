    @extends('layouts.client.main')

    @section('container')
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="hero d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">We offer modern solutions for growing your business</h1>
                        <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented designers making websites with
                            Bootstrap</h2>
                        <div data-aos="fade-up" data-aos-delay="600">
                            <div class="text-center text-lg-start">
                                <a href="#about"
                                    class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Get Started</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="assets/img/hero-img.png" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero -->

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <section id="portfolio-details" class="portfolio-details">
                    <div class="container">

                        <div class="row gy-4">

                            <div class="col-lg-12">
                                <div class="portfolio-details-slider swiper">
                                    <div class="swiper-wrapper align-items-center">
                                        @foreach ($gallery as $item)
                                            <div class="swiper-slide">
                                                <img src="{{ asset("images/$item->filename") }}" alt="">
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </section>
            </section>
            <!-- End About Section -->

            <!-- ======= Values Section ======= -->
            <section id="values" class="values">
                <div class="container" data-aos="fade-up">
                    <header class="section-header">
                        <p>Lorem adalah blablabla</p>
                    </header>

                    <!-- Feature Tabs -->
                    <div class="row feture-tabs" data-aos="fade-up">
                        <div class="col-lg-6">
                            <h3>Neque officiis dolore maiores et exercitationem quae est seda lidera pat claero</h3>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita.
                                        Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check2"></i>
                                        <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                                    </div>
                                    <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                                        dolorum non eveniet magni quaerat nemo et.</p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-check2"></i>
                                        <h4>Incidunt non veritatis illum ea ut nisi</h4>
                                    </div>
                                    <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta
                                        tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at.
                                        Dolorem quo tempora. Quia et perferendis.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <img src="assets/img/features-2.png" class="img-fluid" alt="" />
                        </div>
                    </div>
                    <!-- End Feature Tabs -->

                    <!-- ======= Values Section ======= -->
                    <section id="values" class="values">

                        <div class="container" data-aos="fade-up">

                            <header class="section-header">
                                <p>Intipin Apa Ajasih</p>
                            </header>

                            <div class="row">

                                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                                    <div class="box">
                                        <img src="assets/img/values-1.png" class="img-fluid" alt="">
                                        <h3>Ad cupiditate sed est odio</h3>
                                        <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et
                                            veritatis id.</p>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                                    <div class="box">
                                        <img src="assets/img/values-2.png" class="img-fluid" alt="">
                                        <h3>Voluptatem voluptatum alias</h3>
                                        <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit
                                            non.</p>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                                    <div class="box">
                                        <img src="assets/img/values-3.png" class="img-fluid" alt="">
                                        <h3>Fugit cupiditate alias nobis.</h3>
                                        <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem
                                            commodi.</p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </section>
                @endsection
