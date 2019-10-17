@extends('admin_layout')
@section('admin_content')

			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">All Category</a></li>
			</ul>
			<p class="alert-success">
				<?php
					$message=Session::get('message');
					if ($message) {
						echo $message;
						Session::put('message', null);
					}
				?>
			</p>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Category</h2>
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
								  <th>Category ID</th>
								  <th>Category Name</th>
								  <th>Category Description</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
						 @foreach ($all_category_info as $cat_category)
						  <tbody>
							<tr>
								<td>{{$cat_category->category_id}}</td>
								<td class="center">{{$cat_category->category_name}}</td>
								<td class="center">{{$cat_category->category_description}}</td>
								<td class="center">
									@if($cat_category->pub_status==1)
									<span class="label label-success">Active<!-- {{$cat_category->pub_status}} --></span>
									@else
									<span class="label label-danger">Unactive<!-- {{$cat_category->pub_status}} --></span>
									@endif
								</td>
								<td class="center">
									@if($cat_category->pub_status==1)

									<a class="btn btn-success" href="{{URL::to('/unactive_category/'.$cat_category->category_id)}}">
										<i class="halflings-icon white ok-sign"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{URL::to('/active_category/'.$cat_category->category_id)}}">
										<i class="halflings-icon white plus-sign"></i>  
									</a>
									@endif

									<a class="btn btn-info" href="{{URL::to('/edit-category/'.$cat_category->category_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-category/'.$cat_category->category_id)}}" id
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