@extends('layouts.print.app')

@section('content')
    <div class="container mt-5">
        <img class="img-fluid" src="{{ asset('img/logo/logo.png') }}" width="100" alt="logo">
        <h4 class="text-center">
            <a class="text-dark text-decoration-none" href="{{ route('staff.bookings.show', $booking) }}?tab=tables">
                {{ config('app.name') }} - Appointment Results
            </a>
        </h4>
        <h6 class="text-center">
            Tungkop, Minglanilla, Cebu, Philippines
        </h6>
        <br><br>

        {{-- Row 1 --}}
        @if (!empty($results) && isset($results[0]))
            <div class="row">
                <div class="col-md-6">
                    <span>Pet: {{ $results[0]->booking->pet->name }}</span> <br>
                    <span>Breed: {{ $results[0]->booking->pet->breed }}</span>
                </div>
                <div class="col-md-6 text-right">
                    <span>Owner: {{ $results[0]->booking->pet->customer->full_name }}</span> <br>
                    <span> Date Schedule: {{ formatDate($results[0]->booking->schedule->date_time_start) }}
                        at {{ formatDate($results[0]->booking->schedule->date_time_start, 'time') }}
                        - {{ formatDate($results[0]->booking->schedule->date_time_end, 'time') }}
                    </span>
                </div>
            </div>

            {{-- Row 2 --}}
            <div class="row">
                <div class="col-md-8">
                    Birthday: {{ formatDate($results[0]->booking->pet->birth_date) }}
                </div>
                <div class="col-md-4 text-right">
                    Age: {{ getPetAge($results[0]->booking->pet->birth_date) }}

                    <span class="ml-3">
                        Sex: {{ $results[0]->booking->pet->customer->sex }}
                    </span>
                </div>
            </div>
        @else
            <p>No results available for this booking.</p>
        @endif

        <br>
        <form class="d-print-none " action="{{ route('staff.print.handle') }}" method="GET">
            <div class="input-group input-group-outline ">
                <input type="hidden" name="records" value="result">
                <input type="hidden" name="booking" value="{{ $booking }}">
                <input class="form-control" type="text" name="date_started_at" placeholder="Date Started"
                    onfocus="(this.type = 'date')"
                    value="{{ request('date_started_at') ? formatDate(request('date_started_at'), 'dateInput') : '' }}">
                <input class="form-control" type="text" name="date_ended_at" placeholder="Date Ended"
                    onfocus="(this.type = 'date')"
                    value="{{ request('date_ended_at') ? formatDate(request('date_ended_at'), 'dateInput') : '' }}">
                <input type="hidden" name="execute" value="1">
                <button type="submit" class="btn btn-success">Print</button>
            </div>
        </form>
        <br>
        <table class="table table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Remark</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $result->subject }}</td>
                        <td>{{ $result->remark }}</td>
                        <td>{{ formatDate($result->created_at) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            const url = new URL(location.href);
            const execute = url.searchParams.get('execute');

            execute == true ? print() : false
        });
        onafterprint = function() {
            window.location.href = @json(route('staff.bookings.show', $booking));
        }
    </script>
@endsection
