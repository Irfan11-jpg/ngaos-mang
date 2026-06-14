<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-light text-gray-800">Selamat Datang, Guru</h1>
                    <p class="mt-2 text-gray-500">Kelola data santri dan materi pembelajaran di sini.</p>
                </div>
            </div>
            <!-- Form Input -->
<div class="card p-4 mb-4">
    <h3>Input Progres Hafalan</h3>
    <form action="{{ route('hafalan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ID Santri:</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Surah:</label>
            <input type="text" name="surah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ayat:</label>
            <input type="text" name="ayat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Lancar">Lancar</option>
                <option value="Perlu Diulang">Perlu Diulang</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Progres</button>
    </form>
</div>
        </div>
    </div>
</x-app-layout>