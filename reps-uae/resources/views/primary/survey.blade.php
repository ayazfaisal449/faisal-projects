@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    <div class="survey-banner">
        <img src="download/Survey-Page-Photo.png" alt="Survey Banner" class="banner-image">
        <div class="overlay-text"><h1>WORKING IN FITNESS SURVEY</h1></div>
        <img src="download/EOSE-Logo.png" alt="Logo 1" class="logo bottom-left">
        <img src="download/Final-Logo-REPs-transparent.png" alt="Logo 2" class="logo top-right">
        <img src="download/NCSF-Logo.png" alt="Logo 3" class="logo bottom-right">
    </div>
    <div class="pageTitle">
    <div class="row">
        <div class="large-12 columns">
           
        </div>
    </div>
</div>
<div class="row">
    <div class="small-12 columns">
        <p>
        We are excited to share the results of the 2024 UAE Working in Fitness Survey, recently conducted by REPs UAE. This comprehensive report, which you can view or download from the link below, covers key topics such as hours and pay, training and development, career paths, and fitness trends.</p>
        <p>This year, we partnered with the National Council on Strength and Fitness (NCSF) to bring you these insights. The NCSF is a global leader in health and fitness education, serving over 300,000 professionals worldwide. Their mission is to elevate professional standards and promote recognition and registration for qualified exercise professionals in health, fitness, and sport roles.</p>

        </p>
        {{-- <p>
            You can access and download the full report and executive summary below.
        </p>
        <p>
            We’d love to hear what you think – feel free to contact us on <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a>
        </p>
        <p>The REPs team</p> --}}
        <h2>EXECUTIVE SUMMARY</h2>
        <p>The REPs UAE Working in Fitness Survey (2024 edition) has been designed to be a key source of information on the fitness industry in the United Arab Emirates. The survey provides a unique opportunity to gauge the characteristics and views of the fitness workforce currently working in the UAE.</p>
        <p>It is hoped the results of the survey will be interesting and useful to a variety of stakeholders including Government entities, employers, training providers, and fitness professionals themselves.</p>
</p>
        <h3>THE COMPOSITION OF THE SAMPLE</h3>
        <p>The survey was promoted to people working in the UAE fitness industry and the total number of respondents was 287. They were asked to state their main role in fitness; 81.2% are working as exercise professionals (personal trainers, group fitness instructors etc.) and 18.8% as fitness managers. The sample of fitness professionals who completed the survey had a majority of male respondents with 58.2% male and 41.8% female. The majority (73.5%) are located in Dubai, with a further 16.7% working mostly in Abu Dhabi.</p>
        <p>A total of 48 different nationalities are represented in the sample of showing the truly international nature of the UAE fitness industry.</p>
        <h3>FITNESS TRENDS</h3>
        <p>We wanted to know how the fitness industry is adapting to the changing needs and priorities of the people who use our services. 86% of respondents believe that maintaining overall wellness (including health, fitness, nutrition, appearance) is a higher priority for consumers since the COVID pandemic. A further 74.3% of respondents believe the habits and demands of clients have changed since the COVID pandemic with a shift towards health consciousness and increased awareness and engagement.</p>
        <p>Among the general population the number one fitness goal of clients reported by respondents to the survey is weight loss, followed by better health / wellbeing/ disease prevention.</p>
        <p><strong>THE TOP FIVE THINGS RESPONDENTS HAVE IMPLEMENTED TO SUPPORT CLIENT WELLNESS ARE:</strong></p>
        <p>1. Holistic approach to fitness</p>
        <p>2. Personalised training</p>
        <p>3. Education and empowerment</p>
        <p>4. Adaptation to circumstances</p>
        <p>5. Mind-body connection</p>

        <p><strong>THE TOP FIVE FITNESS TRENDS AMONG RESPONDENTS WERE:</strong></p>
        <p>1. Personal training</p>
        <p>2. Exercise for weight loss</p>
        <p>3. Functional fitness training</p>
        <p>4. Body weight exercise</p>
        <p>5. Group exercise training</p>

        <p><em>(CHOSEN FROM ACSM WORLD-WIDE FITNESS TRENDS SURVEY OPTIONS)</em></p>

        <h3>EXERCISE PROFESSIONALS</h3>
        <p>The survey showed longevity of careers in fitness. Just over a third of respondents have been working as an exercise professional for 10 or more years, with further third of respondents working for 5 or more years in in fitness. This shows the industry has the ability to retain staff. </p>
        <p>89.5% of exercise professional respondents are a member of REPs showing their commitment to professional registration and personal development.</p>
        <p>What have traditionally been termed “special” populations, now appear to be the norm for exercise professionals when looking at the clients they work with. A large majority of exercise professionals work with older clients and children, with almost half also working with clients with disabilities and pre- and post-natal clients. A large majority also work with people with lower back pain and people with obesity/ diabetes and those recovering from injury.</p>
        <p>We wanted the survey results to inform future training provision in UAE. Key findings of interest to education providers include the fact that two thirds of respondents took their main fitness qualification in the UAE. It is encouraging to note that 82.6% of respondents have taken part in training and development in the last 12 months, including 57.4% reporting having done more than 3 days and 25.1% reporting having done more than 10 days. It is less encouraging to note that an overwhelming 86% of respondents reported that they alone pay for their training and development with no support from their employer.</p>
        
        <h3>FITNESS MANAGERS</h3>
        <p>We also wanted to study training needs of fitness managers, and with that in mind it is interesting to note that 44.4% of fitness managers held the role of exercise professional before they became a manager and 42.2% of manager respondents came from managing in another sector – both of these groups of managers may require training, either in generic management competencies or the specificities of the fitness industry. The leading training need for managers is in strategy, followed by leadership, managing people, finance and project management.</p>
        <p>The biggest areas of dissatisfaction for fitness managers are prospects for promotion and career development, and renumeration package, for those fitness managers who may leave the industry the most likely reason is low pay compared to other industries. However, a high proportion of respondents (79.5%) showed a strong commitment to the fitness industry and stated they expect to continue working in the industry for more than five years.</p>
        <p>An interesting finding was that exercise professionals broadly felt they were competent to begin work following their initial qualification, while fitness managers overwhelmingly reported the need to provide additional training to fitness staff to ensure they are work ready.
        <p>For both fitness managers and exercise professionals, the most popular stated time period it is felt necessary to complete a personal trainer qualification is between 3 and 6 months.</p>
        

        <h3>CONCLUSION</h3>
        <p>The results of the REPs UAE Working in Fitness Survey 2024 show a diverse, hard-working and flexible workforce serving the fitness and wellness needs of the UAE. REPs UAE looks forward to working with partners to take any actions they feel relevant after considering these results and continuing to monitor trends in the UAE fitness industry through future research activities.</p>

