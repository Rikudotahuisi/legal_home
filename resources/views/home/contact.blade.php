@extends('master.master')
@section('content')
<style>
  *, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    margin-top: 40px;
    margin-bottom: 40px;
    background-color: rgba(102,37,17,0.88);
  }
  .contact-in {
    max-width: 1100px;
    width: 90%;
    margin: 40px auto;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 16px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.25);
  }
  .contact-map {
    flex: 1 1 45%;
    min-width: 280px;
  }
  .contact-map iframe {
    width: 100%;
    height: 100%;
    min-height: 320px;
    border: 0;
    border-radius: 6px;
  }
  .contact-form {
    flex: 1 1 45%;
    min-width: 260px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .contact-form h2 { text-align: center; margin-bottom: 12px; }
  .contact-input {
    width: 100%;
    height: 44px;
    color: #000;
    border: 1px solid #bcbcbc;
    border-radius: 8px;
    padding: 10px 14px;
    margin-bottom: 12px;
    font-size: 15px;
  }
  .contact-input::placeholder { color: #aaa; }
  .contact-textarea {
    width: 100%;
    min-height: 130px;
    color: #000;
    border: 1px solid #bcbcbc;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 12px;
    font-family: inherit;
    font-size: 15px;
  }
  .contact-btn {
    width: 160px;
    border: none;
    border-radius: 6px;
    background: #8e2de2;
    color: #fff;
    text-transform: uppercase;
    padding: 10px 14px;
    cursor: pointer;
    font-size: 14px;
    align-self: center;
  }
  @media (max-width: 760px) {
    .contact-in { flex-direction: column; }
    .contact-map, .contact-form { flex: 1 1 100%; }
  }
</style>

<div class="contact-in">
  <div class="contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.333690872703!2d119.87430417377061!3d-0.893038899098316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d8bedd9e19db635%3A0xbdc233f33d0a62cf!2sNew%20Central%20Stationery%20%26%20Cosmetics!5e0!3m2!1sid!2sid!4v1706494671512!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  <div class="contact-form">
    <h2><strong>Contact us</strong></h2>
    <form method="POST" action="#">
      @csrf
      <input type="text" name="name" placeholder="Name" class="contact-input" />
      <input type="email" name="email" placeholder="Email" class="contact-input" />
      <textarea name="message" placeholder="Message" class="contact-textarea"></textarea>
      <button type="submit" class="contact-btn">Kirim</button>
    </form>
  </div>
</div>

@endsection