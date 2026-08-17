<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Perpustakaan Buku Digital') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-teal-50 text-slate-800 h-screen flex flex-col md:flex-row overflow-hidden">
    <aside class="w-full md:w-64 bg-gradient-to-b from-teal-800 to-teal-950 text-white flex flex-col justify-between shrink-0 shadow-xl border-r border-teal-900 z-10">
        <div>
            <div class="p-6 border-b border-teal-900/60 flex items-center justify-between">
                <a href="<?= base_url('books') ?>" class="flex items-center gap-3">
                    <div class="bg-yellow-500 text-teal-950 p-2 rounded-xl shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg leading-tight tracking-wide">Pustaka Digital</h1>
                        <span class="text-xs text-teal-300 font-medium">UAS Pemrograman Web 2</span>
                    </div>
                </a>
            </div>
            <nav class="p-4 space-y-1">
                <a href="<?= base_url('books') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-teal-100 hover:bg-teal-700/40 hover:text-white <?= current_url() == base_url('books') ? 'bg-teal-700/50 text-white font-semibold shadow-inner' : '' ?>">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Katalog Buku</span>
                </a>
                <?php if (session()->get('role') === 'admin'): ?>
                    <a href="<?= base_url('books/create') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-teal-100 hover:bg-teal-700/40 hover:text-white <?= current_url() == base_url('books/create') ? 'bg-teal-700/50 text-white font-semibold shadow-inner' : '' ?>">
                        <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Buku</span>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
        <div class="p-4 border-t border-teal-900/60 bg-teal-950/40">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-teal-600 flex items-center justify-center font-bold text-teal-100 border border-teal-400">
                    <?= strtoupper(substr(session()->get('name'), 0, 2)) ?>
                </div>
                <div class="overflow-hidden">
                    <p class="font-medium text-sm truncate"><?= esc(session()->get('name')) ?></p>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded <?= session()->get('role') === 'admin' ? 'bg-yellow-500 text-teal-950' : 'bg-teal-600 text-teal-100' ?>">
                        <?= esc(session()->get('role')) ?>
                    </span>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl border border-teal-700/80 hover:bg-teal-800 text-teal-200 hover:text-white transition text-sm font-medium">
                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white border-b border-teal-100 px-6 flex items-center justify-between shrink-0 shadow-sm z-0">
            <div class="flex items-center gap-4">
                <h2 class="font-bold text-xl text-teal-900"><?= esc($title ?? 'Dashboard') ?></h2>
            </div>
            <div class="text-xs text-slate-500 font-medium">
                <?= date('d M Y') ?>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 rounded-xl bg-teal-500/10 border border-teal-500 text-teal-800 flex items-center gap-3">
                    <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500 text-red-800 flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>
</body>
</html>
