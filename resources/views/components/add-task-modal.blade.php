<div id="addTaskModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Tambah Tugas</h2>
        
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                <input type="text" id="title" name="title" required
                    class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-green-300">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-green-300"></textarea>
            </div>

            <div class="mb-4">
                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                <input type="datetime-local" id="deadline" name="deadline" required
                    class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-green-300">
            </div>

            <div class="mb-4">
                <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas</label>
                <select id="priority" name="priority"
                    class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-green-300">
                    <option value="low">Rendah</option>
                    <option value="medium">Sedang</option>
                    <option value="high">Tinggi</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('addTaskModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addTaskModal').classList.add('hidden');
    }
</script>
