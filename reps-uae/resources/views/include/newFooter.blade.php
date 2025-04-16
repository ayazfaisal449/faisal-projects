<div class="new-footer">
    <style>
        .g-recaptcha {
            margin-top: 5px;
            transform: scale(0.77);
            transform-origin: 0 0;
            margin-bottom: -12px;
        }
        form#contactForm input, form#contactForm textarea {
            margin: 0px !important;
            margin-top: 1em !important;
        }
        .cont_frm_err_name, .cont_frm_err_mail, .cont_frm_err_msg, .cont_frm_err_capt, .cont_frm_errord, .cont_frm_success {
            display: none;
            color: red;
        }
        @media only screen and (max-width: 600px) {
            .g-recaptcha {
                /*transform: scale(1.4);
                margin-bottom: 0px;*/
            }
        }
    </style>
    
    <div class="row">
        <div class="columns large-3 medium-6 small-12">
            <div class="contact-forms">
                <?php 
                    use Illuminate\Support\Facades\DB;
                    $setting = DB::table('setting')->get();
                ?>
                <h5 class="bold-p">Opening Hours :</h5>
                <p class="border-b">{{ $setting[0]->opening_hours ? $setting[0]->opening_hours : '' }}</p>
                <h5 class="bold-p">Ramadan Timings :</h5>
                <p class="border-b">{{ $setting[0]->ramadan_timing ? $setting[0]->ramadan_timing : '' }}</p>
                
                <div class="row">
                    <div class="columns large-2 medium-1 small-1 top10">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="columns large-10 medium-11 small-11 top10">
                        <p class="normal-p">{!! $setting[0]->location !!}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="columns large-2 medium-1 small-1 top10">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="columns large-10 medium-11 small-11 top10">
                        <p class="normal-p"><a href="tel:{{ $setting[0]->mobile ? $setting[0]->mobile : '' }}">{{ $setting[0]->mobile ? $setting[0]->mobile : '' }}</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="columns large-2 medium-1 small-1 top10">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="columns large-10 medium-11 small-11 top10 bottom20">
                        <p class="normal-p"><a href="mailto:faisal.ayaz@sigmads.com">{{ $setting[0]->information ? $setting[0]->information : '' }}</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns large-3 medium-6 small-12 contact-mobile">
            <div class="contact-forms">
                <form action="{{ url('contact/send') }}" method="POST" id="contactForm" class="msgrepss">
                    {{-- {{ csrf_field() }} --}}
                    
                    <div class="row">
                        <div class="large-12 small-12 columns">
                            <input type="text" name="firstname" style="display:none;">
                            <span class="cont_frm_err cont_frm_errord">test</span>
                            <span class="cont_frm_err cont_frm_success" style="color: green;">test</span>
                            <input type="text" name="name" placeholder="Name" class="f_name">
                            <span class="cont_frm_err cont_frm_err_name">Name is required</span>
                            <input type="email" name="email" placeholder="Email" class="f_mail">
                            <span class="cont_frm_err cont_frm_err_mail">E-mail should be a valid address.</span>
                        </div>
                        <div class="large-12 small-12 columns">
                            <textarea name="message" placeholder="Message" class="f_msg" rows="10" cols="15"></textarea>
                            <span class="cont_frm_err cont_frm_err_msg">Message is required</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Ld3xqoUAAAAAJQsrI5nC-K-jmmWkLK3INJi8P6t"></div>
                        <span class="cont_frm_err cont_frm_err_capt">Captcha is required</span>
                    </div>
                    
                    <button type="submit" class="submitBtn float-right sndmsg cont_form">Send Message</button>
                </form>
            </div>
        </div>

        <div class="columns large-2 medium-6 small-6">
            <div class="bg-diff">
                <h1 class="subtitle-green">SITE MAP</h1>
                <a class="top10" href="{{ url('about') }}">About Reps</a>
                <a href="{{ url('blog') }}">Blogs</a>
                <a href="{{ url('meet-the-team') }}">Meet The Team</a>
                <a href="{{ url('partners') }}">Partners</a>
                <a href="{{ url('global-registers') }}">Global Partners</a>
                <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ url('terms-and-conditions') }}">Terms & Conditions</a>
            </div>
        </div>

        <div class="columns large-2 medium-6 small-6">
            <h1 class="subtitle-green">FOLLOW US</h1>
            <div class="follow-reps clearfix">
                <a class="fb-link" href="https://www.facebook.com/REPSUAE/" target="_blank"><i class="fa fa-facebook-official"></i></a>
                <a class="insta-link" href="https://www.instagram.com/repsuae/" target="_blank"><i class="fa fa-instagram"></i></a>
            </div>
            
            <div class="block-image">
                <img src="{{ url('img/dsc.png') }}" />
            </div>
            <div class="block-image">
                <img src="{{ url('img/sarjah.png') }}" />
            </div>
            <div class="block-image payment-methods">
                <img src="https://sassme.ecwid.com/static/v1/icons/mastercard.svg" />
                <img src="https://sassme.ecwid.com/static/v1/icons/visa.svg" />
            </div>
            <style>
                .payment-methods {
                    max-width: 152px;
                }
                .payment-methods img {
                    width: 70px;
                    margin: 1px;
                    float: left;
                    background: #fff;
                }
            </style>
        </div>
    </div>
</div>

<div class="rights-reserve">
    <p><a href="http://craniumcreations.com" target="_blank">Dubai Development Company. </a>All Rights Reserved. REPS UAE</p>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    var dif = $('.new-footer').height();
    $(document).ready(function(){
        $('.bg-diff').css('height', dif + 'px');
    });
</script>
