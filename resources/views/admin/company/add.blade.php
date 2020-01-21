@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.alerts')
                <div class="card">
                    <div class="card-header">{{ trans('sentence.Add New Company')}}</div>

                    <div class="card-body">
                        @php
                            $is_edit_form = false;
                            $action_url = route('admin::company.store');
                            if(isset($company)) {
                                $is_edit_form = true;
                                $action_url = route('admin::company.update',['id'=>$company->id]);
                            }
                        @endphp
                        <form method="POST" action="{{ ($action_url) }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="@if($is_edit_form){{ 'PUT' }}@else{{'post'}}@endif">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Name')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if(isset($company->name)){{ $company->name }}@else{{ old('name') }}@endif" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Email')}}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(isset($company->email)){{ $company->email }}@else{{ old('email') }}@endif" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Logo')}}</label>

                                <div class="col-md-6">
                                    <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                                    <div class="form-control-feedback">
                                        <small>{{ trans('sentence.Minimum Image Dimensions are')}} <code>100 x 100px</code> @if(isset($company->logo))<a href="{{asset('storage/'.$company->logo) }}" target="_blank" class="float-right">{{ trans('sentence.View')}}</a> @endif</small>
                                    </div>
                                    @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="website" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Website')}}</label>

                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="@if(isset($company->website)){{ $company->website }}@else{{ old('website') }}@endif">

                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('sentence.Add New Company')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
