@extends('layouts.app1')

@section('content')
<div class="container">

    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $station->title }}</h4>
            <p><strong>Title:</strong> {{ $station->practical_question }}</p>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Student:</strong> 
                        {{ $student->first_name }} 
                        {{ $student->surname }}
                    </p>
                    <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Department:</strong> {{ $student->department }}</p>
                    <p><strong>Examiner:</strong> {{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" 
    action="{{ route('examiner.store.procedure', [$station->id, $student->id]) }}">
@csrf

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Procedure</th>
                    <th>Max Mark</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($procedures as $index => $procedure)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $procedure->name }}</td>
                    <td>{{ $procedure->marks }}</td>
                    <td>
                        @php
                            // Define the scoring sequence
                            $sequence = [0, 0.25, 0.5, 1.0, 1.5, 2.0, 2.5, 3.0];

                            // Fetch existing score if available
                            $existingScore = $examinerScores[$procedure->id] ?? null;
                        @endphp

                        <select name="procedures[{{ $procedure->id }}]" class="form-control">
                            @foreach($sequence as $score)
                                @if($score <= $procedure->marks)
                                    <option value="{{ $score }}" {{ $existingScore !== null && $existingScore == $score ? 'selected' : '' }}>
                                        {{ $score }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <button type="submit" class="btn btn-primary">
            Submit Scores
        </button>
    </div>
</div>

</form>
</div>
@endsection

