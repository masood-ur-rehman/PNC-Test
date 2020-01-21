@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('admin.alerts')
                <div class="card">
                    <div class="card-header">{{ trans('sentence.employee_listing')}} <a class="float-right" href="{{ route('admin::employee.create') }}">{{ trans('sentence.add_new')}}</a></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('sentence.ID')}}</th>
                                <th scope="col">{{ trans('sentence.Company')}}</th>
                                <th scope="col">{{ trans('sentence.First Name')}}</th>
                                <th scope="col">{{ trans('sentence.Last Name')}}</th>
                                <th scope="col">{{ trans('sentence.Email')}}</th>
                                <th scope="col">{{ trans('sentence.Phone')}}</th>
                                <th scope="col">{{ trans('sentence.Created at')}}</th>
                                {{--<th scope="col">Updated at</th>--}}
                                <th scope="col">{{ trans('sentence.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($employees) > 0)
                                @foreach($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $employee->id }}</td>
                                    <td><a href="{{ route('admin::company.edit',['id'=>$employee->company_id]) }}">{{ $employee->Company->name }}</a></td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>
                                        <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                    </td>
                                    <td><a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a></td>
                                    <td>&nbsp;{{ $employee->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin::employee.edit',['id'=>$employee->id]) }}">{{ trans('sentence.Edit')}}</a>
                                        <form method="POST" action="{{ route('admin::employee.destroy',['id'=>$employee->id]) }}" >
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <div class="pagination-container">
                                    <nav class="pagination">
                                        {{$employees->appends(request()->query())->links()}}
                                    </nav>
                                </div>

                            @else
                                <tr><td colspan="8">{{ trans('sentence.No Record Found')}}</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
