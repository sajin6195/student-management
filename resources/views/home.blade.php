@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('message'))
            <div class="alert alert-success">
            {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">Add Student</div>


                <div class="card-body">
                    <form method="POST" action="@if(isset($studentsDetails)) {{ route('update-student') }} @else {{ route('add-student') }} @endif">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required autofocus @if(isset($studentsDetails->name)) value="{{$studentsDetails->name}}" @endif>
                            </div>
                            @if(isset($studentsDetails))
                                <input type="hidden" class="form-control" name="student_id" value="{{$studentsDetails->id}}">
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Age:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="age" required @if(isset($studentsDetails->age)) value="{{$studentsDetails->age}}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Gender:</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required="" name="gender" value="1" @if(isset($studentsDetails->gender)) @if($studentsDetails->gender == 1) checked @endif @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required="" name="gender" value="2" @if(isset($studentsDetails->gender)) @if($studentsDetails->gender == 2) checked @endif @endif>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Reporting Teacher:</label>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="teacher_id" required="">
                                    <option value="">Select teacher</option>
                                    @if(isset($teachers))
                                        @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}" @if(isset($studentsDetails->teacher_id)) @if($studentsDetails->teacher_id == $teacher->id) selected @endif @endif>{{$teacher->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if(isset($studentsDetails)) Update @else Save @endif
                                </button>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Reporting Teacher</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if(count($students) > 0)
                                @foreach($students as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->age}}</td>
                                    <td>
                                        @if($student->gender == 1)
                                            Male
                                        @else
                                            Female
                                        @endif
                                    </td>
                                    <td>{{$student->teacher_name}}</td>
                                    <td>
                                        <a href="{{ route('edit-student', ['id' => $student->id]) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete-student', ['id' => $student->id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6">No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
