<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl border border-teal-100/60 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form action="<?= base_url('books') ?>" method="GET" class="w-full md:max-w-md flex items-center gap-2">
            <div class="relative w-full">
                <span id="search-icon" class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" name="search" placeholder="Cari berdasarkan judul, penulis, kategori..." value="<?= esc($search) ?>" autocomplete="off"
                    class="w-full bg-slate-50 border border-teal-100 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition">
            </div>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition text-sm">
                Cari
            </button>
            <?php if ($search): ?>
                <a href="<?= base_url('books') ?>" id="btn-reset" class="border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl transition text-sm">
                    Reset
                </a>
            <?php endif; ?>
        </form>

        <?php if (session()->get('role') === 'admin'): ?>
            <a href="<?= base_url('books/create') ?>" class="bg-yellow-500 hover:bg-yellow-400 text-teal-950 font-bold px-5 py-2.5 rounded-xl shadow-md shadow-yellow-500/10 flex items-center gap-2 transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Buku</span>
            </a>
        <?php endif; ?>
    </div>

    <div id="books-container" class="transition-opacity duration-200">
        <?php if (empty($books)): ?>
            <div class="bg-white rounded-2xl border border-teal-100/60 shadow-sm p-12 text-center">
                <div class="inline-flex bg-teal-50 text-teal-600 p-4 rounded-full mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-teal-950">Tidak Ada Koleksi Buku</h3>
                <p class="text-sm text-slate-500 mt-1">Buku yang Anda cari tidak ditemukan atau data masih kosong.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($books as $book): ?>
                    <div class="bg-white rounded-2xl border border-teal-100/60 shadow-sm overflow-hidden flex flex-col justify-between group hover:shadow-md transition duration-300">
                        <div>
                            <div class="relative aspect-[4/3] bg-teal-900/5 overflow-hidden flex items-center justify-center p-6 border-b border-teal-100/40">
                                <img src="<?= $book['cover_image'] ? base_url('uploads/' . $book['cover_image']) : base_url('assets/images/default_cover.png') ?>" 
                                    alt="<?= esc($book['title']) ?>" 
                                    class="h-full object-contain shadow-md rounded-lg group-hover:scale-105 transition duration-300">
                                <span class="absolute top-3 left-3 bg-teal-600/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg">
                                    <?= esc($book['category']) ?>
                                </span>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-teal-950 text-base leading-snug line-clamp-1 group-hover:text-teal-600 transition">
                                    <?= esc($book['title']) ?>
                                </h3>
                                <p class="text-sm text-slate-500 font-medium mt-1">Oleh: <?= esc($book['author']) ?></p>
                                <div class="flex items-center justify-between text-xs text-slate-400 mt-4 border-t border-teal-50/60 pt-3">
                                    <span>Penerbit: <?= esc($book['publisher']) ?></span>
                                    <span>Tahun: <?= esc($book['year_published']) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 pt-0">
                            <div class="flex items-center justify-between bg-teal-50/50 rounded-xl p-3 mb-4 text-xs font-semibold">
                                <span class="text-teal-800">Stok Tersedia</span>
                                <span class="<?= $book['quantity'] > 0 ? 'text-teal-600 bg-teal-100/60 px-2.5 py-0.5 rounded-lg' : 'text-red-600 bg-red-100/60 px-2.5 py-0.5 rounded-lg' ?>">
                                    <?= esc($book['quantity']) ?> Buku
                                </span>
                            </div>
                            <div class="flex gap-2">
                                <a href="<?= base_url('books/view/' . $book['id']) ?>" class="flex-1 text-center bg-teal-50 hover:bg-teal-100 text-teal-900 border border-teal-100/80 font-semibold py-2 rounded-xl transition text-xs">
                                    Detail
                                </a>
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <a href="<?= base_url('books/edit/' . $book['id']) ?>" class="bg-yellow-500 hover:bg-yellow-400 text-teal-950 p-2 rounded-xl transition shadow-sm flex items-center justify-center shrink-0">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    <a href="<?= base_url('books/delete/' . $book['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-xl transition border border-red-100/80 flex items-center justify-center shrink-0">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?= $pager->links('default', 'tailwind') ?>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const searchForm = searchInput.form;
    const booksContainer = document.getElementById('books-container');
    const searchIcon = document.getElementById('search-icon');
    let debounceTimer;

    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function fetchBooks(url) {
        if (booksContainer) {
            booksContainer.style.opacity = '0.5';
        }
        if (searchIcon) {
            searchIcon.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.getElementById('books-container');
            const newForm = doc.querySelector('form');
            
            if (newContent && booksContainer) {
                booksContainer.innerHTML = newContent.innerHTML;
                booksContainer.style.opacity = '1';
            }

            const resetBtn = document.getElementById('btn-reset');
            const newResetBtn = doc.getElementById('btn-reset');
            
            if (newResetBtn && !resetBtn) {
                searchForm.appendChild(newResetBtn);
            } else if (!newResetBtn && resetBtn) {
                resetBtn.remove();
            }

            if (searchIcon) {
                searchIcon.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                `;
            }

            window.history.pushState(null, '', url);
        })
        .catch(err => {
            console.error('Error fetching books:', err);
            if (booksContainer) booksContainer.style.opacity = '1';
        });
    }

    searchInput.addEventListener('input', debounce(function() {
        const query = encodeURIComponent(searchInput.value);
        const url = `${searchForm.action}?search=${query}`;
        fetchBooks(url);
    }, 300));

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const query = encodeURIComponent(searchInput.value);
        const url = `${searchForm.action}?search=${query}`;
        fetchBooks(url);
    });

    booksContainer.addEventListener('click', function(e) {
        const anchor = e.target.closest('a');
        if (anchor && anchor.href && anchor.href.includes('books')) {
            const urlObj = new URL(anchor.href);
            if (urlObj.searchParams.has('page') || urlObj.searchParams.has('search')) {
                if (!urlObj.pathname.includes('/view/') && !urlObj.pathname.includes('/edit/') && !urlObj.pathname.includes('/delete/')) {
                    e.preventDefault();
                    fetchBooks(anchor.href);
                }
            }
        }
    });
});
</script>
<?= $this->endSection() ?>
