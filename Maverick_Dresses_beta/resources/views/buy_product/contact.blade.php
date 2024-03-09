@extends('home')
@section('content')

<style>
iframe{
  position: absolute;
  left: 40%;
}

.media-body{
  margin-bottom: 13px;
}
</style>

<section class="breadcrumb breadcrumb_bg"  >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="breadcrumb_iner">
          {{-- <div class="breadcrumb_iner_item">
            <h2>Contact us as soon as you can
            </h2>
            <p>Are you confused about the website?  <span>-</span> Want to get in touch with us?</p>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>

  <section class="contact-section padding_top" >
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
        <div id="map" ><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0611126813815!2d106.71007721534757!3d10.806631461589147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a330e608a5%3A0x4cc00c5927dcb361!2zMzUsIDYgxJDGsOG7nW5nIEQ1LCBQaMaw4budbmcgMjUsIELDrG5oIFRo4bqhbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCA3MjMwOCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1656942548542!5m2!1svi!2s" width="50%" height="480px" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe></div>
      </div>


        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Aptech</h3>
              <p>35/5 Đường D5 P.25 Q.BT TP.HCM</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>(84+)379409979</h3>
              <p>Monday to Saturday, 7am to 12pm</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3>16minhkha06@gmail.com</h3>
              <p>Send us your questions at any time!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->
  <div>@include('../blockhome.footer_part')</div>
@endsection