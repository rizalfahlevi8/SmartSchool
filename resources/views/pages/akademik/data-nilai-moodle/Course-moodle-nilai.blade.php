@extends('components.main')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-jadwal">Course</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Detail</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Detail Course</h6>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="/data-nilai-moodle/course-moodle" type="button" id="btntambah"
               class="btn btn-secondary rounded-pill font-weight-bold text-xs text-white" style="background-color: #3b82f6";>
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
        </div>
    </div>
    {{-- Search form --}}
    <div class="row mt-3">
        <div class="col-12">
            <form action="{{ route('get.grade.items', ['courseId' => $courseId]) }}" method="GET">
                <div class="form-group">
                    <label for="search">Search by User Fullname:</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Enter userfullname">
                </div>
            </form>
        </div>
    </div>

    {{-- Store usergrades data in a variable --}}
    @php
        $userGradesData = $gradeItems['usergrades'];
    @endphp


    {{-- Iterate through usergrades --}}
    @foreach ($userGradesData as $grade)
        @if (strpos(strtolower($grade['userfullname']), 'pengajar') === false)
            {{-- Check if search query matches userfullname --}}
            @if (isset($_GET['search']) && stripos($grade['userfullname'], $_GET['search']) === false)
                @continue
            @endif

            <div class="row mt-3">
                <div class="col-12">
                    <!-- Card for User Fullname -->
                    <div class="card mb-1" style="background-color: #ffffff; color: #ffffff; font-size: px; border-radius: 14px;">
                        <div class="card-body">
                            <h4 class="card-title" style="font-size: 20px;">{{ $grade['userfullname'] }}</h4>
                            <!-- Iterate through gradeitems -->
                            @foreach ($grade['gradeitems'] as $item)
                                <!-- Check if itemmodule is quiz or assign -->
                                @if (in_array($item['itemmodule'], ['quiz', 'assign']))
                                    <!-- Card for Item Name -->
                                    <div class="card mb-2" style="background-color: #ffffff; border-radius: 6px;">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-size: 14px; margin-bottom: 0;">{{ $item['itemname'] }}</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item" style="font-size: 14px; padding: 1px;">Nilai: {{ $item['graderaw'] }}</li>
                                                <!-- Check if items key exists before looping -->
                                                @if (array_key_exists('items', $item))
                                                    <!-- Loop untuk menampilkan data lainnya -->
                                                    @foreach ($item['items'] as $column)
                                                        <li class="list-group-item" style="font-size: 14px; padding: 1px;">{{ $column['column1'] }}: {{ $column['column2'] }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End of Card for Item Name -->
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- End of Card for User Fullname -->
                </div>
            </div>
        @endif
    @endforeach
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var searchInput = document.getElementById('search');
            searchInput.addEventListener('input', function () {
                // Delay execution to avoid triggering the search on every keystroke
                clearTimeout(this.timer);
                this.timer = setTimeout(function () {
                    // Trigger the form submission when the user types
                    searchInput.closest('form').submit();
                }, 500);
            });
        });
    </script>
    {{-- Iterate through usergrades --}}
    @foreach ($userGradesData as $grade)
        <!-- Your existing iteration code... -->
    @endforeach
@endsection
