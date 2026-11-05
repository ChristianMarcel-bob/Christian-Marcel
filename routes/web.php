<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;

Route;;get('/helpdesk', function() {
return view('portfolio');


});


rout::get('/helpdesk', [HelpdeskController::class, 
'index'])->name('helpdesk');

rout::post('/helpdesk', [HelpdeskController::class, 
'salvar'])->name('helpdesk.salvar');

