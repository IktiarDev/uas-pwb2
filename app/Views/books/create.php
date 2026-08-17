<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-teal-100/60 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-teal-50">
        <h3 class="font-bold text-teal-950 text-lg">Form Tambah Buku Baru</h3>
        <p class="text-xs text-slate-500 mt-1">Masukkan informasi detail buku di bawah ini.</p>
    </div>

    <?php $validation = session('validation'); ?>

    <form action="<?= base_url('books/store') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="title" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Judul Buku</label>
                <input type="text" name="title" id="title" value="<?= old('title') ?>" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                <?php if ($validation && $validation->hasError('title')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('title') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="author" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Penulis</label>
                <input type="text" name="author" id="author" value="<?= old('author') ?>" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                <?php if ($validation && $validation->hasError('author')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('author') ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label for="publisher" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Penerbit</label>
                <input type="text" name="publisher" id="publisher" value="<?= old('publisher') ?>" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                <?php if ($validation && $validation->hasError('publisher')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('publisher') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="year_published" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Tahun Terbit</label>
                <input type="number" name="year_published" id="year_published" value="<?= old('year_published') ?>" min="1800" max="<?= date('Y') ?>" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                <?php if ($validation && $validation->hasError('year_published')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('year_published') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="isbn" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="<?= old('isbn') ?>" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                <?php if ($validation && $validation->hasError('isbn')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('isbn') ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="md:col-span-2">
                <label for="category" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Kategori</label>
                <select name="category" id="category" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Novel" <?= old('category') === 'Novel' ? 'selected' : '' ?>>Novel</option>
                    <option value="Sejarah" <?= old('category') === 'Sejarah' ? 'selected' : '' ?>>Sejarah</option>
                    <option value="Sains" <?= old('category') === 'Sains' ? 'selected' : '' ?>>Sains</option>
                    <option value="Teknologi" <?= old('category') === 'Teknologi' ? 'selected' : '' ?>>Teknologi</option>
                    <option value="Sastra" <?= old('category') === 'Sastra' ? 'selected' : '' ?>>Sastra</option>
                    <option value="Self Improvement" <?= old('category') === 'Self Improvement' ? 'selected' : '' ?>>Self Improvement</option>
                </select>
                <?php if ($validation && $validation->hasError('category')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('category') ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="quantity" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Stok / Jumlah</label>
                <input type="number" name="quantity" id="quantity" value="<?= old('quantity', 1) ?>" min="0" required
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
                <?php if ($validation && $validation->hasError('quantity')): ?>
                    <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('quantity') ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <label for="cover_image" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Cover Buku (Gambar)</label>
            <input type="file" name="cover_image" id="cover_image" accept="image/*"
                class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition cursor-pointer">
            <?php if ($validation && $validation->hasError('cover_image')): ?>
                <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('cover_image') ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="synopsis" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-2">Sinopsis</label>
            <textarea name="synopsis" id="synopsis" rows="4"
                class="w-full bg-slate-50 border border-teal-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition"><?= old('synopsis') ?></textarea>
            <?php if ($validation && $validation->hasError('synopsis')): ?>
                <p class="text-xs text-red-500 font-medium mt-1"><?= $validation->getError('synopsis') ?></p>
            <?php endif; ?>
        </div>

        <div class="flex gap-3 pt-4 border-t border-teal-50">
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-md transition text-sm">
                Simpan Buku
            </button>
            <a href="<?= base_url('books') ?>" class="border border-slate-200 text-slate-600 hover:bg-slate-50 px-6 py-2.5 rounded-xl transition text-sm">
                Batal
            </a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
