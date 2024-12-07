<?php

use App\Filament\Resources\ClientResource;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class)->in('Feature', 'Unit');

it('can render page', function () {
    $response = $this->get('/filament/resources/clients');

    $response->assertStatus(200);
});
