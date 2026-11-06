<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class NptelCourseSeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/nptel-import/nptel_courses.csv');

        if (!file_exists($file)) {
            throw new RuntimeException("NPTEL CSV file not found: {$file}");
        }

        $handle = fopen($file, 'r');

        if (!$handle) {
            throw new RuntimeException('Could not open NPTEL CSV file.');
        }

        $headers = fgetcsv($handle, 0, ',', '"', '\\');
        $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);

        $expectedHeaders = [
            'title',
            'department',
            'course_type',
            'phase',
            'developers',
            'course_url',
        ];

        if ($headers !== $expectedHeaders) {
            fclose($handle);
            throw new RuntimeException('CSV headers do not match the expected format.');
        }

        $imported = 0;

        DB::transaction(function () use ($handle, &$imported) {

            while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {

                if (count($row) !== 6) {
                    throw new RuntimeException(
                        'Invalid CSV row: ' . json_encode($row)
                    );
                }

                [
                    $title,
                    $department,
                    $courseType,
                    $phase,
                    $developers,
                    $courseUrl
                ] = array_map('trim', $row);

                if (
                    $title === '' ||
                    !in_array($courseType, ['web', 'video'], true) ||
                    !in_array($phase, ['I', 'II'], true)
                ) {
                    throw new RuntimeException(
                        "Invalid course data: {$title}"
                    );
                }

                $path = parse_url($courseUrl, PHP_URL_PATH);
                $courseId = $path ? basename(rtrim($path, '/')) : '';

                $slugBase = Str::slug(
                    "{$title}-phase-{$phase}-{$courseType}"
                );

                $slug = $courseId
                    ? "{$slugBase}-{$courseId}"
                    : $slugBase;

                DB::table('nptel_courses')->updateOrInsert(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'department' => $department,
                        'course_type' => $courseType,
                        'phase' => $phase,
                        'developers' => $developers,
                        'course_url' => $courseUrl,
                        'status' => 'published',
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );

                $imported++;
            }
        });

        fclose($handle);

        $this->command->info(
            "NPTEL import completed. Processed {$imported} courses."
        );
    }
}
