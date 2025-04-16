@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Frequently  Asked Questions</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="faqsImage" class="small-12 columns">
            <div id="faqsImageWrapper">
                {{ HTML::image('img/question.png','Frequently Asked Questions',array('id' => '')) }}
            </div>
            <div id="faqsImageText">
                <p id="faqsSubtitle">
                    Here you can find answers to some frequently asked questions about
                    various aspects of REPs UAE, we’ll be adding to the list as we go along.  
                </p>
            </div>
        </div>
        <div class="small-12 columns">
            <div class="questionItem">
                <p class="question">
                    What is REPs?
                </p>
                <p class="answer">
                    REPs is a public register which recognises the qualifications 
                    and expertise of exercise instructors in the UAE.
                </p>
            </div>
            <div class="questionItem">
                <p class="question">
                    Who set up REPs?
                </p>
                <p class="answer">
                    REPs UAE was instigated by the Dubai Sports Council and set up as an 
                    independent entity by the CEO Naser Al Tamimi to support and help 
                    to professionalise the local fitness industry. 
                </p>
            </div>
            <div class="questionItem">
                <p class="question">
                    Is it law that a fitness professional has to be a member of REPs?
                </p>
                <div class="answer">
                    <p>
                    Dubai Sports Council have issued circulars in Dubai to all health 
                    clubs that registration with REPs for all instructors is mandatory.  
                    The Sports Councils in other Emirates are considering the same approach.   
                    Checks may be carried out on Clubs through the Sports Council.   
                    </p>
                    <p>
                    Regardless of the legal situation REPS UAE encourages all instructors to 
                    register and calls on all employers to back REPs increase professionalism in the industry.
                    </p>
                    <p>
                    Membership signifies that an exercise professional;
                    </p>
                    <ul style="font-size: 14px;">
                        <li>has met nationally agreed occupational standards</li>
                        <li>holds recognised and approved qualifications</li>
                        <li>is independently verified as being competent in the work place</li>
                        <li>is committed to ongoing professional development</li>
                    </ul>
                    <p>
                        We strongly recommend that members of the public looking to employ the services
                        of an exercise professional should check to see if they are registered 
                        by searching our member database.
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                    What are levels of registration?
                </p>
                <div class="answer">
                    <p>
                    Level 1 – Assistant Instructor 
                    </p>
                    <p>
                    Level 2 – Gym Instructor, Group Fitness Instructor, Group Fitness Instructor (Freestyle), Aqua Fitness Instructor
                    </p>
                    <p>
                    Level 3 – Personal Trainer, Pilates Teacher, Yoga Teacher
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                    Is there a Level 4 on REPs? 
                </p>
                <div class="answer">
                    <p>
                    No, not at the moment, we are concentrating on getting trainers qualified 
                    and registered at levels 2 and 3 first.  Also there is not an agreed advanced 
                    (Level 4) criteria around the world so it makes it hard to develop a Level 4 
                    for UAE when different training companies and instructors use different 
                    advanced courses from around the world.  For Level 2 and 3 there is more or 
                    less a global consensus on the skills needed at those levels.  
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                    Who sets the standards?
                </p>
                <div class="answer">
                    <p>
                    The Standards were developed by REPs and checked with training providers and employers, 
                    the standards are based on the Global Standards for fitness produced by the International 
                    Confederation of Registers for Exercise Professionals (ICREPs) – so we can demonstrate 
                    the UAE meets best global practice. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                    Who approves the qualifications? 
                </p>
                <div class="answer">
                    <p>
                   Courses to give entry to REPs are approved through internationally accepted accreditation systems,
                   at present these include accreditation routes through the UK, Australia, South Africa and ICREPs.
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   How do I become a qualified fitness professional?
                </p>
                <div class="answer">
                    <p>
                        In order to become a fitness professional and register with REPs you must hold a recognised 
                        qualification from an approved training provider. To search for approved training 
                        providers go to the Approved Training part of the website. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   What if I did my qualifications outside the UAE?
                </p>
                <div class="answer">
                    <p>
                        REPs will accept qualifications gained in another ICREPs country with a fitness 
                        register (REPs certificate or letter of portability required), we can only accept 
                        qualifications from other countries for full entry where we are sure that the 
                        qualification meets all the UAE Fitness Standards.  If we are not sure we may 
                        give “provisional status”. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   What status do you award to trainers with a US certification? 
                </p>
                <div class="answer">
                    <p>
                        REPs UAE requires a competency based assessment to have been part of a 
                        members qualification, as this is not always the case with US certifications 
                        then normally provisional status will be given and the member will be asked 
                        to top up to another certification by completing a practical.  If a 
                        US certification has a practical included and is accredited globally 
                        by ICREPS then it gives full entry to REPs. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   What is provisional status? 
                </p>
                <div class="answer">
                    <p>
                        Provisional status is given to members of REPs UAE who are currently employed 
                        in the fitness industry and hold a fitness qualification but we are not sure 
                        that the qualification meets the REPs UAE Fitness Occupational Standards.  Further 
                        evidence is needed to prove competence against the standards and convert to full status.  
                        Provisional status is given for one year and in that time the trainer must “top up” 
                        to a locally accredited certification.  
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   What if my qualifications are very old?
                </p>
                <div class="answer">
                    <p>
                        REPs look at each application on an individual basis. We would look at the certificates, 
                        and also the CV and continuing education taken and decide whether to give full or provisional status. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   Can I get on REPs with a degree in sports? 
                </p>
                <div class="answer">
                    <p>
                        Degrees in sport (sports science, sports management, sports coaching etc) are recognised 
                        as delivering a high level of theoretical learning linked to the sport and fitness industry, 
                        however there is normally not much evidence that all of the practical fitness skills which are 
                        in the UAE standards have been taught and assessed adequately.  Therefore although university
                        graduates are well qualified and have a high level certification for 3/4/5 years of study, 
                        often they can only be given provisional status on REPs and must provide further evidence 
                        of their practical fitness instruction skills.  
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   How do you assess yoga applications? 
                </p>
                <div class="answer">
                    <p>
                        We link to globally recognised yoga accreditation systems, in particular we 
                        look for Registered Yoga School (RYS) 200 or above from Yoga Alliance.  
                        Yoga degrees and masters degrees are also accepted. To help us look at yoga 
                        certificates and decide if the teacher can join REPs we have a “yoga advisor” 
                        who has good knowledge of yoga certifications and can advise us if a certification 
                        is RYS 200 standard or equivalent.  

                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   What is ICREPs?
                </p>
                <div class="answer">
                    <p>
                        ICREPs is the International Confederation for Registers of Exercise Professionals,
                        it is the global body for REPs registers around the world.  There is now a REPS 
                        register and member of ICREPs in UK, Australia, New Zealand, South Africa, UAE, Ireland, 
                        Canada and United States.  ICREPs applied a strict criteria to REPs UAE to be able to 
                        join and provides both a forum to share good practice in registration and allow international
                        portability between registers.  REPs UAE is a full member of ICREPs and attends their Board meetings. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   What is CPD?
                </p>
                <div class="answer">
                    <p>
                        It is important for exercise professionals to keep their skills and knowledge up to date.
                        Continuing Professional Development – CPD – is about exercise professionals doing 
                        extra courses, attending workshops or conferences or taking part in
                        other activities which increase their skills base.  REPs members are expected to do 10 hours 
                        of CPD activities per year and to log their CPD “points” where one point is equal to 
                        one hour of learning.
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                   Can I get a course approved for CPD points?
                </p>
                <div class="answer">
                    <p>
                       Yes we have a process for that to evaluate courses and give CPD points, contact the office for details
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                  How much does it cost?
                </p>
                <div class="answer">
                    <p>
                       It costs Dhs420 (VAT incl.) per year to be a member of REPs 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                  Can my employer pay for my registration?
                </p>
                <div class="answer">
                    <p>
                       Yes. Employers can submit applications for registration on behalf of their employees. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                  How long will it take to process my application?
                </p>
                <div class="answer">
                    <p>
                       We say it will take 1 to 4 weeks  days for qualifications from our list of published
                       qualifications. Applications sent with ‘other’ or ‘non listed qualifications’ 
                       will take longer. These can take up to 3 months depending on the evidence provided 
                       and if the application needs to be assessed by an independent panel.
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                 Do I need first aid or CPR training to join REPs? 
                </p>
                <div class="answer">
                    <p>
                       At the moment no, although it is advisable to have up-to-date CPR training. 
                       REPs is speaking to the industry about this and may bring in a requirement 
                       for first aid and/or CPR from next year. 
                    </p>
                </div>
            </div>
            <div class="questionItem">
                <p class="question">
                 How are my registration fees spent and is REPs UAE “for profit”
                </p>
                <div class="answer">
                    <p>
                      REPs UAE operates as a not-for-profit organisation.  Being not-for-profit is a requirement of 
                      ICREPs membership and to ensure this principle is upheld the Chair of ICREPs sits 
                      on the REPs UAE Board and scrutinises the accounts once a year.  REPs does not receive
                      a grant from the Government so all income is derived from member registrations.  
                      The office rent and equipment, four members of staff, external consultant, website, 
                      magazine, ID cards etc all have to be paid for from registration income.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
