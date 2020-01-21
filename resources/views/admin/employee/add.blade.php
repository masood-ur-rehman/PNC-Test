@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.alerts')
                <div class="card">
                    <div class="card-header">{{ trans('sentence.Add New Employee')}}</div>

                    <div class="card-body">
                        @php
                            $is_edit_form = false;
                            $action_url = route('admin::employee.store');
                            if(isset($employee)) {
                                $is_edit_form = true;
                                $action_url = route('admin::employee.update',['id'=>$employee->id]);
                            }
                        @endphp
                        <form method="POST" action="{{ ($action_url) }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="@if($is_edit_form){{ 'PUT' }}@else{{'post'}}@endif">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Company')}}</label>

                                <div class="col-md-6">
                                    <select name="company_id" class="form-control @error('company_id') is-invalid @enderror" required>
                                        <option value="">{{ trans('sentence.Select Company')}}</option>
                                        @if($companies)
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}" @if($is_edit_form && $company->id == $employee->company_id) selected @endif>{{ $company->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.First Name')}}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="@if(isset($employee->first_name)){{ $employee->first_name }}@else{{ old('first_name') }}@endif" autocomplete="first_name">

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Last Name')}}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="@if(isset($employee->last_name)){{ $employee->last_name }}@else{{ old('last_name') }}@endif" autocomplete="last_name">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Email')}}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(isset($employee->email)){{ $employee->email }}@else{{ old('email') }}@endif" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ trans('sentence.Phone')}}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="@if(isset($employee->phone)){{ $employee->phone }}@else{{ old('phone') }}@endif">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('sentence.Add New Employee')}}
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
