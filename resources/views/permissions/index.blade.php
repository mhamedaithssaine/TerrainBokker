@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Gestion des Permission</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <a href="{{ route('permissions.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
            <i class="fas fa-plus mr-2"></i>
           Permission
        </a>
        
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
  
      


     @if (count($permissions)>0)
        
   
        <table class="min-w-full divide-y divide-gray-200 mt-6">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($permissions as $permission)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $permission->name }}</td>
                       
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 bg-white border border-blue-300 rounded-md hover:bg-blue-50 transition duration-150 ease-in-out">Modifier</a>
                            
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800 bg-white border border-red-300 rounded-md hover:bg-red-50 transition duration-150 ease-in-out">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else 
        <p class="text-sm text-gray-600">Aucune permission trouvée.</p>
        @endif  
    </div>
    </div>
@endsection