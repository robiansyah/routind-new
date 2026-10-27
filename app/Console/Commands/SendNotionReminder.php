<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendNotionReminder extends Command
{
    protected $signature = 'reminder:notion-tasks';
    protected $description = 'Cek tugas Notion yang belum selesai dan kirim notifikasi ke Grup WA via Fonnte';

    public function handle()
    {
        $notionToken = env('NOTION_TOKEN');
        $databaseId = env('NOTION_DATABASE_ID');

        // Menentukan Rentang Tanggal (Mulai dari hari ini sampai 3 hari ke depan)
        $startDate = \Carbon\Carbon::now()->subDays(3)->format('Y-m-d');
        $endDate = \Carbon\Carbon::now()->addDays(3)->format('Y-m-d');

        // 1. Ambil Data dari Notion (Filter Rentang Tanggal & Status)
        $notionResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $notionToken,
            'Notion-Version' => '2022-06-28',
            'Content-Type' => 'application/json',
        ])->post("https://api.notion.com/v1/databases/{$databaseId}/query", [
            'filter' => [
                'and' => [
                    [
                        'property' => 'Status',
                        'status' => [
                            'does_not_equal' => 'Done' // Sesuaikan jika opsi di Notion adalah 'Done'
                        ]
                    ],
                    [
                        'property' => 'Due date',
                        'date' => [
                            'on_or_after' => $startDate
                        ]
                    ],
                    [
                        'property' => 'Due date',
                        'date' => [
                            'on_or_before' => $endDate
                        ]
                    ]
                ]
            ],
            // Opsional: Urutkan dari tenggat waktu yang paling dekat
            'sorts' => [
                [
                    'property' => 'Due date',
                    'direction' => 'ascending'
                ]
            ]
        ]);

        if ($notionResponse->failed()) {
            $this->error('Gagal mengambil data dari Notion. Detail: ' . $notionResponse->body());
            return;
        }

        $tasks = $notionResponse->json('results');

        if (empty($tasks)) {
            $this->info("Tidak ada tugas belum selesai untuk rentang tanggal {$startDate} s/d {$endDate}.");
            return;
        }

        // 2. Format Pesan WhatsApp
        $start = \Carbon\Carbon::parse($startDate)->isoFormat('D MMMM Y');
        $end = \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM Y');
        $message = "*REMINDER TUGAS PELATIHAN* 🚨\n";
        $message .= "_Rentang: {$start} s/d {$end}_\n\n";
        $message .= "Berikut adalah daftar tugas yang harus diselesaikan segera:\n\n";

        foreach ($tasks as $index => $task) {
            $properties = $task['properties'];

            // A. Mengambil nama tugas
            $taskName = $properties['Name']['title'][0]['text']['content'] ?? 'Tugas Tanpa Nama';

            // B. Mengambil Deskripsi (Rich Text)
            $descArray = $properties['Deskripsi']['rich_text'] ?? [];
            $descText = '';
            foreach ($descArray as $textItem) {
                $descText .= $textItem['plain_text'] ?? '';
            }
            $descText = !empty($descText) ? $descText : 'Tidak ada deskripsi.';

            // C. Mengambil Pelatihan (Relation)
            $projectRelationIds = $properties['Pelatihan']['relation'] ?? [];
            $projectName = 'Pelatihan Tidak Diketahui';

            if (!empty($projectRelationIds)) {
                $projectId = $projectRelationIds[0]['id'];

                $projectResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $notionToken,
                    'Notion-Version' => '2022-06-28',
                ])->get("https://api.notion.com/v1/pages/{$projectId}");

                if ($projectResponse->successful()) {
                    $projectProps = $projectResponse->json('properties');
                    foreach ($projectProps as $prop) {
                        if ($prop['type'] === 'title') {
                            $projectName = $prop['title'][0]['plain_text'] ?? 'Pelatihan Tanpa Nama';
                            break;
                        }
                    }
                }
            }

            // D. Mengambil nama PIC (Person)
            $picArray = $properties['PIC']['people'] ?? [];
            $picNames = [];
            foreach ($picArray as $person) {
                // Mengambil nama dari array 'people'
                $picNames[] = $person['name'] ?? 'Unknown User';
            }
            $picString = !empty($picNames) ? implode(', ', $picNames) : 'Belum ada PIC';

            $date = $properties['Due date']['date']['start'] ?? date('Y-m-d');
            $due_date = \Carbon\Carbon::parse($date)->isoFormat('D MMMM Y');

            // Menyusun baris per tugas
            $message .= "📁 Pelatihan: {$projectName}\n";
            $message .= "📌 Task: *{$taskName}*\n";
            $message .= "👤 PIC: {$picString}\n";
            $message .= "📅 Tanggal: {$due_date}\n";
            $message .= "📝 Deskripsi:\n{$descText}\n\n";
        }

        $message .= "Mohon tim terkait untuk segera menindaklanjuti. Terima kasih!";

        // 3. Kirim Pesan via Fonnte
        $this->sendToFonnte($message);
    }

    private function sendToFonnte($message)
    {
        $fonnteToken = env('FONNTE_TOKEN');
        $target = env('FONNTE_GROUP_TOKEN');

        $response = Http::withHeaders([
            'Authorization' => $fonnteToken,
        ])->post('https://api.fonnte.com/send', [
            'target' => '6285758206435',
            'message' => $message,
            'countryCode' => '62',
        ]);

        if ($response->successful()) {
            $this->info('Pesan berhasil dikirim ke grup WhatsApp.');
        } else {
            $this->error('Gagal mengirim pesan via Fonnte: ' . $response->body());
        }
    }
}