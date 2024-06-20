@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.registration.list') }}">Registrations</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.result.import') }}">Import Result</a></li>
        </ul>
        <h1 class="panel-title">Import Result</h1>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.result.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid 2xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-5">

                    {{-- Ecel File --}}
                    <div class="input-group lg:col-span-2 md:col-span-2 sm:col-span-1">
                        <label for="excel_file" class="input-label">Excel File <em>*</em></label>
                        <input type="file" name="excel_file" value="{{ old('excel_file') }}"
                            class="input-box-md @error('excel_file') input-invalid @enderror" required>
                        @error('excel_file')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Records</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('registration-tab').classList.add('active');
    </script>
@endsection
