        @extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
       <a href="{{ route('user-export', ['type' => 'xls']) }}" class="btn btn-success">Export Excel</a>
<a href="{{ route('user-export', ['type' => 'csv']) }}" class="btn btn-danger">Export CSV</a>

            <div class="panel panel-default"> 
                <div class="panel-heading">User List</div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection