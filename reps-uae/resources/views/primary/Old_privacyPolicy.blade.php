@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Data Protection Policy</h1>
                <p>REPs UAE is committed to protecting the privacy of data provided to us by members.</p>
                <p>This policy sets out how personal information will be treated by REPs UAE.  </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <h2 id="termsConditionsSubtitle">(1) Information which is collected</h2>
            <p class="termsConditionsDesc">REPs UAE may collect, store and use the following kinds of personal data:</p>
            <ul class="greenCircleList">
                <li>Name, address and other contact details </li>
                <li>information provided for the purpose of registration (including qualifications, training)</li>
            </ul>
        </div>
    </div>
    
    <div class="row">
        <div class="small-12 columns">
            <h2 id="termsConditionsSubtitle">(2) Using personal data</h2>
            <p class="termsConditionsDesc">Personal data submitted to REPs UAE for the purposes of registration will be used mainly for that purpose.</p>
            <p class="termsConditionsDesc">All credit/debit card details and personally identifiable information will NOT be stored, sold, shared, rented or leased to any third parties. </p>
            <p class="termsConditionsDesc">REPs UAE may also use personal information to:</p>
            <ul class="greenCircleList">
                <li>send general (non-marketing) commercial communications;</li>
                <li>send email notifications</li>
                <li>send to e zines and other marketing communications (relating to our business or the businesses of carefully-selected third parties which we think may be of interest to you by post, by email or similar technology (you can inform us at any time if you no longer require marketing communications to be sent by emailing us)</li>
            </ul>
            <p class="termsConditionsDesc">We will not without express consent provide personal information to any third parties for the purpose of direct marketing.</p>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <h2 id="termsConditionsSubtitle">(3) Security of personal data</h2>
            <p class="termsConditionsDesc">REPs UAE will take reasonable technical and organisational precautions to prevent the loss, misuse or alteration of personal information.  However, data transmission over the internet is inherently insecure, and we cannot guarantee the security of data sent over the internet.</p>
            <p class="termsConditionsDesc">Members are responsible for keeping password and user details confidential.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="small-12 columns">
            <h2 id="termsConditionsSubtitle">(4) Updating information</h2>
            <p class="termsConditionsDesc">The Website policies and Terms and Conditions may be changed or updated occasionally to meet the requirements and standards. Therefore customers are encouraged to frequently visit these sections in order to be updated about the changes on the website. Modifications will be effective on the day they are posted.</p>
            <p class="termsConditionsDesc">Members should let the register know if the personal information which is held needs to be corrected or updated.  </p>
        </div>
    </div>
    
    <div class="row">
        <div class="small-12 columns">
            <h2 id="termsConditionsSubtitle">(5) Contact</h2>
            <p class="termsConditionsDesc">Any questions about this data protection policy or treatment of personal data within REPs can be sent to the register, please email REPs UAE at <a href="mailto:faisal.ayaz@sigmads.com" style="text-decoration:underline;color:#32A543">faisal.ayaz@sigmads.com</a></p>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <h2 id="termsConditionsSubtitle">(6) Third Parties</h2>
            <p class="termsConditionsDesc">‘Australian International Sports Services is not responsible for the privacy policies of websites to which it links. If you provide any information to such third parties different rules regarding the 
collection and use of your personal information may apply. You should contact these entities directly if you have any questions about their use of the information that they collect."</p>
        </div>
    </div>    
    @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
