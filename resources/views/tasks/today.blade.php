@extends('layout')

@section('content')


<script>
    document.getElementById('dropdownUserButton').addEventListener('click', function() {
        document.getElementById('dropdownUser').classList.toggle('hidden');
    });
</script>

<div class="grid grid-cols-4 gap-4 p-4">
    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-blue-500">
        <div class="p-3 rounded-full bg-blue-100 mr-4">
            <i class="fas fa-tasks text-blue-500 text-xl"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Total Tugas</div>
            <div class="text-2xl font-bold">3</div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-yellow-500">
        <div class="p-3 rounded-full bg-yellow-100 mr-4">
            <i class="fas fa-hourglass-half text-yellow-500 text-xl"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Pending</div>
            <div class="text-2xl font-bold">1</div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-green-500">
        <div class="p-3 rounded-full bg-green-100 mr-4">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Selesai</div>
            <div class="text-2xl font-bold">2</div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-red-500">
        <div class="p-3 rounded-full bg-red-100 mr-4">
            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Penting</div>
            <div class="text-2xl font-bold">1</div>
        </div>
    </div>
</div>

<div class="p-4">
    <label for="search" class="block text-gray-700 font-medium">Cari Tugas:</label>
    <input type="text" id="search" placeholder="Cari tugas..." class="w-full p-2 border rounded-lg mt-1">
</div>

<div class="p-4">
    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
        <div class="bg-blue-500 h-2.5 rounded-full" style="width: 66%;"></div>
    </div>
</div>

<div class="p-4">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-3 px-4 text-left">Selesai</th>
                <th class="py-3 px-4 text-left">Tugas</th>
                <th class="py-3 px-4 text-left">Waktu</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-50 border-b">
                <td class="py-3 px-4">
                    <input type="checkbox" checked class="h-5 w-5 text-blue-600 rounded border-gray-300">
                </td>
                <td class="py-3 px-4 font-medium">Menyapu lantai</td>
                <td class="py-3 px-4 text-gray-500">23:00 - 00:00</td>
                <td class="py-3 px-4">
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Selesai</span>
                </td>
                <td class="py-3 px-4">
                    <div class="flex space-x-2">
                        <button class="text-gray-400 hover:text-yellow-500">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-gray-400 hover:text-red-500">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr class="hover:bg-gray-50 border-b">
                <td class="py-3 px-4">
                    <input type="checkbox" class="h-5 w-5 text-blue-600 rounded border-gray-300">
                </td>
                <td class="py-3 px-4 font-medium">Mengerjakan PR</td>
                <td class="py-3 px-4 text-gray-500">20:00 - 21:00</td>
                <td class="py-3 px-4">
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                </td>
                <td class="py-3 px-4">
                    <div class="flex space-x-2">
                        <button class="text-gray-400 hover:text-yellow-500">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-gray-400 hover:text-red-500">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="p-4 flex justify-end">
    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Tambah Tugas</button>
</div>

@endsection
