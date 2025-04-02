@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Liste des Utilisateurs</h1>
    
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Utilisateurs</h2>
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                <i class="fas fa-plus mr-2"></i>
                Ajouter un utilisateur
            </a>
        </div>
        <div class="p-4">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if (count($users) > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                         @if($user->profile_photo) 
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full mr-3">
                                        @else 
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                                <span class="text-gray-500 font-medium">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->email }}
                                </td>
                              
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @foreach($user->roles as $role)
                                                <span>{{ $role->name }}</span>
                                            @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('users.show', $user->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-600 hover:text-yellow-800 bg-white border border-yellow-300 rounded-md hover:bg-yellow-50 transition duration-150 ease-in-out">Voir</a>

                                    <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 bg-white border border-blue-300 rounded-md hover:bg-blue-50 transition duration-150 ease-in-out">Modifier</a>
                            
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800 bg-white border border-red-300 rounded-md hover:bg-red-50 transition duration-150 ease-in-out">Supprimer</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <form action="{{ route('users.update-role', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" 
                                                onchange="this.form.submit()" 
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md">
                                            @foreach(App\Models\Role::all() as $role)
                                                <option value="{{ $role->name }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
              
            @else
                <p class="text-sm text-gray-600">Aucun utilisateur trouvé.</p>
            @endif
        </div>
    </div>
@endsection