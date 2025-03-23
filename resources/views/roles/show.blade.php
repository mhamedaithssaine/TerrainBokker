@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Détails du Rôle</h1>
            <a href="{{ route('roles.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <i class="ri-arrow-left-line mr-2"></i>
                Retour
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="space-y-8">
                <!-- Nom du rôle -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Nom du Rôle</label>
                    <p class="text-xl font-semibold text-gray-800">{{ $role->name }}</p>
                </div>

                <!-- Permissions -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-3">Permissions</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($role->permissions as $permission)
                            <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-sm px-4 py-2 rounded-full shadow-sm hover:shadow-md transition-shadow duration-300">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-3">Utilisateurs avec ce Rôle</label>
                    <div class="overflow-x-auto rounded-lg shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Date d'Attribution</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($role->users as $user)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $user->pivot->created_at ? $user->pivot->created_at->format('d/m/Y H:i') : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection