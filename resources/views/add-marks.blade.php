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
                <div class="card-header">Add Marks</div>
                <div class="card-body">
                    <form method="POST" action="@if(isset($markDetails)) {{ route('update-marks') }} @else {{ route('store-marks') }} @endif">
                        @csrf
                        @if(isset($markDetails))
                            <input type="hidden" class="form-control" name="mark_id" value="{{$markDetails->id}}">
                        @endif

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Student:</label>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="student_id">
                                    <option>Select student</option>
                                    @if(isset($studentLists))
                                        @foreach($studentLists as $studentList)
                                            <option value="{{$studentList->id}}" @if(isset($markDetails->student_id)) @if($markDetails->student_id == $studentList->id) selected @endif @endif>{{$studentList->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Term:</label>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="term">
                                    <option selected>Select term</option>
                                    <option value="1" @if(isset($markDetails->term)) @if($markDetails->term == 1) selected @endif @endif>Term One</option>
                                    <option value="2" @if(isset($markDetails->term)) @if($markDetails->term == 2) selected @endif @endif>Term Two</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Maths:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="maths" required @if(isset($markDetails->maths)) value="{{$markDetails->maths}}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Science:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="science" required @if(isset($markDetails->science)) value="{{$markDetails->science}}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">History:</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="history" required @if(isset($markDetails->history)) value="{{$markDetails->history}}" @endif>
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if(isset($markDetails)) Update @else Save @endif
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
                            <th>Term</th>
                            <th>Maths</th>
                            <th>History</th>
                            <th>Science</th>
                            <th>Total Marks</th>
                            <th>Created On</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if(count($students) > 0)
                                @foreach($students as $student)
                                <tr>
                                    @php 
                                        $total = 0;
                                        $total = $student->maths + $student->history + $student->science;
                                    @endphp
                                    <td>{{$student->mark_id}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>
                                         @if($student->term == 1)
                                            One
                                        @else
                                            Two
                                        @endif
                                    </td>
                                    <td>{{$student->maths}}</td>
                                    <td>{{$student->history}}</td>
                                    <td>{{$student->science}}</td>
                                    <td>{{$total}}</td>
                                    <td>{{date("M j, Y h:i A", strtotime($student->created_at))}}</td>
                                    <td>{{$student->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{ route('edit-marks', ['id' => $student->mark_id]) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete-marks', ['id' => $student->id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="10">No data found</td>
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
