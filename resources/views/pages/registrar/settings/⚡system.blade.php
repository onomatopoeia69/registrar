<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new 
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
 class extends Component
{


};
?>

<div>

    <section id="info" class="container-fluid pt-4">

    <div class="card">

    <div class="card-header">
        <h1 class="card-title text-bold fs-3">System Information</h1>
    </div>

    <div class="card-body p-0">
        <table id="student-table" class="table table-sm table-bordered table-striped ">
            <thead>
                <tr>
                    <th style="width: 30%">Tools</th>
                    <th>Specification</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Database Driver</b></td>
                    <td><span class="badge badge-info">{{ DB::getDriverName() }}</span></td>
                </tr>
                <tr>
                    <td><b>Database Name</b></td>
                    <td><code>{{ DB::connection()->getDatabaseName() }}</code></td>
                </tr>
                <tr>
                    <td><b>PHP Version</b></td>
                    <td><span class="badge badge-primary">{{ PHP_VERSION }}</span></td>
                </tr>
                <tr>
                    <td><b>Laravel Version</b></td>
                    <td>{{ app()->version() }}</td>
                </tr>
                <tr>
                    <td><b>User IP</b></td>
                    <td><code>{{ request()->ip() }}</code></td>
                </tr>
                <tr>
                    <td><b>Device Info</b></td>
                    <td class="text-muted small">{{ request()->userAgent() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
        
    </section>
</div>