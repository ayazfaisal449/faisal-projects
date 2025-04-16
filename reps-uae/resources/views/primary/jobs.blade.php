@extends('layouts.primary')
@section('content')
@include('include.subNav')
<style>
section.reps-job {
    padding-top: 100px;
    padding-bottom: 100px;
}

.reps-job-listing-img img {
    width: 100%;
}

.reps-job-container {
    max-width: 90%;
    margin: 0 auto;
}

.reps-jobs-listing .reps-jobs {
    display: flex;
    align-items: flex-start;
    border-bottom: 1px solid #eee;
}

.reps-job-listing-img {
    max-width: 20%;
    flex: 0 0 20%;
}

.reps-job-listing-img img {
    object-fit: contain;
}

.reps-jobs-listing-content {
    max-width: 80%;
    flex: 0 0 80%;
}

p.job-desc {
    margin-bottom: 0px;
}

p.-contact-details a {
    color: #fff;
}

section.reps-job-sec {
    background: #000;
}

.reps-jobs-listing-content p {
    color: #fff;
}

.reps-job-wrapper h2 {
    font-size: 45px;
    color: #47aa49;
}

.reps-job-wrapper p {
    font-size: 30px;
    color: #fff;
}

section.reps-job-sec {
    padding-top: 100px;
    padding-bottom: 100px;
}



.reps-jobs-listing nav {
    border-bottom: 0;
}

.reps-jobs-listing .reps-jobs:nth-last-child(2) {
    border-bottom: 0;
}


.reps-jobs-listing ul.pagination {
    display: flex;
    justify-content: center;
}

ul.pagination li {
    border: 1px solid #ffffff;
}

ul.pagination li,
ul.pagination li a {
    background: #aaaaaa00;
    color: #fff;
    font-size: 16px;
    width: 35px;
    height: 35px;
    line-height: 2;
    padding: 0;
    text-align: center;
}

ul.pagination li.active {
    background: #fff;
    color: #000;
    font-weight: 800;
}

ul.pagination li:hover a {
    background: #fff0;
    padding: 0;
    color: #000;
    border-radius: 0;
    font-weight: 800;
}

ul.pagination li:hover {
    background: #fff;
}

ul.pagination li.disabled {
    color: #ffffff9e;
    border: 1px solid #ffffff9e;
}


@media(max-width:480px){
.reps-job-listing-img img {
    height: 100%;
}
.reps-jobs-listing .reps-jobs {
    padding-top: 30px;
    padding-bottom: 30px;
}
.reps-job-listing-img img {
    margin-bottom: 40px;
}
}


    /* .banner-img {
        width: 100%;
        overflow: hidden;
    }

    .banner-img img {
        width: 100%; 
        height: auto; 
    } */

    /* .banner-text {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white !important;
        padding: 10px;
        font-size: 24px;
    } */

</style>
     <!-- Banner with text -->
     <div class="banner-img">
            <img src="/awards/images/jobs-without-text-banner.jpeg" alt="Fitness Professionals">
            <h1 class="banner-text">FITNESS INDUSTRY JOBS</h1>
        </div>
<section class="reps-job-sec">
    <div class="reps-job-container">
   
        <div class="reps-job-row row">
            <div class="reps-job-wrapper">
                <h2>Job listings</h2>
                <p>Find available jobs and seekers in the UAE</p>
            </div>
            <div class="reps-jobs-listing">
                @if ($jobs->count() > 0)
                @foreach($jobs as $job)
                <div class="reps-jobs">
                    <div class="reps-job-listing-img">
                        <img src="/{{ $job->location }}">
                    </div>
                    <div class="reps-jobs-listing-content">
                        @if (!empty($job->job_role))
                        <p class="job-role"><b>Job Role:</b> {{ $job->job_role }}</p>
                        @endif
                        @if (!empty($job->branch))
                        <p class="job-branch"><b>Branch:</b> {{ $job->branch }}</p>
                        @endif
                        @if (!empty($job->description))
                        <p class="job-desc"><b>Description:</b></p>
                        <p class="job-desc-inner">{!! $job->description !!}</p>
                        @endif
                        @if (!empty($job->email))
                        <p class="-contact-details"><b>Contact Details:</b> <a
                                href="mailto:{{ $job->email }}">{{ $job->email }}</a></p>
                        @endif
                    </div>
                </div>
                @endforeach
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $jobs->render() }}
                    </ul>
                </nav>
                @else
                <div class="alert alert-warning" role="alert"
                    style="color:#fff; background-color: #ac99e0; border-color: #eea236; text-align: center;">No record
                    found.</div>
                @endif
            </div>
        </div>
    </div>
</section>

<!--    ma ny abe-->
@include('include.subFooter')
@stop