
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.55;
            color: #111;
        }

        h1 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 4px;
        }

        h2 {
            font-size: 13px;
            text-align: center;
            margin-top: 0;
        }

        .meta {
            border-bottom: 1px solid #aaa;
            padding: 10px 0;
            margin-bottom: 16px;
        }

        .question {
            page-break-inside: avoid;
            margin: 0 0 17px;
        }

        .options {
            margin: 6px 0 0 22px;
        }

        .options div {
            margin-bottom: 3px;
        }
    </style>
</head>

<body>

<h1>
    OYO STATE COLLEGE OF HEALTH SCIENCE AND TECHNOLOGY
</h1>

<h2>PAST QUESTIONS</h2>

<div class="meta">
    <strong>Programme:</strong>
    {{ $filters['programme'] }}

    &nbsp;

    <strong>Level:</strong>
    {{ $filters['level'] }}

    <br>

    <strong>Exam Type:</strong>
    {{ $filters['exam_type'] }}

    &nbsp;

    <strong>Semester:</strong>
    {{ $filters['semester'] }}

    <br>

    <strong>Session:</strong>
    {{ $filters['session'] }}

    &nbsp;

    <strong>Course:</strong>
    {{ $filters['course'] }}
</div>


@foreach($questions as $index => $item)

    <div class="question">

        <p>
            <strong>
                {{ $index + 1 }}.
            </strong>

            {!! nl2br(e($item->question ?? '')) !!}
        </p>

        @if($isSinglePage)

            <div class="options">

                @foreach(['a', 'b', 'c', 'd'] as $letter)

                    @php
                        $field = 'option_' . $letter;
                    @endphp

                    @if(isset($item->{$field}) && $item->{$field} !== '')

                        <div>
                            <strong>{{ strtoupper($letter) }}.</strong>
                            {{ $item->{$field} }}
                        </div>

                    @endif

                @endforeach

            </div>

        @endif

        <p>
            <strong>Correct Answer:</strong>
            {{ $item->answer ?? 'Not provided' }}
        </p>

    </div>

@endforeach


            </div>

        @endif

    </div>

@endforeach

</body>
</html>
