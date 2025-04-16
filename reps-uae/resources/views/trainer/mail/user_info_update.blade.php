<h1>Hi admin,</h1>
 
<p>Trainer <strong>{{ $name }} ({{ $reps_id }})</strong> has updated is account</p>

@if (!empty($namechanged))
    <p>Name changed from {{ $name }} to {{ $namechanged }}</p>
@endif

@if (!empty($emailchanged))
    <p>Email changed from {{ $email }} to {{ $emailchanged }}</p>
@endif

@if (!empty($jobtitlechanged))
    <p>Job title changed from {{ $jobtitle }} to {{ $jobtitlechanged }}</p>
@endif

@if (!empty($workplacechanged))
    <p>
        Workplace changed from <br />
        {{ implode(", ", $workplace) }} <br />
        to <br />
        {{ implode(", ", $workplacechanged) }}
    </p>
@endif