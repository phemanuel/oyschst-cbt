<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PastQuestionsExport implements FromQuery, WithHeadings, WithMapping
{
    private $table;
    private $map;
    private $filters;
    private $columns;

    public function __construct(
        string $table,
        array $map,
        array $filters,
        array $columns
    ) {
        if (!in_array($table, ['questions', 'question_singles'], true)) {
            throw new \InvalidArgumentException('Invalid question table.');
        }

        $this->table = $table;
        $this->map = $map;
        $this->filters = $filters;
        $this->columns = $columns;
    }

    public function query()
    {
        $query = DB::table($this->table);

        foreach ($this->map as $filter => $column) {
            $query->where($column, $this->filters[$filter]);
        }

        return $query->orderBy('question_no');
    }

    public function headings(): array
    {
        $headings = [
            ['OYO STATE COLLEGE OF HEALTH SCIENCE AND TECHNOLOGY'],
            ['PAST QUESTIONS'],
            [],
            ['Programme', $this->filters['programme'] ?? ''],
            ['Level', $this->filters['level'] ?? ''],
            ['Exam Type', $this->filters['exam_type'] ?? ''],
            ['Semester', $this->filters['semester'] ?? ''],
            ['Academic Session', $this->filters['session'] ?? ''],
            ['Course', $this->filters['course'] ?? ''],
            [
                'Question Format',
                $this->table === 'questions'
                    ? 'Multi-Page'
                    : 'Single-Page'
            ],
            []
        ];

        if ($this->table === 'questions') {
            $headings[] = [
                'Question',
                'Correct Answer'
            ];
        } else {
            $headings[] = [
                'Question',
                'Option A',
                'Option B',
                'Option C',
                'Option D',
                'Correct Answer'
            ];
        }

        return $headings;
    }

    private function safeValue($value): string
    {
        $value = (string) ($value ?? '');

        // Prevent spreadsheet formula injection.
        if (preg_match('/^[\s\x00-\x1F]*[=+\-@]/u', $value)) {
            return "'" . $value;
        }

        return $value;
    }

    
    private function cleanQuestion($value): string
    {
        if ($value === null) {
            return '';
        }

        $text = (string) $value;

        // Preserve meaningful line breaks.
        $text = preg_replace('/<br\s*\/?>/i', "\n", $text);

        $text = preg_replace(
            '/<\/(p|div|li|tr|h[1-6])\s*>/i',
            "\n",
            $text
        );

        // Remove HTML tags and styling.
        $text = strip_tags($text);

        // Decode entities like &nbsp; and &amp;.
        $text = html_entity_decode(
            $text,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        // Replace non-breaking spaces.
        $text = str_replace("\xC2\xA0", ' ', $text);

        // Remove excessive blank lines.
        $text = preg_replace('/[ \t]+/u', ' ', $text);
        $text = preg_replace('/\n{3,}/', "\n\n", $text);

        return trim($text);
    }


    
    public function map($row): array
    {
        if ($this->table === 'questions') {
            return [
                $this->safeValue(
                    $this->cleanQuestion($row->question ?? '')
                ),
                $this->safeValue(
                    $this->cleanQuestion($row->answer ?? '')
                )
            ];
        }

        return [
            $this->safeValue(
                $this->cleanQuestion($row->question ?? '')
            ),
            $this->safeValue(
                $this->cleanQuestion($row->option_a ?? '')
            ),
            $this->safeValue(
                $this->cleanQuestion($row->option_b ?? '')
            ),
            $this->safeValue(
                $this->cleanQuestion($row->option_c ?? '')
            ),
            $this->safeValue(
                $this->cleanQuestion($row->option_d ?? '')
            ),
            $this->safeValue(
                $this->cleanQuestion($row->answer ?? '')
            )
        ];
    }

}
