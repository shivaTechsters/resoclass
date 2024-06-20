@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.examination.center.list') }}">Examination Centers</a></li>
        </ul>
        <h1 class="panel-title">Examination Centers</h1>
    </div>
@endsection


@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">Examination Centers</h1>
                <p class="panel-card-description">List of all examination centers in the system</p>
            </div>
            <div>
                <a href="{{ route('admin.view.examination.center.create') }}" class="btn-primary-sm flex">
                    <span class="lg:block md:block sm:hidden mr-2">Add Center</span>
                    <i data-feather="plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($examination_centers as $key => $examination_center)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $examination_center->name }}</td>
                                <td>{{ $examination_center->address }}</td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.examination.center.update', ['id' => $examination_center->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Edit Center</a></li>
                                                <li><a href="javascript:handleDelete('{{ $examination_center->id }}');"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Center</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </figure>
@endsection

@section('panel-script')
    <script>
        document.getElementById('examination-center-tab').classList.add('active');

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this center!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin/examination-center/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
