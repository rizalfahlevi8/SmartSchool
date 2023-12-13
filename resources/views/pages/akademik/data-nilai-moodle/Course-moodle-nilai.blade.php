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
            <a href="/akademik/jadwal" type="button" id="btntambah"
               class="btn btn-secondary rounded-pill font-weight-bold text-xs text-white">
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
        </div>
    </div>
    

    @foreach ($gradeItems['usergrades'] as $grade)
        <div class="row mt-3">
            <div class="col-12">
                <!-- Card for User Fullname -->
                <div class="card mb-2" style="background-color: #3498db; color: #ffffff; font-size: 14px; border-radius: 8px;">
                    <div class="card-body">
                        <h4 class="card-title">{{ $grade['userfullname'] }}</h4>
                        <!-- Iterate through gradeitems -->
                        @foreach ($grade['gradeitems'] as $item)
                            <!-- Check if itemmodule is quiz or assign -->
                            @if (in_array($item['itemmodule'], ['quiz', 'assign']))
                                <!-- Card for Item Name -->
                                <div class="card mb-2" style="background-color: #ffffff; border-radius: 6px;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 16px;">{{ $item['itemname'] }}</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item" style="font-size: 16px;">Nilai: {{ $item['graderaw'] }}</li>
                                            <!-- Check if items key exists before looping -->
                                            @if (array_key_exists('items', $item))
                                                <!-- Loop untuk menampilkan data lainnya -->
                                                @foreach ($item['items'] as $column)
                                                    <li class="list-group-item" style="font-size: 14px;">{{ $column['column1'] }}: {{ $column['column2'] }}</li>
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
    @endforeach
@endsection
