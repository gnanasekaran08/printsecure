<?php

use App\Models\Attachment;
use App\Models\PrintJob;
use App\Models\Shop;

test('public print lookup finds print job by document number', function () {
    $shop = Shop::factory()->create([
        'name' => 'Central Print Hub',
    ]);

    $printJob = PrintJob::factory()->create([
        'shop_id'    => $shop->id,
        'doc_no'     => 543210,
        'removed_at' => null,
    ]);

    Attachment::factory()->create([
        'print_job_id' => $printJob->id,
        'filename'     => 'invoice.pdf',
        'filepath'     => 'print-jobs/' . $printJob->job_uuid . '/invoice.pdf',
        'filetype'     => 'application/pdf',
        'filesize'     => 2048,
    ]);

    $response = $this->get(route('print', ['doc_no' => $printJob->doc_no]));

    $response->assertOk();
    $response->assertInertia(fn($page) => $page
            ->component('PrintLookup')
            ->where('filters.doc_no', (string) $printJob->doc_no)
            ->where('printJob.doc_no', $printJob->doc_no)
            ->where('printJob.shop.name', 'Central Print Hub')
            ->has('printJob.attachments', 1)
    );
});

test('public print lookup does not return removed print jobs', function () {
    $shop = Shop::factory()->create();

    $printJob = PrintJob::factory()->create([
        'shop_id'    => $shop->id,
        'doc_no'     => 112233,
        'removed_at' => now(),
    ]);

    $response = $this->get(route('print', ['doc_no' => $printJob->doc_no]));

    $response->assertOk();
    $response->assertInertia(fn($page) => $page
            ->component('PrintLookup')
            ->where('filters.doc_no', (string) $printJob->doc_no)
            ->where('printJob', null)
    );
});

test('public print lookup requires a 6 digit document number', function () {
    $response = $this->get(route('print', ['doc_no' => '12345']));

    $response->assertRedirect();
    $response->assertSessionHasErrors(['doc_no']);
});
