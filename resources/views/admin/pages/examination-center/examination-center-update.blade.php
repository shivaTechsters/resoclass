@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.examination.center.list') }}">Examination Centers</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.examination.center.update', ['id' => $examination_center->id]) }}">Edit Examination Center</a></li>
        </ul>
        <h1 class="panel-title">Edit Examination Center</h1>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.examination.center.update', ['id' => $examination_center->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Edit Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
                <div>
                    <button type="button" class="btn-danger-sm flex items-center justify-center" onclick="handleDelete()">
                        <span class="lg:block md:block sm:hidden mr-2">Delete</span>
                        <i data-feather="trash"></i>
                    </button>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid 2xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-5">

                    {{-- Name --}}
                    <div class="input-group lg:col-span-2 md:col-span-2 sm:col-span-1">
                        <label for="name" class="input-label">Name <em>*</em></label>
                        <input type="text" name="name" value="{{ old('name', $examination_center->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter Name"
                            minlength="1" maxlength="250" required>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Google Maps Link --}}
                    <div class="input-group lg:col-span-2 md:col-span-2 sm:col-span-1">
                        <label for="google_maps_link" class="input-label">Google Maps Link <em>*</em></label>
                        <input type="url" name="google_maps_link" value="{{ old('google_maps_link', $examination_center->google_maps_link) }}"
                            class="input-box-md @error('google_maps_link') input-invalid @enderror" placeholder="Enter Google Maps Link"
                            minlength="1" maxlength="1000" required>
                        @error('google_maps_link')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    {{-- Address --}}
                    <div class="input-group lg:col-span-4 md:col-span-4 sm:col-span-1">
                        <label for="address" class="input-label">Address <em>*</em></label>
                        <textarea name="address" class="input-box-md @error('address') input-invalid @enderror" placeholder="Enter Address" rows="10" required>{{ old('address', $examination_center->address) }}</textarea>
                        @error('address')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('examination-center-tab').classList.add('active');

        const handleDelete = () => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this center!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            "{{ route('admin.handle.examination.center.delete', ['id' => $examination_center->id]) }}";
                    }
                });
        }
    </script>
@endsection