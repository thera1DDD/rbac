@extends('layouts.admin')

@section('title')
Languages
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Language</h3>

        <div class="card-tools">
            <a href="{{ route('language.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new language</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($languages as $language)
                    <tr>
                        <td>{{ $language->id }}</td>
                        <td>{{ $language->name }}</td>
                        <td>{{ $language->created_at }}</td>
                        <td>
                            <a href="{{ route('language.edit', $language->id) }}" class="btn btn-sm btn-warning">Edit Language</a>
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
