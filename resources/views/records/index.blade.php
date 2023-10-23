@extends('layouts.app')

@section('content')

<div class="container">
    <h1>All Records</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Record Cover</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td><a href="{{ route('records.show', $record) }}">{{ $record->title }}</a></td>
                <td>{{ $record->description }}</td>
                <td>
                    @if ($record->record_cover)
                        <img src="{{ $record->record_cover }}"
                        alt="{{ $record->title }}" width="100">
                    @else
                        No Image
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
