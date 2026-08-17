
<nav class="flex items-center justify-between border-t border-teal-100/60 pt-4 mt-6">
    <div class="flex flex-1 justify-between sm:hidden">
        <?php if ($pager->hasPrevious()) : ?>
            <a href="<?= $pager->getPrevious() ?>" class="relative inline-flex items-center rounded-xl bg-white px-4 py-2 text-sm font-medium text-teal-700 border border-teal-200 hover:bg-teal-50">
                Sebelumnya
            </a>
        <?php endif ?>
        <?php if ($pager->hasNext()) : ?>
            <a href="<?= $pager->getNext() ?>" class="relative ml-3 inline-flex items-center rounded-xl bg-white px-4 py-2 text-sm font-medium text-teal-700 border border-teal-200 hover:bg-teal-50">
                Berikutnya
            </a>
        <?php endif ?>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-teal-800/80">
                Halaman <span class="font-semibold text-teal-900"><?= $pager->getCurrentPageNumber() ?></span> dari <span class="font-semibold text-teal-900"><?= $pager->getPageCount() ?></span>
            </p>
        </div>
        <div>
            <span class="isolate inline-flex gap-1.5">
                <?php if ($pager->hasPrevious()) : ?>
                    <a href="<?= $pager->getFirst() ?>" class="inline-flex items-center rounded-xl bg-white px-3 py-2 text-xs font-semibold text-teal-700 border border-teal-200 hover:bg-teal-50 transition">
                        Pertama
                    </a>
                    <a href="<?= $pager->getPrevious() ?>" class="inline-flex items-center rounded-xl bg-white px-3 py-2 text-xs font-semibold text-teal-700 border border-teal-200 hover:bg-teal-50 transition">
                        Sebelumnya
                    </a>
                <?php endif ?>

                <?php foreach ($pager->links() as $link) : ?>
                    <a href="<?= $link['uri'] ?>" class="inline-flex items-center rounded-xl px-3.5 py-2 text-xs font-semibold <?= $link['active'] ? 'bg-teal-600 text-white shadow-md shadow-teal-600/20' : 'bg-white text-teal-700 border border-teal-200 hover:bg-teal-50 transition' ?>">
                        <?= $link['title'] ?>
                    </a>
                <?php endforeach ?>

                <?php if ($pager->hasNext()) : ?>
                    <a href="<?= $pager->getNext() ?>" class="inline-flex items-center rounded-xl bg-white px-3 py-2 text-xs font-semibold text-teal-700 border border-teal-200 hover:bg-teal-50 transition">
                        Berikutnya
                    </a>
                    <a href="<?= $pager->getLast() ?>" class="inline-flex items-center rounded-xl bg-white px-3 py-2 text-xs font-semibold text-teal-700 border border-teal-200 hover:bg-teal-50 transition">
                        Terakhir
                    </a>
                <?php endif ?>
            </span>
        </div>
    </div>
</nav>
