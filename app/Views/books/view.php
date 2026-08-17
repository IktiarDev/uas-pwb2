<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-teal-100/60 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-teal-50 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h3 class="font-bold text-teal-950 text-lg">Detail Buku</h3>
            <p class="text-xs text-slate-500 mt-1">Informasi spesifik mengenai koleksi perpustakaan.</p>
        </div>
        <a href="<?= base_url('books') ?>" class="border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2 rounded-xl transition text-xs font-semibold flex items-center gap-1.5 shadow-sm">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="flex flex-col items-center gap-4">
            <div class="bg-teal-50/50 p-6 rounded-2xl border border-teal-100/40 w-full flex justify-center aspect-[3/4]">
                <img src="<?= $book['cover_image'] ? base_url('uploads/' . $book['cover_image']) : base_url('assets/images/default_cover.png') ?>" 
                    alt="<?= esc($book['title']) ?>" 
                    class="h-full object-contain rounded-xl shadow-lg border border-white">
            </div>
            <span class="inline-flex bg-teal-600/90 text-white text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-xl shadow-sm">
                <?= esc($book['category']) ?>
            </span>
            <div class="w-full bg-teal-50/40 rounded-xl p-3 border border-teal-100/30 flex items-center justify-between text-xs font-semibold">
                <span class="text-teal-800">Status Stok</span>
                <span class="<?= $book['quantity'] > 0 ? 'text-teal-700 bg-teal-100 px-2 py-0.5 rounded-lg' : 'text-red-700 bg-red-100 px-2 py-0.5 rounded-lg' ?>">
                    <?= esc($book['quantity']) ?> Buku Tersedia
                </span>
            </div>
        </div>

        <div class="md:col-span-2 space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-teal-950 leading-tight"><?= esc($book['title']) ?></h1>
                <p class="text-base text-teal-600 font-semibold mt-1">Oleh: <?= esc($book['author']) ?></p>
            </div>

            <div class="grid grid-cols-2 gap-4 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <div>
                    <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400">Penerbit</span>
                    <span class="text-sm font-semibold text-slate-800"><?= esc($book['publisher']) ?></span>
                </div>
                <div>
                    <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400">Tahun Terbit</span>
                    <span class="text-sm font-semibold text-slate-800"><?= esc($book['year_published']) ?></span>
                </div>
                <div>
                    <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400">ISBN</span>
                    <span class="text-sm font-semibold text-slate-800"><?= esc($book['isbn'] ?: '-') ?></span>
                </div>
                <div>
                    <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400">Kategori</span>
                    <span class="text-sm font-semibold text-slate-800"><?= esc($book['category']) ?></span>
                </div>
            </div>

            <div>
                <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-2">Sinopsis Buku</span>
                <div class="text-sm text-slate-600 leading-relaxed bg-white border border-teal-50/80 p-5 rounded-2xl whitespace-pre-line">
                    <?= esc($book['synopsis'] ?: 'Tidak ada sinopsis untuk buku ini.') ?>
                </div>
            </div>

            <?php if (session()->get('role') === 'admin'): ?>
                <div class="flex gap-3 pt-6 border-t border-teal-50 flex-wrap">
                    <a href="<?= base_url('books/edit/' . $book['id']) ?>" class="bg-yellow-500 hover:bg-yellow-400 text-teal-950 font-bold px-6 py-2.5 rounded-xl shadow-md shadow-yellow-500/10 flex items-center gap-2 transition text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span>Edit Buku</span>
                    </a>
                    <a href="<?= base_url('books/delete/' . $book['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-100 font-semibold px-6 py-2.5 rounded-xl transition text-xs flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span>Hapus Buku</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
