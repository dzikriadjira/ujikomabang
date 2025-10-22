@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-400 to-blue-600 px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Profil Admin</h2>
        </div>
        
        <!-- Profile Content -->
        <div class="p-6">
            <div class="flex items-center space-x-6 mb-6">
                <div class="flex-shrink-0">
                    <div class="h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="text-3xl text-blue-600">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600">Administrator</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="border-t border-gray-200 pt-4">
                    <h4 class="text-lg font-medium text-gray-700 mb-3">Informasi Akun</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="font-medium">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Username</p>
                            <p class="font-medium">{{ $user->username ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Bergabung Pada</p>
                            <p class="font-medium">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-end">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Kembali ke Dashboard
                        </a>
                        <a href="#" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
