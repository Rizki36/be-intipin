@extends('layouts.main')

@section('container')

<section id="portfolio-details" class="portfolio-details">
    <div class="container">
        <h1 class="section-header">
            <p>Pondok Pesantren</p>
        </h1>
        <div class="row gy-4">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kecamatan</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Jombang</option>
                        <option>Diwek</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1012356.359898617!2d112.18777560418242!3d-7.627409963802689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e786a948f359a31%3A0x3027a76e352bd20!2sKabupaten%20Jombang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1652928028955!5m2!1sid!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Test Klik
                    Marker</button>
            </div>
        </div>
    </div>
</section>


<!-- ======= Footer ======= -->

<!-- End Footer -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div>
    </div>
  </div>
@endsection