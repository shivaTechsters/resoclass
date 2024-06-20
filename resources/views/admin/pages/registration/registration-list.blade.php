@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.registration.list') }}">Registrations</a></li>
        </ul>
        <h1 class="panel-title">Registrations</h1>
    </div>
@endsection


@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">Registrations</h1>
                <p class="panel-card-description">List of all registrations in the system</p>
            </div>
            <div class="flex gap-5">
                <a href="{{route('admin.view.result.import')}}" class="btn-primary-sm flex items-center justify-center">
                    <span class="lg:block md:block sm:hidden mr-2">Import Result</span>
                    <i data-feather="upload"></i>
                </a>
                <a href="{{route('admin.view.registration.import')}}" class="btn-primary-sm flex items-center justify-center">
                    <span class="lg:block md:block sm:hidden mr-2">Import Excel</span>
                    <i data-feather="upload"></i>
                </a>
                <a href="{{route('admin.handle.registration.excel.download')}}" class="btn-primary-sm flex items-center justify-center">
                    <span class="lg:block md:block sm:hidden mr-2">Download Excel</span>
                    <i data-feather="download"></i>
                </a>
            </div>
            
        </div>
        <div class="panel-card-body">
            <div class="panel-card-table">
                <table class="data-table">
                    <thead>
                        <th>Sr. No.</th>
                        <th>NEET Reg. No</th>
                        <th>Reso Admit No</th>
                        <th>Name</th>
                        <th>Center</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $key => $registration)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $registration->neet_application_no }}</td>
                                <td>{{ $registration->reso_admit_card_no }}</td>
                                <td>{{ $registration->name }}</td>
                                <td>{{ \App\Models\ExaminationCenter::find($registration->examination_center_id)->name }}</td>
                                <td>
                                    <div class="table-dropdown">
                                        <button>Options<i data-feather="chevron-down"
                                                class="ml-1 toggler-icon"></i></button>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a href="{{ route('admin.view.registration.preview', ['id' => $registration->id]) }}"
                                                        class="dropdown-link-primary"><i data-feather="edit"
                                                            class="mr-1"></i> Preview Registration</a></li>
                                                <li><a href="javascript:handleDelete('{{ $registration->id }}');"
                                                        class="dropdown-link-danger"><i data-feather="trash-2"
                                                            class="mr-1"></i> Delete Registration</a></li>
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
        document.getElementById('registration-tab').classList.add('active');

        const handleDelete = (id) => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this registration!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `{{ url('admin/registration/delete') }}/${id}`;
                    }
                });
        }
    </script>
@endsection
