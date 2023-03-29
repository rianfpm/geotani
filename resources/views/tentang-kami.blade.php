@extends('layout.main')

@section('container')

<section class="gtn-section gtn-py-100 my-5">
    <div class="container">
      <!--== row starts ==-->
      <div class="row">
        <!-- column 1 starts -->
        <div class="col-12 col-md-6">
          <img src="assets/images/logo-g-01.png" alt="image" />
        </div>
        <!-- column 1 ends -->

        <!-- column 2 starts -->
        <div
          class="col-12 col-md-6 small-device-space align-items-center d-flex"
        >
          <!-- heading starts -->
          <div class="gtn-section-intro text-left">
            <div class="gtn-intro-subheading-wrapper">
              <p class="gtn-intro-subheading">Apa itu GeoTani?</p>
            </div>
            <h2 class="gtn-intro-heading">GeoTani</h2>
            <p class="gtn-intro-content">
              GeoTani solusi hebat untuk petani cermat. Geotani merupakan
              website yang menyediakan berbagai layanan seperti
              rekomendasi tanaman, artikel, dan juga video edukasi.
            </p>
            <!-- button -->
            <!-- <a class="gtn-btn btn-blue gtn-px-lg gtn-mt-50" href="#" role="button"> <span class="gtn-btn-text">Tonton
          Sekarang</span> </a> -->
          </div>
          <!-- heading ends -->
        </div>
        <!-- column 2 ends -->
      </div>
      <!--== row ends ==-->
    </div>
  </section>
  <!-- contact section starts
================================================== -->
  <section id="contact" class="gtn-section gtn-py-100">
    <div class="container">
      <!-- heading starts -->
      <div class="gtn-section-intro text-center gtn-mb-50">
        <div class="gtn-intro-subheading-wrapper">
          <p class="gtn-intro-subheading">Kontak Kami</p>
        </div>
        <h2 class="gtn-intro-heading">
          Apakah ada yang bisa kami bantu?
        </h2>
        <p class="gtn-intro-content">
          Ada pertanyaan atau sekedar katakan hai
          <img
            draggable="false"
            role="img"
            class="emoji"
            alt="👋"
            src="https://s.w.org/images/core/emoji/13.1.0/svg/1f44b.svg"
            width="20px"
          />
        </p>
      </div>
      <!-- heading ends -->

      <!--== row starts ==-->
      <div class="row">
        <!-- column 1 starts -->
        <div class="col-12 col-md-10 offset-md-1">
          <div class="gtn-box-wrapper">
            <div class="gtn-box gtn-shadow">
              <!-- form starts -->
              <form
                id="contactform"
                method="post"
                action="php/contact-form.php"
              >
                <fieldset>
                  <div class="gtn-form-row-2col">
                    <p class="gtn-form-column">
                      <label>Nama</label>
                      <input name="name" type="text" placeholder="Nama" />
                    </p>
                    <p class="gtn-form-column">
                      <label>Email</label>
                      <input
                        name="email"
                        class="required email"
                        type="text"
                        placeholder="Alamat Email"
                      />
                    </p>
                  </div>
                  <p class="gtn-form-field">
                    <label>Pesan</label>
                    <textarea
                      rows="5"
                      name="message"
                      class="required"
                      placeholder="Pesan..."
                    ></textarea>
                  </p>
                  <p class="antispam">
                    Leave this empty: <br />
                    <input name="url" />
                  </p>
                  <p
                    class="text-end"
                    style="margin-top: -40px; margin-right: 20px"
                  >
                    <button class="gtn-btn" type="submit">Submit</button>
                  </p>
                  <div id="contactresult"></div>
                </fieldset>
              </form>
              <!-- form ends -->
            </div>
          </div>
        </div>
        <!-- column 1 ends -->
      </div>
      <!--== row ends ==-->
    </div>
  </section>

@endsection