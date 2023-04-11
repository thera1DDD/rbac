@extends('layouts.admin')

@section('title')
Courses
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Course</h3>

        <div class="card-tools">
            <a href="{{ route('course.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new course</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Language</th>
                    <th>Main Image</th>
                    <th>Slug</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->language->name}}</td>
                        <td>{{ $course->main_image }}</td>
                        <td>{{ $course->slug }}</td>
                        <td>{{ $course->created_at }}</td>
                        <td>
                            <a href="{{ route('course.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit Course</a>
                        </td>
                    </tr>
                @empty
                    <tr>No Result Found</tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection
