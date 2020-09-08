<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('wba:sum {label : is label} {args* : is array}', function($label, $args){
	echo $label. '='. array_sum($args);
})->describe('sum some numbers');

Artisan::command('wba:print {name : param name} {--wrap : wrap single qute \'}', function($name) {
	dd($this->hasOption('wrap'));
	dd($this->options());
	dd($this->option('wrap'));
	$wrap = $this->option('wrap') ? "'" : "";
	echo "name is : {$wrap}{$name}{$wrap}";
})->describe('print name');

Artisan::command('output', function(){
	$this->comment('this is a comment');
	$this->info('this is a info');
	$this->error('this is a error');
});
