@servers(['localhost' => 'localhost'])

@setup
    $test = 0;
@endsetup

@task('dockerup', ['on' => 'localhost'])
	@if($test)
		echo "Hej!"
	@endif
@endtask