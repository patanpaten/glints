@if($jobs->count())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Pelamar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>
                    <span class="badge
                        @if($job->status == 'active') bg-success
                        @elseif($job->status == 'inactive') bg-secondary
                        @elseif($job->status == 'review') bg-warning
                        @else bg-dark @endif">
                        {{ ucfirst($job->status) }}
                    </span>
                </td>
                <td>{{ $job->created_at->format('d M Y') }}</td>
                <td>{{ $job->applications_count ?? 0 }}</td>
                <td>
                    <a href="{{ route('company.jobs.show', $job->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('company.applications.index', ['job' => $job->id]) }}" class="btn btn-primary btn-sm">Pelamar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $jobs->links() }}
@else
    <p class="text-muted">Belum ada lowongan untuk status ini.</p>
@endif
