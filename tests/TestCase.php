<?php

namespace Tests;

use Filament\Support\Livewire\Partials\DataStoreOverride;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Livewire\Mechanisms\DataStore;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Filament v5 binds Livewire's DataStore transiently, which yields a
        // fresh instance (and a fresh error bag) on every resolution. For
        // page-render tests that loses component state. Rebind it as a shared
        // singleton so the error bag survives across resolutions.
        $this->app->singleton(DataStore::class, DataStoreOverride::class);
    }
}
