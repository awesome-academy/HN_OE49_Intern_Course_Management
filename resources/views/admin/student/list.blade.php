@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Students List') }}</h2>
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }} </th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('user') }}</th>
                            <th>{{ __('dob') }}</th>
                            <th>{{ __('address') }}</th>
                            <th>{{ __('email') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key => $student)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><a
                                        href="{{ route('students.show', ['student' => $student]) }}">{{ $student->fullname }}</a>
                                </td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->dob }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('students.edit', ['student' => $student]) }}" method="GET">
                                        <button type="submit" class="btn btn-warning">{{ __('Update') }}</button>
                                        @csrf
                                    </form>
                                </td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('students.destroy', ['student' => $student]) }}" method="POST">
                                        @method('DELETE')
                                        <button type="submit" class=" btn btn-red"
                                            data-confirm="{{ __('pop up student') }}?">{{ __('Delete') }}</button>
                                        @csrf
                                    </form>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
