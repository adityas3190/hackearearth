@extends('layouts.master')
@section('content')

	<div class="panel-group" id="accordion" style="padding: 15px;">
        <h4>Total number of kings : {{ count($results) }}</h4>
			@foreach($results as $result)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#{{$result['id']}}">
						#{{ ($result['id']+1).") ".$result['name'] }}</a>
				</h4>
			</div>
			<div id="{{ $result['id'] }}" class="panel-collapse collapse">
				<div class="panel-body ">
					<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
					<ul>
						<li>
							<b>Name of King: {{$result['name']}}</b>
						</li>
						<li>
							<b>Rating: {{round($result['rating'])}}</b>
						</li>
						<li>
							<b>Total Battles: {{$result['battleDetails']['total_battles']}}</b>
						</li>
						<li>
							<b>Battles Won: {{$result['battleDetails']['won']}}  <a data-toggle="modal" data-target="#{{$result['id']}}-won" style="cursor: pointer"> View details</a></b>
						</li>
						<li>
							<b>Battles Lost: {{$result['battleDetails']['lost']}}  <a data-toggle="modal" data-target="#{{$result['id']}}-lost" style="cursor: pointer"> View details</a></b>
						</li>
					</ul>
					</div>
					<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
						<?php $image = str_replace('/','',$result['name']); ?>
						<img src="/images/{{$image}}.jpg" style="max-height: 200px;float: right">
					</div>
				</div>

			</div>
		</div>
		<!--Modal explaining battle details-->
			<div id="{{ $result['id'] }}-won" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Battles won by {{ $result['name'] }}</h4>
						</div>
						<div class="modal-body">
							<ul style="font-size: 12px;font-weight: 500">
								@foreach($result['battleDetails']['wonDetails'] as $wonDetails)
								<li>
									{{ $result['name'] }} defeated {{ $wonDetails['defeated'] }} in the year {{ $wonDetails['year'] }} at {{ $wonDetails['location'] }}.It was a {{ $wonDetails['type'] }} type battle.
								</li>
								@endforeach
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			<div id="{{ $result['id'] }}-lost" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Battles lost by {{ $result['name'] }}</h4>
						</div>
						<div class="modal-body">
							<ul style="font-size: 12px;font-weight: 500">
								@foreach($result['battleDetails']['lostDetails'] as $wonDetails)
									<li>
										{{ $result['name'] }} was defeated by {{ $wonDetails['defeated'] }} in the year {{ $wonDetails['year'] }} at {{ $wonDetails['location'] }}.It was a {{ $wonDetails['type'] }} type battle.
									</li>
								@endforeach
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		<!--Modal ends here-->
		@endforeach


	</div>

@endsection
@section('script')
	<script type="text/javascript">
	$(document).ready(function(){
		$("#india").click(function(){
				alert("jQuery works");
		});
	});

	</script>
@endsection
