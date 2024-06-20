@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.registration.list') }}">Registrations</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.registration.preview', ['id' => $registration->id]) }}">Preview Registration</a></li>
        </ul>
        <h1 class="panel-title">Preview Registration</h1>
    </div>
@endsection

@section('panel-body')
    <figure class="panel-card">
        <div class="panel-card-header">
            <div>
                <h1 class="panel-card-title">Registration Information</h1>
                <p class="panel-card-description">Please check all the information</p>
            </div>
            <div>
                <button type="button" class="btn-danger-sm flex items-center justify-center" onclick="handleDelete()">
                    <span class="lg:block md:block sm:hidden mr-2">Delete</span>
                    <i data-feather="trash"></i>
                </button>
            </div>
        </div>
        <div class="panel-card-body">

            <div class="space-y-5">
                <div>
                    <h1 class="title">General Information</h1>
                </div>
                <div>
                    <table class="font-medium text-sm">
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400">Name</td>
                            <td class="pr-7 pb-3">{{ $registration->name }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400">NEET Application No</td>
                            <td class="pr-7 pb-3">{{ $registration->neet_application_no }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400">Reson Admit Card No</td>
                            <td class="pr-7 pb-3">{{ $registration->reso_admit_card_no }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400">Father Name</td>
                            <td class="pr-7 pb-3">{{ $registration->father_name }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400">Date of Birth</td>
                            <td class="pr-7 pb-3">{{ date('d-m-Y',strtotime($registration->date_of_birth)) }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400 align-top">Gender</td>
                            <td class="pr-7 pb-3">{{ $registration->gender }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400 align-top">Email Address</td>
                            <td class="pr-7 pb-3">{{ $registration->email }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400 align-top">NEET Registred Phone</td>
                            <td class="pr-7 pb-3">{{ $registration->neet_reg_phone }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400 align-top">Alternate Phone</td>
                            <td class="pr-7 pb-3">{{ $registration->alternate_phone }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400 align-top">Center</td>
                            <td class="pr-7 pb-3">{{ \App\Models\ExaminationCenter::find($registration->examination_center_id)->name }}</td>
                        </tr>
                        <tr>
                            <td class="pr-7 pb-3 text-gray-400">Registration Date</td>
                            <td class="pr-7 pb-3">{{ date('D d M Y', strtotime($registration->created_at)) }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>
            

        </div>
    </figure>
@endsection

@section('panel-script')
<script>
    document.getElementById('registration-tab').classList.add('active');

    const handleDelete = () => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this registration!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            "{{ route('admin.handle.registration.delete', ['id' => $registration->id]) }}";
                    }
                });
        }
</script>
@endsection