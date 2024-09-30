@extends('layouts.loan') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    

    <div class="content">
        <a href="{{ route('loans.create') }}" class="btn-custom">Add New Loan</a>

        @if ($errors->any())
            <div class="middle-right">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <h2>Lista Prestiti</h2>
        
        <table id="loansTable" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr style="color: black;">
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Borrower</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Returned Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr style="color: black;">
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ $loan->borrowed_at }}</td>
                        <td>{{ $loan->due_at ?? 'N/A' }}</td>
                        <td>{{ $loan->returned_at ?? 'Not returned yet' }}</td>
                        <td>
                            <a href="{{ route('loans.edit', $loan->id) }}">Edit</a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                // Inizializzazione di DataTables
                $('#loansTable').DataTable({
                    "paging": true,        // Abilita il paging
                    "searching": true,     // Abilita il campo di ricerca globale
                    "ordering": true       // Abilita l'ordinamento delle colonne
                });
            });
        </script>
    </div>
@endsection