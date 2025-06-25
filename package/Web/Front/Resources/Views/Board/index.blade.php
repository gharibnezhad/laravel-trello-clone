@extends('Front::Board.master')

@section('content')
    <section class="lists-container">

        <div class="list">

            <h3 class="list-title">Tasks to Do</h3>

            <ul class="list-items">
                <li>Complete mock-up for client website</li>
            </ul>

            <button class="add-card-btn btn">Add a card</button>

        </div>

        <button class="add-list-btn btn">Add a list</button>

    </section>
@endsection

