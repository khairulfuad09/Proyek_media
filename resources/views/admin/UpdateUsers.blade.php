@extends('template.main')
@section('container')

<div class="p-6">

    <h1 class="text-2xl font-bold text-white mb-6">Manajemen User</h1>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="bg-green-100 text-green-600 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- ERROR -->
    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-4">User dengan Role Unknown</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @if($Users->isEmpty())
                    <p class="text-gray-500">Tidak ada user baru</p>
                @endif
                @foreach($Users as $user)
                <tr class="border-b hover:bg-gray-100">

                    <td class="py-2">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-sm">
                                Unknown
                            </span>
                    </td>
                    <td>
                        <form method="post" action="/admin/update-users/{{ $user->id }}" class="flex gap-2">
                            @csrf

                            <select name="role" class="border p-1 rounded">
                                <option value="siswa">Siswa</option>
                                @can('admin')
                                <option value="guru">Guru</option>
                                @endcan
                            </select>
                            
                            <button class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700" onclick="return confirm('Yakin ingin mengubah role?')">
                                Setujui
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection