@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Meet The Team</h1>
                <p>Meet the team behind REPs UAE</p>
            </div>
        </div>
    </div>

    <div class="row">
        @if (isset($showme))
        <div id="teamImage" class="small-12 columns">
            {{ HTML::image('img/reps_team.png','The REPs UAE team',array('id' => '')) }}
            <p>The REPs UAE team with <b>Richard Beddie</b><br />(Chairman of ICREPS)</p>
        </div>
        @endif
        <div class="teamMember clearfix">
            <div class="teamMemberPic">
                {{ HTML::image('img/naser_al_tamimi.png','Naser Al Tamimi',array()) }}
                <p>
                    <b>Naser Al Tamimi</b><br />
                    CEO
                </p>
            </div>
            <p class="teamMemberDesc">
                The CEO leading the REPs UAE team holds a Masters degree
                in Sports Management and a Bachelor’s degree in Physical
                Education and is one of the UAE’s most iconic athletes, carrying
                in his backpack over 30 years of Sports Management
                and Athlete expertise in an array of sports fields, with a
                specialisation in Basketball.
                In 1999 Nasser launched the first commercial Health Club
                in Abu Dhabi – The Abu Dhabi Health and Fitness Club, the
                first Club in the Middle East to introduce Les Mills pre-choreographed
                group fitness classes.
                Mr. Al Tamimi was instrumental in introducing Judo and
                Wrestling to UAE Schools as well as Clubs and to date is a
                board member of the UAE WJ Federation, International Judo
                Federation and on the board of the National Olympic Committee.
                Passionate about developing the sports sector in the
                UAE and in particular for children in the Emirates, Mr. Al
                Tamimi may be contacted at naser@repsuae.com
            </p>
        </div>
        <div class="teamMember clearfix">
            <div class="teamMemberPic">
                {{ HTML::image('img/catherine_hanson_farid.png','Catherine Hanson Farid',array()) }}
                <p>
                    <b style="font-size:12px;">Catherine Hanson Farid</b><br />
                    Director of Operations
                </p>
            </div>
            <p class="teamMemberDesc">
                Catherine is a  UK certified Group Fitness Instructor and Personal Trainer who boasts 30 years’ experience within the Fitness Industry. Before arriving to the UAE in 1995 she worked in a variety of health clubs from Golds in South Australia, Canons London and YMCA London. Along with Naser Tamimi, REPs CEO, she was instrumental in introducing the Les Mills programs to the UAE back in 1999 and together they opened the first commercial health club in the UAE – 'Abu Dhabi Health and Fitness Club'. Aside from teaching group fitness classes for a  variety of clubs in Dubai and training some of the UAE Royal family,  Catherine represented the UAE at World Figure bodybuilding competitions and brought home bronze, silver and gold medals. She retired from competing after the world renowned Arnold Classic Competition in March 2010.  Catherine's passion also extends to writing and has had her own monthly health and fitness columns in Physique and New You Magazines. She can be reached on catherine@repsuae.com
            </p>
        </div>
        <div class="teamMember clearfix">
            <div class="teamMemberPic">
                {{ HTML::image('img/ben_gittus.png','Ben Gittus',array()) }}
                <p>
                    <b>Ben Gittus</b><br />
                    Technical Director
                </p>
            </div>
            <p class="teamMemberDesc">
Ben is responsible for the register levels, categories, standards and qualification systems and has been instrumental in the setup of REPs in the UAE. From the UK, Ben holds a Master degree in Sports Development and has been involved in fitness education and registers for many years. Ben has worked in the UK supporting REPs UK and has played a role in the development of the International Confederation of Registers of Exercise Professionals (ICREPs.) He now works in international sport and fitness consultancy through a company he runs with two colleagues from Europe–EOSE Services. Ben can be contacted at ben@repsuae.com
            </p>
        </div>
        @if (isset($showme))
        <div class="teamMember clearfix">
            <div class="teamMemberPic">
                {{ HTML::image('img/magdalena_lyle.png','Magdalena Lyle',array()) }}
                <p class="three">
                    <b>Magdalena Lyle</b><br />
                    Industry Development Manager
                </p>
            </div>
            <p class="teamMemberDesc">
                She is the Industry Development Manager for REPS UAE
                and also assists their Technical Director, Ben Gittus, in the
                assessment of REPs applicants.
                Magdalena is an internationally recognised Fitness Professional.
                She is an Australian Certified Master Personal Trainer
                (FISAF) and qualified through the Poliquin International Certification
                Program in Strength and Conditioning Coach Level
                1, 2, 3 and 4 is a Level 2 Bio-signature Practitioner. Additionally
                she holds qualifications that further broaden her array
                of knowledge from a diploma in Training and Assessment
                Systems to Fascial Release.
                Magdalena has lived in the UAE for seven years and
                worked as a Strength Coach in Abu Dhabi and Dubai. She is
                currently studying Functional/Integrative Medicine and can
                be contacted on magdalena@repsuae.com
            </p>
        </div>
        @endif
        <div class="teamMember clearfix">
            <div class="teamMemberPic ">
                {{ HTML::image('img/pam.png','Pamela',array()) }}
                <p style="line-height: 18px;">
                    <b>Pamela Sia</b><br />
                    <span style="font-size: 11px;">Membership and Marketing Coordinator</span>
                </p>
            </div>
            <p class="teamMemberDesc">
                Pam is responsible for the renewals of members and ensuring that they are completing continuing education every year.  She is also the point of contact for trainers and fitness managers if they need assistance in renewing or if they have inquiries about their membership.  Pam is the most IT savvy person in the REPs office and assists the team in various aspects from membership inquiries, marketing, social media and administration.  Pam can be contacted on membership@repsuae.com
            </p>
        </div>
        <div class="teamMember clearfix">
            <div class="teamMemberPic">
                {{ HTML::image('img/natalie.png','Natalie Safa',array()) }}
                <p style="line-height: 18px;">
                    <b>Natalie Safa</b><br />
                    <span style="font-size: 11px;">Membership Coordinator - <br>Abu Dhabi</span>
                </p>
            </div>
            <p class="teamMemberDesc">
                Natalie is responsible for overseeing new and existing memberships for REP’s Abu Dhabi members and to liaise with and support the Abu Dhabi Sports Council, Health Club Managers and Fitness Professionals in the capital.  Natalie is a lifelong fitness enthusiast and has spent her life pursuing her passion and in the process achieved multiple certifications in fitness from personal training to functional training and Muay Thai.  Natalie grew up in Abu Dhabi and has over five years experience working in corporate Sales and Marketing, which has provided her with a wide network in the city.  She is passionate about seeing the fitness industry grow in Abu Dhabi and the UAE.
            </p>
        </div>
        <div class="teamMember clearfix">
            <div class="teamMemberPic ">
                {{ HTML::image('img/tine.png','Kristine',array()) }}
                <p>
                    <b>Kristine Garcia</b><br />
                    Office Coordinator
                </p>
            </div>
            <p class="teamMemberDesc">
                Tine is the first point of contact and assists the team in inquiries and administration.  She also provides assistance to members through phone, email and when they walk in to the REPs office.  Tine can be contacted on faisal.ayaz@sigmads.com
            </p>
        </div>
    </div>

    
   @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
