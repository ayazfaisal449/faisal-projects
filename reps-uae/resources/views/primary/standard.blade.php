@extends('layouts.primary')

@section('content')
<!-- <style>
        .ethicsParagraphBlack{
            height: auto !important;
        }
    </style> -->
@include('include.subNav')
<div class="border-bottom">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="color-green">Standards</h1>
            <p>The REPs UAE Occupational Standards for the health and fitness industry</p>
        </div>
    </div>
</div>

<div class="background-grey">
    <div class="row">
        <div class="large-12 columns">
            <p>
                REPs UAE is based on the fitness industry standards which have been developed
                for each area of exercise and fitness instruction which is covered by the register.
            </p>
            <p>
                Occupational Standards describe the skills, knowledge and competence needed to
                work as an instructor in the fitness industry. REPs UAE is a guarantee that
                instructors are competent and qualified against these standards. Instructors
                on REPs UAE have demonstrated that they can work to these standards, normally
                by gaining an approved qualification which teaches and assesses everything in these
                standards. The standards are based on the "ICREPs Global Standards" developed
                by the International Confederation for Registers of Exercise Professionals,
                the global organisation for fitness registers that REPs UAE is a member of.
            </p>
            <p>
                The standards can be used by education providers to develop courses, employers
                to organise staff structures, or instructors themselves to map their
                skills and competences and plan their career.
            </p>
            <p>
                The following is a list of the UAE Fitness Standards:
            </p>

            <!-- <div class="ethicsHeaderGreen"> Assistant instructor Standards (Level 1)    </div> -->
            <div class="ethicsHeaderBlack">
                CORE STANDARDS
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        A1. Promote health and safety as an exercise professional
                    </p>
                    <p class="ethicsParagraphBlack">
                        A2. Apply principles of fitness, anatomy and physiology in fitness instruction
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        A3. Recognise and apply exercise considerations for specific populations
                    </p>
                    <p class="ethicsParagraphBlack">
                        A4. Deliver a positive customer experience to clients
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        A5. Support client motivation and adherence
                    </p>
                    <p class="ethicsParagraphBlack">
                        A6. Develop professional practice and personal career in the health and fitness industry
                    </p>
                </div>
            </div>

            <div class="ethicsHeaderBlack">
                Gym Instructor Standards
            </div>
            <div class="row">
                <div class="large-4 columns end">
                    <p class="ethicsParagraphGreen">
                        B1. Provide healthy eating and lifestyle information to clients
                    </p>
                </div>
                <div class="large-4 columns end">
                    <p class="ethicsParagraphGreen">
                        B2. Conduct gym inductions, health screening and fitness assessments
                    </p>
                    <!-- <p class="ethicsParagraphGreen">
                            B2. Provide assistance to fitness clients in the gym
                        </p> -->
                </div>
                <div class="large-4 columns end">
                    <p class="ethicsParagraphGreen">
                        B3. Plan and instruct exercise in the gym
                    </p>
                </div>
            </div>

            <div class="ethicsHeaderBlack">
                GROUP FITNESS INSTRUCTOR STANDARDS
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        C1. Conduct health screening
                    </p>

                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        C2. Deliver Pre-choreographed group exercise to music
                    </p>

                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        C3. Plan and instruct group exercise
                    </p>

                </div>
            </div>

            <div class="row">
            <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        C4. Plan and instruct water-based fitness
                    </p>

                </div>
            </div>

            <div class="ethicsHeaderOrange">
                PERSONAL TRAINER STANDARDS
            </div>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphOrange">
                        D1. Conduct client consultations and fitness assessments
                    </p>
                    <p class="ethicsParagraphOrange">
                        D2. Apply the principles of exercise science to programme design
                    </p>
                    <p class="ethicsParagraphOrange">
                        D3. Apply the principles of nutrition and weight management within an exercise programme
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphOrange">
                        D4. Design personal training programmes
                    </p>
                    <p class="ethicsParagraphOrange">
                        D5. Plan and deliver personal training sessions
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphOrange">
                        D6. Support long-term behaviour change by monitoring client exercise adherence and applying
                        motivational techniques
                    </p>
                    <p class="ethicsParagraphOrange">
                        D7. Manage, review, adapt and evaluate personal training programmes
                    </p>
                </div>
            </div>

            <div class="ethicsHeaderRed">
                Pilates Standard
            </div>

            <div class="row">
                <div class="large-4 columns end">
                    <p class="ethicsParagraphRed">
                      Available on Request
                    </p>
                </div>
            </div>

            <p>
                Here you can download the standards.
            </p>

            <div class="download clearfix">
                <div class="margin-bottom-10 large-6 columns">
                    <a href="{{Request::root()}}/download/REPs-UAE-Occupational-Standards-2022.pdf" alt="Download Occupational Standards REPs UAE">
                        <img src="{{Request::root()}}/img/download.png" alt="Download Occupational Standards REPs UAE" />
                        <span>Download</span>
                    </a>
                    <span>(REPs UAE - Occupational Standards )</span>
                </div>
                <!-- <div class="margin-bottom-10 large-6 columns">
                        <a href="{{Request::root()}}/download/REPs-UAE-Personal-Trainer-Standards-2014.pdf" alt="Download Personal Trainer Standards REPs UAE">
                            <img src ="{{Request::root()}}/img/download.png" alt="Download Personal Trainer Standards REPs UAE" />
                            <span>Download</span>
                        </a>
                        <span>(REPs UAE - Personal Trainer Standards)</span>
                    </div>
                    <div class="margin-bottom-10 large-6 columns end">
                         <a href="{{Request::root()}}/download/REPs-UAE-Gym-Instructor-Standards-2014.pdf" alt="Download Gym Instructor REPs UAE">
                            <img src ="{{Request::root()}}/img/download.png" alt="Download Gym Instructor REPs UAE" />
                            <span>Download</span>
                        </a>
                        <span>(REPs UAE - Gym Instructor Standards)</span>
                    </div> -->

            </div>

        </div>
    </div>
</div>



@include('include.subFooter')

@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
$(document).ready(function() {



});
@stop