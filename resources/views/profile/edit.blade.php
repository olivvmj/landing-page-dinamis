@extends('admin.layouts.main')

@section('title_content', 'Kelola Akun Admin')

@section('page_title', 'Profil Admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            Home
        </li>
        <li class="breadcrumb-item active">
            Kelola Akun Admin
        </li>
    </ol>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mx-1 my-3">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="mx-1 my-3">
                @include('profile.partials.update-password-form')
            </div>

            <div class="mx-1 my-3">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
