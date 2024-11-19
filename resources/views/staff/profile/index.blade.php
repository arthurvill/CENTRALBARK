@extends('layouts.staff.app')

@section('title', 'Manage Profile')

@section('content')
    <div class="container-fluid mt-0 mt-md-4">
        <div class="row justify-content-center align-items-center">
            <form action="{{ route('profile.update', auth()->id()) }}" method="POST" enctype="multipart/form-data"
                class="col-md-5 mx-auto bg-white p-5 rounded" id="profile_form">
                @csrf
                @method('PUT')

                <img src="{{ handleNullAvatar(auth()->user()->avatar_profile) }}" class="custom-avatar d-block mx-auto"
                    width='130' alt="avatar.svg">
                <br>

                @include('layouts.includes.alert')

                <div class="form-group mb-2">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" placeholder="Enter your name">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" placeholder="Enter your email">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="old" placeholder="Enter your current password">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter a new password">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your new password">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">Avatar</label>
                    <input type="file" name="avatar" id="user_image">
                </div>

                <button type="submit" class="btn btn-primary form-control">Update Profile</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        initiateFilePond('#user_image', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Drag & Drop or <span class="filepond--label-action"> Browse Avatar</span>');
    </script>
@endsection
