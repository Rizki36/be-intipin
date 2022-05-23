    @extends('layouts.client.main')

    @section('container')
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="hero d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <div data-aos="fade-up">{!! $description_1 !!}}</div>
                        <div data-aos="fade-up" data-aos-delay="600">
                            <div class="text-center text-lg-start">
                            </div>
                        </div>
                    </div>
                    @if ($image_1 != '')
                        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">`
                            <img src="{{ asset("images/$image_1") }}" class="img-fluid" alt="" />
                        </div>
                    @endif
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

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="d-flex align-items-center mb-2">
                                    </div>
                                    {!! $description_2 !!}
                                </div>
                            </div>
                        </div>

                        @if ($image_2 != '')
                            <div class="col-lg-6">
                                <img src="{{ asset("images/$image_2") }}" class="img-fluid" alt="" />
                            </div>
                        @endif
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
