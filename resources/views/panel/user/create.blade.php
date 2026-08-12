@extends('master.master')
@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row gx-lg-0 gy-4">
                <div class="col-lg-6">
                    <div class="info-container d-flex flex-column align-items-center justify-content-center">
                        <!-- <div class="wrapper"> -->
                            <div class="box">
                                <div class="input-bx">
                                    <form action="">
                                        <input type="file" class="cloudsaja" id="upload" accept=".doc, .docx, .pdf" />
                                        <label for="upload" class="uploadlabel">
                                            <span><i class="fa fa-cloud-upload"></i> Click To Upload</span>
                                        </label>
                                    </form>
                                </div>

                                <div id="filewrapper">
                                    <h3 class="uploaded">Uploaded Documents</h3>
                                </div>
                                <form method="post" role="form" class="php-email-forms">
                                    <div class="form-group mt-3">
                                        <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
                                        <div class="text-center"><button type="submit">Send Message</button></div>
                                    </div>
                                    <div class="my-3">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>
                                    </div>
                                </form>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>

                <div class="col-lg-6">
                    <form method="post" role="form" class="php-email-form">
                        <div class="container-fluid">
                            <div class="row">
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection