@extends('layouts.print.app')

@section('content')
    <div class="container mt-5">
        <img class="img-fluid" src="{{ asset('img/logo/logo2.png') }}" width="100" alt="logo">
        <h4 class="text-center">
            <a class="text-dark text-decoration-none" href="{{ route('staff.bookings.show', $booking) }}?tab=tables">
                Central Bark Veterinary Clinic - Appointment Prescriptions
            </a>
        </h4>
        <h6 class="text-center">
            Tungkop, Minglanilla, Cebu, Philippines
        </h6>
        <br><br>
        {{-- <div class="d-flex justify-content-between">
           

        </div> --}}

        {{-- Row 1 --}}
        <div class="row">
            <div class="col-md-6">
                <span>Pet: {{ $prescriptions[0]->booking->pet->name }}</span> <br>
                <span>Breed: {{ $prescriptions[0]->booking->pet->breed }}</span>
            </div>
            <div class="col-md-6 text-right">
                <span>Owner: {{ $prescriptions[0]->booking->pet->customer->full_name }}</span> <br>
                <span> Date Schedule: {{ formatDate($prescriptions[0]->booking->schedule->date_time_start) }}
                    at {{ formatDate($prescriptions[0]->booking->schedule->date_time_start, 'time') }}
                    - {{ formatDate($prescriptions[0]->booking->schedule->date_time_end, 'time') }}
                </span>
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="row">
            <div class="col-md-8">
                Birthday: {{ formatDate($prescriptions[0]->booking->pet->birth_date) }}
            </div>
            <div class="col-md-4 text-right">
                Age: {{ getPetAge($prescriptions[0]->booking->pet->birth_date) }}

                <span class="ml-3">
                    Sex: {{ $prescriptions[0]->booking->pet->customer->sex }}
                </span>
            </div>
        </div>

        <br>
        <form class="d-print-none " action="{{ route('staff.print.handle') }}" method="GET">
            <div class="input-group input-group-outline ">
                <input type="hidden" name="records" value="prescription">
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
        <br><br>

        <h3 class="text-center">Rx</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Drug</th>
                        <th>Description</th>
                        <th>Dosage</th>
                        <th>Qty</th>
                        <th class="text-center">Directions <br>
                            <span>(Breakfast --- Lunch --- Dinner)</span>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($prescriptions as $prescription)
                        <tr>
                            <td>
                                {{ $prescription->drug }}
                            </td>
                            <td>
                                {{ $prescription->description }}
                            </td>

                            <td>
                                {{ $prescription->preparation }}
                            </td>
                            <td>
                                {{ $prescription->qty }}
                            </td>
                            <td>
                                {{ $prescription->direction }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Records Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}} <br><br>
        <div class="row mt-5">
            <div class="col-6">

            </div>
            <div class="col-6 pr-5 ">
                <h5 class="text-center mb-0" style="text-decoration: underline">
                    Dr.
                    {{ auth()->user()->staff->full_name }}
                </h5>
                <h6 class="font-weight-normal text-center">Attending Physician</h6>
            </div>
        </div>
        {{-- End Footer --}}
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
