<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Eksport danych')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('title', null, []); ?> 
        Eksport Danych
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="<?php echo e(route('export')); ?>" aria-label="Formularz eksportu danych">
                        <?php echo csrf_field(); ?>

                        <div class="mb-4">
                            <label for="format" class="block text-sm font-medium text-gray-700">
                                Wybierz format
                            </label>
                            <select
                                name="format"
                                id="format"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                required
                            >
                                <option value="json">JSON</option>
                                <option value="xml">XML</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                Wybierz dane
                            </label>
                            <select
                                name="type"
                                id="type"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                required
                            >
                                <option value="conflicts">Konflikty</option>
                                <option value="commodities">Surowce</option>
                            </select>
                        </div>

                        <button
                            type="submit"
                            id="exportButton"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            aria-label="Eksportuj dane do wybranego formatu"
                            title="Eksportuj dane"
                            aria-labelledby="exportButton"
                        >
                            Eksportuj
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\WronM\Documents\resource-presenter\api2\resources\views/components/dashboard.blade.php ENDPATH**/ ?>