@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="font-weight-bold">Stations</h4>
        <a href="{{ route('stations.create') }}" class="btn btn-success">
            + Create Station
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Practical Question</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stations as $station)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $station->title }}</td>
                            <td>{{ Str::limit($station->practical_question, 50) }}</td>
                            <td>{{ $station->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No stations created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