</div>
<div class="row" style="margin-bottom: 30px;">
    <div class="columns large-4 medium-4 small-12">
        <a  target="_blank" href="/download/REPs-UAE-Working-in-Fitness-Survey Report-Final-21-May-2024.pdf">
            <div class="hoverGreen">

                <!-- <img src="{{ file_exists(public_path() . '/images/marketing-thumb.jpg') ? '/img/survey-thumb.jpg' : '/img/sept2016.png' }}"  alt="Pic" style="min-height: 271px;"/> -->
                    <!-- <img src="/img/survey-thumb.jpg"  alt="Pic" style="height: 100px; border: 1px solid #333;"/> -->
                    <h5>Click here to download the 2024 Survey Report.</h5>
              
            </div>
        </a>
    </div>
</div>
{{-- <div class="row hidden">
    <div class="small-12 columns">
        <h2 class="employerSubtitle">
            First Aid + AED
        </h2>
        <p id="employerIntro">
        </p>
    </div>
    <div class="small-12 columns employerItem">
        <div class="employerImageWrapper">
            {{ HTML::image('img/hand-shake.png','Handshake') }}
        </div>
        <div class="employerText">
            <h2 class="employerSubtitle">
                HABC Level 2 International Award in Emergency First Aid & Defibrillation
            </h2>
            <p>
                The HABC Level 2 International Award in Emergency First Aid & Defibrillation is a qualification developed by HABC, the Middle East’s leading supplier of compliance-based qualifications. The qualification has been designed with sector experts specifically for international learners who wish to become emergency first aiders and use a defibrillator and takes into account recognized best-practice principles of emergency first aid and the effective use of a defibrillator. The qualification allows learners to demonstrate how to put a casualty in the recovery position, how to deal with a casualty who is choking and how to use an automated external defibrillator (AED). It also provides an excellent basis for international learners who may wish to undertake further first aid qualifications.
            </p>
        </div>
    </div>
    <div class="small-12 columns employerItem">
        <div class="employerText">
            <h2 class="employerSubtitle">
                COURSE DATE:
            </h2>
            <div class="row">
                <div class="columns large-6 medium-6 small-6">
                    <p>
                        July 28, 2017
                    </p>
                    <p>
                        August 25, 2017
                    </p>
                    <p>
                        September 29, 2017
                    </p>
                </div>
                <div class="columns large-6 medium-6 small-6">
                    <p>
                        October 27, 2017
                    </p>
                    <p>
                        November 24, 2017
                    </p>
                    <p>
                        December 29, 2017
                    </p>
                </div>
            </div>
            <h2 class="employerSubtitle">
                DURATION/TIMES:
            </h2>
            <p>
                The qualification will take 1 day to complete.
            </p>
            <p>
                Course is from 9:00AM – 5:00PM
            </p>
            <h2 class="employerSubtitle">
                How is the qualification assessed?
            </h2>
            <p>
                Learners must be able to carry our practical demonstrations of first aid and use of a defibrillator, as well as answering a number of theoretical questions.
            </p>
            <h2 class="employerSubtitle">
                Validity
            </h2>
            <p>
                3 years from date of completion
            </p>
            <p>
                *350Dhs for REPs Members
            </p>
            <p>
                *400Dhs for Non-REPs Members
            </p>
            <p>
                Includes course materials
            </p>
        </div>
        <div class="employerImageWrapper">
            {{ HTML::image('img/chart_up.png','Handshake') }}
        </div>
    </div>
    <div class="small-12 columns bottom30">
        <div class="employerText">
            <h2 class="employerSubtitle">
                Where can this course be taken?
            </h2>
            <div class="row">
                <div class="columns large-6 medium-6 small-6">
                    <p>
                        REPs Head Office
                    </p>
                    <p>
                        Office 218, Building 7
                    </p>
                    <p>
                        Gold and Diamond Park
                    </p>
                    <p>
                        Al Quoz, Dubai, UAE
                    </p>
                </div>
                <div class="columns large-6 medium-6 small-6">
                    <p>
                        For Registration and Inquiry:
                    </p>
                    <p>
                        Email: membership@repsuae.com
                    </p>
                    <p>
                        Phone Number: +971 4 340 7407
                    </p>
                </div>
            </div>
        </div>
        <div class="employerImageWrapper">
            {{ HTML::image('img/certificate.png','Handshake') }}
        </div>
    </div>
</div> --}}
@include('include.subFooter')
    
@stop

@section('customScripts')
@stop
