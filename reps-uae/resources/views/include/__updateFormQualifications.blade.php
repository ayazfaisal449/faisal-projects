<h1>Edit Trainer</h1>

<div class="component" style="padding:0px 12px 12px;">      
    <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
    <div class="clearfix"></div>
    <div class="tab_panel">
        <span class="tab_label"><a href="{{ Request::root()."/admin/users/update/".$data->id }}">Personal Details</a></span>
        <span class="tab_label"><a href="{{ URL::action('UsersController@userFormWorkExperience', $data->id) }}">Work Experience</a></span>
        <span class="tab_label tab_active">Qualifications</span>
        <span class="tab_label"><a href="{{ URL::action('UsersController@userFormComments', $data['id']) }}">Comments</a></span>
    </div>
    <div class="clearfix"></div>
    <div class="the_form_content">
        <div class="row">
            <div class="large-12">
                {{Form::token();}}
                {{Form::hidden('form','Work Experience')}}
                <div class="sub-tab_panel">
                    <span class="tab_label tab_active">View Uploaded Qualifications</span>
                    <span class="tab_label"><a href="{{ URL::action('UsersController@userFormNewQualifications', $data->id) }}">Add New Qualifications</a></span>
                </div>
                
                @if (Session::has('message'))
                    <div class="subnotify">
                        {{ Session::get('message') }}
                    </div>
                @endif
                
                @if (count($renewals) > 0)
                    <h3 style="margin:32px 12px 6px 16px;border-bottom:0px;">Registration/Renewal History</h3>
                    @foreach ($renewals as $itm) 
<?php
$continue = false;
if ((!empty($itm['details']->certificates))) {
    foreach ($itm['details']->certificates as $certificate) {

        $directory = 'trainer/' . $itm['trainer']['user_id'] . '/renewals/';
        $main_dir = array_diff(scandir($directory), array('..', '.'));

        $di = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
        $it = new RecursiveIteratorIterator($di);

        $cert2 = "#";

        foreach($it as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) != "") {
                if (pathinfo($file,  PATHINFO_BASENAME) == $itm['payment_id'] . '-' . $certificate) {

                    $cert2 = "/" . $file;
                    $location = $cert2;
                }
            }
        }
        if ($cert2 == '#') {
           $continue = true;
        }
    }
}
if ($continue) {
    continue;
}
?>
                        <div class="itm-qualification">
                            <div class="row">
                                <div class="medium-6 columns det-qualification">
                                    <div class="info">
                                        Order No<br />
                                        <span>#<a href="https://www.2checkout.com/va/sales/detail?sale_id={{ $itm['details']->order_number }}" target="_blank">{{ $itm['details']->order_number }}</a></span>
                                    </div>
                                    <div class="info">
                                        Paid On<br />
                                        <span>{{ $itm['payment_date'] }}</span>
                                    </div>
                                </div>
                                <div class="medium-6 columns renewalDetails">
                                    Certificates:
                                    @if (!empty($itm['details']->certificates))
                                        @foreach ($itm['details']->certificates as $certificate)
                                            <?php $location = Request::root() . '/trainer/' . $itm['trainer']['user_id'] . '/renewals/' . $itm['payment_id'] . '-' . $certificate; ?>

<?php
// there's no actual data for locating files for specific purpose.

$directory = 'trainer/' . $itm['trainer']['user_id'] . '/renewals/';
$main_dir = array_diff(scandir($directory), array('..', '.'));

$di = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
$it = new RecursiveIteratorIterator($di);

$cert2 = "#";

foreach($it as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) != "") {
        if (pathinfo($file,  PATHINFO_BASENAME) == $itm['payment_id'] . '-' . $certificate) {

            $cert2 = "/" . $file;
            $location = $cert2;
        }
    }
}
if ($cert2 == '#') {
   echo "(no certificates)";
   continue;
}
?>

                                            <a target="_blank" style="padding-right:12px;text-decoration:underline;display:block;" href="{{ $location }}" alt="{{$certificate}}" title="{{$certificate}}">
                                                {{ $itm['payment_id'] . '-' . $certificate }}
                                            </a>
                                        @endforeach
                                    @else
                                        None
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                @if (count($qualifications) > 0)
                <h3 style="margin:62px 12px 0px 16px;border-bottom:0px;">Uploaded Certificates</h3>
                @foreach ($qualifications as $itm)

<?php
$docs = json_decode($itm->certificate);
$continue = false;
foreach($docs as $doc) {
    // there's no actual data for locating files for specific purpose.

    $directory = "trainer/{$data->id}";
    $main_dir = array_diff(scandir($directory), array('..', '.'));

    $di = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
    $it = new RecursiveIteratorIterator($di);

    $cert = "#";

    foreach($it as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) != "") {
            if (pathinfo($file,  PATHINFO_BASENAME) == $doc && 
                date("Y-m-d", filemtime($file)) == date('Y-m-d', strtotime($itm->updated_at))) {

                $cert = "/" . $file;
            }
        }
    }
    if ($cert == '#') {
       $continue = true;

    }
}

if ($continue) {
    continue;
}


?>
                    <div class="itm-qualification">
                        <div class="medium-12" style="margin-top:8px;margin-bottom:30px;">
                            <a class="float-right" href="{{ URL::action('UsersController@deleteTrainerQualifications', $itm->id) }}" style="margin-right:12px;"><img src="/img/delete-cert.jpg" /></a>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="row">
                            <div class="medium-6 columns det-qualification">
                                <div class="info">
                                    Name of Course(s) / Qualification<br />
                                    <span>{{ empty($itm->course_name) ? "NA" : $itm->course_name }}</span>
                                </div>
                                <div class="info">
                                    Date Completed (month and year)<br />
                                    <span>{{ empty($itm->date_completed) || $itm->date_completed == "0000-00-00" ? "NA" : $itm->date_completed }}</span>
                                </div>
                                <div class="info">
                                    Course Provider / Name of Institution<br />
                                    <span>{{ empty($itm->course_provider) ? "NA" : $itm->course_provider }}</span>
                                </div>
                            </div>
                            <div class="medium-6 columns det-certs">

                                <?php $docs = json_decode($itm->certificate); ?>
                                @foreach ($docs as $doc)
                                    <?php $ext = pathinfo($doc, PATHINFO_EXTENSION); ?>
<?php
// there's no actual data for locating files for specific purpose.

$directory = "trainer/{$data->id}";
$main_dir = array_diff(scandir($directory), array('..', '.'));

$di = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
$it = new RecursiveIteratorIterator($di);

$cert = "#";

foreach($it as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) != "") {
        if (pathinfo($file,  PATHINFO_BASENAME) == $doc && 
            date("Y-m-d", filemtime($file)) == date('Y-m-d', strtotime($itm->updated_at))) {

            $cert = "/" . $file;
        }
    }
}
if ($cert == '#') {
   continue;

}
?>
                                    <!--<a class="filecont" href="/trainer/{{$data->id}}/certificate/{{ $doc }}" target="_blank">-->
                                    <a class="filecont" href="{{ $cert }}" target="_blank">
                                        @if ($ext == 'doc' || $ext == 'docx')
                                            <img width="90" src="{{ Request::root() }}/img/docicon_doc.png" alt="" />
                                        @elseif ($ext == 'pdf')
                                            <img width="90" src="{{ Request::root() }}/img/docicon_pdf.png" alt="" />
                                        @else
                                            <img width="90" src="{{ Request::root() }}/img/docicon_img.png" alt="" />
                                        @endif
                                        <p style="font-size:11px;">{{ $doc }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <hr>
            </div>
        </div>
    </div>
</div>