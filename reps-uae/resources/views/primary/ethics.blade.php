@extends('layouts.primary')

@section('content')

@include('include.subNav')
<style>
span.bg-cont {
    width: 100%;
    background-position: center;
    height: 400px;
    z-index: 1;
    background-size: cover;
    opacity: .1;
    position: absolute;
    top: 50px;
}
.ethicsParagraphOrange {
    height: 150px;
}
</style>
<div class="border-bottom">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="color-green">Code of Ethics</h1>
        </div>
    </div>
</div>

<div class="background-grey">
    <div class="row">
        <div class="large-12 columns">
            <p>
                REPs UAE is dedicated to the ethical advancement of the sports and fitness industry. Aligned with our
                mission, we strive to guarantee that
                registered exercise professionals uphold ethical standards in their practice. The REPs
                UAE Code of Ethics serves as a crucial framework, providing additional protection to individuals pursuing a healthy and balanced lifestyle. We anticipate
                that all exercise professionals
                maintain a pinnacle of professionalism and ethical conduct. Every REPs UAE registered exercise professional commit
                to adhering to this
                Code of Ethics.
            </p>

            <div class="download">
                <a href="{{Request::root()}}/download/REPs-UAE-Code-of-Ethics-2014.pdf">
                    <img src="{{Request::root()}}/img/download.png" alt="Download Code of Ethics" />
                    <span>Download</span>
                </a>
                <span>(REPs UAE - Code of Ethics)</span>
            </div>

            <div class="ethicsHeaderGreen">
            Professional Standards
            </div>

            <p class="special">
            The exercise professional will:  
            </p>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphGreen">
                       Maintain their level of qualification and undergo continuing professional development.
                    </p>
                    <p class="ethicsParagraphGreen">
                        Promote and maintain practice based on current knowledge and research.
                    </p>
                    <p class="ethicsParagraphGreen">
                        Act within the boundaries of their qualification and registration level.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphGreen">
                    On request, detail their qualifications, experience, and registration details to participants.
                    </p>
                    <p class="ethicsParagraphGreen">
                        Recognize when it is important to refer a participant to another professional.
                    </p>
                    <p class="ethicsParagraphGreen">
                       Project an image of professionalism and good health.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphGreen">
                       Understand legal responsibilities and accountability as an exercise professional.
                    </p>
                    <p class="ethicsParagraphGreen">
                      Accept responsibility for professional decisions.
                    </p>
                </div>
            </div>

            <div class="ethicsHeaderOrange">
                Respect and Transparency
            </div>

            <p class="special">
            The exercise professional will:  
            </p>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphOrange">
                      Respect individual difference and diversity.
                    </p>
                    <p class="ethicsParagraphOrange">
                        Treat everyone equitably and sensitively within the context of their activity and ability – regardless of age, disability, gender, and ethnic background.
                    </p>
                    <p class="ethicsParagraphOrange">
                      Challenge any form of discrimination against a participant.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphOrange">
                      Keep clear records of dealings with participants/clients.
                    </p>
                    <p class="ethicsParagraphOrange">
                      Respect and preserve confidential information relating to participants in terms of personal, social, health, and fitness information.
                    </p>
                    <p class="ethicsParagraphOrange">
                     Only disclose information to other professionals that is necessary and with permission of the participant.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphOrange">
                      Inform participants transparently of any financial costs related to activity.
                    </p>
                    <p class="ethicsParagraphOrange">
                     Ensure relationships between registered professionals and their clients should be based on documented, contractual arrangements, which are clear,
                     transparent, and unambiguous. These contracts serve as protection to clients and REPs UAE professionals in case of dispute.
                    </p>
                </div>
            </div>

            
            <div class="ethicsHeaderBlack">
                Relationships
            </div>
            
            <p class="special">
            The exercise professional will:  
            </p>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        Act with integrity as an exercise professional.
                    </p>
                    <p class="ethicsParagraphBlack">
                        Avoid inappropriate behaviour in relations with
                        participants while working as an exercise professional.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        Promote the welfare and best interests of participants.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphBlack">
                        Ensure clarity, honesty and accuracy in all
                        communications with participants and others.
                    </p>
                </div>
            </div>

            <div class="ethicsHeaderRed">
                Safety
            </div>

            <p class="special">
                The exercise professional will:
            </p>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphRed">
                        Maintain the safety of participants.
                    </p>
                    <p class="ethicsParagraphRed">
                        Show a duty of care and deal with accidents and
                        emergencies appropriately.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphRed">
                        Not advocate or condone the use performance
                        enhancing substances.
                    </p>
                    <p class="ethicsParagraphRed">
                        Ensure participants have prepared adequately for
                        activity.
                    </p>
                </div>
                <div class="large-4 columns">
                    <p class="ethicsParagraphRed">
                        Identify and respect the physical limits of ability of
                        participant.
                    </p>
                </div>
            </div>

            <div class="ethicsHeaderGrey">
                General
            </div>

            <p class="special">
                The exercise professional will:
            </p>

            <div class="row">
                <div class="large-4 columns">
                    <p class="ethicsParagraphGrey">
                    Not do anything that brings themselves, other fitness professionals, any fitness centers, REPs UAE, or the fitness industry into disrepute.
                    </p>
                </div>
                <div class="large-4 columns end">
                    <p class="ethicsParagraphGrey">
                        Ensure advertising of services is truthful, inoffensive
                        and does not make claims that can not be supported.
                    </p>
                </div>
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