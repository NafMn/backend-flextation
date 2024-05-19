@extends('layout')

@section('content')
    <h2>Comments</h2>
    <a href="{{ route('comments.create') }}">Add Comment</a>
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    <table>
        <tr>
            <th>Name</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
        @foreach ($comments as $comment)
        <tr>
            <td>{{ $comment->name }}</td>
            <td>{{ $comment->comment }}</td>
            <td>
                <a href="{{ route('comments.show', $comment->id) }}">Show</a>
                <a href="{{ route('comments.edit', $comment->id) }}">Edit</a>
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
