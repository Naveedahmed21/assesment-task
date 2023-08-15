@extends('backend.layouts.app')

@section('title', '| Categories')

@section('breadcrumb')
    <div class="page-header">
        <h1 class="page-title">Categories List</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascripit:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title font-weight-bold">Categories</h3>
            <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="ri-add-fill"></i>Add New</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="categories_datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Name</th>
                            <th class="border-bottom-0">Status</th>
                            <th class="border-bottom-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000);
        $(function() {
            $('#categories_datatable').DataTable({
                ajax: '{{ route('categoris-dt') }}',
                processing: true,
                serverSide: true,
                scrollX: false,
                autoWidth: true,
                columnDefs: [{
                        width: 1,
                        targets: 3
                    },
                    {
                        width: '5%',
                        targets: 0
                    }
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
