<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Perpustakaan Buku Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-teal-900 via-teal-800 to-teal-950 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-2xl text-white">
        <div class="text-center mb-8">
            <div class="inline-flex bg-yellow-500 text-teal-950 p-3.5 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight">Perpustakaan Digital</h1>
            <p class="text-teal-200 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 p-3 bg-teal-500/20 border border-teal-500/40 rounded-xl text-teal-200 text-xs font-medium">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500/40 rounded-xl text-red-200 text-xs font-medium">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label for="username" class="block text-xs font-semibold text-teal-200 uppercase tracking-wider mb-2">Username</label>
                <input type="text" name="username" id="username" value="<?= old('username') ?>" required
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3.5 text-white placeholder-teal-300/40 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
            </div>
            <div>
                <label for="password" class="block text-xs font-semibold text-teal-200 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3.5 text-white placeholder-teal-300/40 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
            </div>
            <button type="submit"
                class="w-full bg-yellow-500 text-teal-950 font-bold py-3.5 px-4 rounded-2xl shadow-lg hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-teal-900 transition mt-6 text-sm">
                Masuk
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-white/10 text-center text-xs text-teal-300/60">
            <p>Admin: admin / admin123</p>
            <p class="mt-1">Member: member / member123</p>
        </div>
    </div>
</body>
</html>
