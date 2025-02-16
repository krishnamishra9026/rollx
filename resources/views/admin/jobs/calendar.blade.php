@extends('layouts.admin')
@section('title', 'Jobs')
@section('head')
    <style>
        .fc-event {
            border-radius: 2px;
            border: none;
            cursor: move;
            font-size: 0.683rem;
            margin: 0px 0px;
            padding: 3px 3px;
            color: #46D4D1;
        }

        .fc-theme-standard .fc-list-event td,
        .fc-theme-standard .fc-list-event th,
        .fc-theme-standard .fc-list-event td:hover,
        .fc-theme-standard .fc-list-event th:hover,
        .fc-theme-standard .fc-list-event tr:hover {
            background-color: #001D3A;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Scheduled Jobs</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.jobs.filter-calendar')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- third party js -->
    <script src="{{ asset('assets/js/plugins/fullcalendar/dist/index.global.js') }}"></script>
    <!-- third party js ends -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: new Date,
                initialView: 'timeGridWeek',
                nowIndicator: true,
                themeSystem: 'bootstrap',
                slotMinTime: '10:00:00',
                slotDuration: "00:15:00",
                displayEventTime: false,
                duration: {
                    days: 4
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay,listWeek'
                },
                navLinks: true, // can click day/week names to navigate views
                expandRows: true,
                events: [
                    @foreach ($jobs as $job)
                        {
                            title: '{{ $job->jobType->type }}',
                            start: '{{ $job->start_date }}' + 'T' + '{{ $job->start_time }}',
                            end: '{{ $job->start_date }}' + 'T' + '{{ $job->end_time }}',
                            formattedDate: '{{ \Carbon\Carbon::parse($job->start_date)->format('M d, Y') }}',
                            timeslot: '{{ \Carbon\Carbon::parse($job->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($job->end_time)->format('h:i A') }}',
                            equipmentName: '{{ $job->equipment->equipment_name }}',
                            technicianName: '{{ $job->technician->firstname }} {{ $job->technician->lastname }}',
                            customerName: '{{ $job->customer->name }}',
                            customerAddress: '{{ $job->address->address }} {{ $job->address->city }} {{ $job->address->state }} {{ $job->address->country }} {{ $job->address->zipcode }}',
                            serviceType: '{{ $job->jobType->type }}',
                            backgroundColor: '#001D3A',
                            eventURL: '{{ route('admin.jobs.show', $job->id) }}',
                        },
                    @endforeach
                ],
                eventContent: function(arg) {

                    var event = arg.event;

                    var eventHtml = '<p class="m-0" style="color:#46D4D1">' + event.extendedProps
                        .equipmentName + '</p>';
                    eventHtml += '<p class="m-0" style="color:#ffa3e3f7">' + event.extendedProps
                        .serviceType + '</p>';
                    eventHtml += '<p class="m-0" style="color:#FFFF00">' + event.extendedProps
                        .formattedDate + '</p>';
                    eventHtml += '<p class="m-0" style="color:#FFFF00">' + event.extendedProps
                        .timeslot + '</p>';
                    eventHtml += '<p class="m-0" style="color:#FFFFFF">Technician: ' + event
                        .extendedProps.technicianName + '</p>';
                        eventHtml += '<p class="m-0" style="color:#2ce5a1">Customer</p>';
                        eventHtml += '<p class="m-0" style="color:#2ce5a1">' + event
                        .extendedProps.customerName + '</p>';
                        eventHtml += '<p class="m-0" style="color:#2ce5a1">' + event
                        .extendedProps.customerAddress + '</p>';
                    return {
                        html: eventHtml
                    }
                },
                eventClick: function(arg) {
                    location.href = arg.event.extendedProps.eventURL;
                }
            });

            calendar.render();
        });
    </script>
@endpush
