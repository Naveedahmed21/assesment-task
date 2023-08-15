@extends('backend.layouts.app')

@section('title', '| Posts')

@section('breadcrumb')
    <div class="page-header">
        <h1 class="page-title">Posts List</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascripit:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Posts</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title font-weight-bold">Posts</h3>
            <a href="{{route('posts.create')}}" class="btn btn-primary"><i class="ri-add-fill"></i>Add New</a>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" id="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col-lg-2">
                    <select id="status" class="form-control select2">
                        <option value="">All</option>
                        <option value="published">Published</option>
                        <option value="unpublished">Unpublished</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <select id="page_size" class="form-control select2">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table id="posts_datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Category</th>
                            <th class="border-bottom-0">title</th>
                            <th>actions</th>
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
   $(document).ready(function() {
        var table = $('#posts_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("posts-dt") }}',
                data: function (d) {
                    d.search = $('#search').val();
                    d.status = $('#status').val();
                    d.page_size = $('#page_size').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category', name: 'category' },
                { data: 'title', name: 'title' },
                { data: 'actions', name: 'actions',  },
                // Add other columns as needed
            ],
            pagingType: 'full_numbers',
            lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
        });

        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });

        $('#status, #page_size').on('change', function () {
            table.draw();
        });
    });
</script>

@endpush

