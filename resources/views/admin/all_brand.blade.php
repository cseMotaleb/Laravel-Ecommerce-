@extends('admin_layout')
@section('admin_content')

			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">All Brand</a></li>
			</ul>
			<p class="alert-success">
				<!-- <?php
					$message=Session::get('message');
					if ($message) {
						echo $message;
						Session::put('message', null);
					}
				?> -->
			</p>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Brand</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Brand ID</th>
								  <th>Brand Name</th>
								  <th>Brand Description</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
						 @foreach ($all_brand_info as $cat_brand)
						  <tbody>
							<tr>
								<td>{{$cat_brand->brand_id}}</td>
								<td class="center">{{$cat_brand->brand_name}}</td>
								<td class="center">{{$cat_brand->brand_description}}</td>
								<td class="center">
									@if($cat_brand->pub_status==1)
									<span class="label label-success">Active<!-- {{$cat_brand->pub_status}} --></span>
									@else
									<span class="label label-danger">Unactive<!-- {{$cat_brand->pub_status}} --></span>
									@endif
								</td>
								<td class="center">
									@if($cat_brand->pub_status==1)

									<a class="btn btn-success" href="{{URL::to('/unactive_brand/'.$cat_brand->brand_id)}}">
										<i class="halflings-icon white ok-sign"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{URL::to('/active_brand/'.$cat_brand->brand_id)}}">
										<i class="halflings-icon white plus-sign"></i>  
									</a>
									@endif

									<a class="btn btn-info" href="{{URL::to('/edit-brand/'.$cat_brand->brand_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-brand/'.$cat_brand->brand_id)}}" id
										="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						
						  </tbody>
						  @endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection