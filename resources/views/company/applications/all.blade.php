<!DOCTYPE html>
<html>
<head>
    <title>All Applications</title>
</head>
<body>
    <h1>All Applications</h1>

    <form method="GET" action="{{ route('company.applications.all') }}">
        <label>Status:</label>
        <select name="status">
            <option value="">--All--</option>
            <option value="pending" {{ $status=='pending'?'selected':'' }}>Pending</option>
            <option value="reviewed" {{ $status=='reviewed'?'selected':'' }}>Reviewed</option>
            <option value="shortlisted" {{ $status=='shortlisted'?'selected':'' }}>Shortlisted</option>
            <option value="rejected" {{ $status=='rejected'?'selected':'' }}>Rejected</option>
            <option value="hired" {{ $status=='hired'?'selected':'' }}>Hired</option>
        </select>

        <label>Job:</label>
        <select name="job_id">
            <option value="">--All--</option>
            @foreach($jobs as $job)
                <option value="{{ $job->id }}" {{ $jobId==$job->id?'selected':'' }}>{{ $job->title }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    <table border="1" cellpadding="6" style="margin-top:10px;">
        <tr>
            <th>Applicant</th>
            <th>Job</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($applications as $app)
        <tr>
            <td>{{ $app->jobSeeker->name }}</td>
            <td>{{ $app->job->title }}</td>
            <td>{{ ucfirst($app->status) }}</td>
            <td><a href="{{ route('company.applications.show', $app->id) }}">View</a></td>
        </tr>
        @endforeach
    </table>

    {{ $applications->links() }}
</body>
</html>
