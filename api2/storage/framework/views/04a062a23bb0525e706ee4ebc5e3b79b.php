<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['commodities' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['commodities' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<?= app('\Spatie\BladeJavaScript\Renderer')->render(['commodities' => $commodities]); ?>

<?php if (isset($component)) { $__componentOriginal8a240419d16b3c1a159498153f053ed2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a240419d16b3c1a159498153f053ed2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.main','data' => ['styleSheets' => ['css/table.css']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['styleSheets' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['css/table.css'])]); ?>
    <body>
        <?php if (isset($component)) { $__componentOriginal671ce514c6729ae64125b2aa3fafa408 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal671ce514c6729ae64125b2aa3fafa408 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header-nav','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal671ce514c6729ae64125b2aa3fafa408)): ?>
<?php $attributes = $__attributesOriginal671ce514c6729ae64125b2aa3fafa408; ?>
<?php unset($__attributesOriginal671ce514c6729ae64125b2aa3fafa408); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal671ce514c6729ae64125b2aa3fafa408)): ?>
<?php $component = $__componentOriginal671ce514c6729ae64125b2aa3fafa408; ?>
<?php unset($__componentOriginal671ce514c6729ae64125b2aa3fafa408); ?>
<?php endif; ?>
        <div id="data"></div>

        <h1>Lista surowców</h1>
        <!-- Przycisk z ikonką plusa w prawym górnym rogu -->
        <a href="<?php echo e(route('commodities.create')); ?>" style="position: absolute; top: 80px; right: 650px;">
            <img src="<?php echo e(asset('img/plus.png')); ?>" alt="Dodaj" style="width: 32px; height: 32px;">
        </a>

        <div class="filters">
            <input type="text" id="searchInput" placeholder="Szukaj surowca..." onkeyup="filterResources()">
        </div>

        <!-- Login prompt -->
        <div class="login-prompt" style="display: flex; align-items: center; margin-bottom: 20px;">
            <p style="margin: 0;">Chcesz zaeksportować dane?</p>
            <form action="<?php echo e(route('register')); ?>" method="get" style="margin-left: 12px;">
                <button type="submit" style="padding: 8px 16px; background-color: #5e5437; color: white; border: none; border-radius: 4px;">
                    Zarejestruj się
                </button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody id="resourcesTableBody">
                <!-- Here you can dynamically render resources if needed -->
            </tbody>
        </table>

        <div class="pagination" id="pagination"></div>

        <script src="<?php echo e(asset('js/surowce.js')); ?>"></script>
    </body>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a240419d16b3c1a159498153f053ed2)): ?>
<?php $attributes = $__attributesOriginal8a240419d16b3c1a159498153f053ed2; ?>
<?php unset($__attributesOriginal8a240419d16b3c1a159498153f053ed2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a240419d16b3c1a159498153f053ed2)): ?>
<?php $component = $__componentOriginal8a240419d16b3c1a159498153f053ed2; ?>
<?php unset($__componentOriginal8a240419d16b3c1a159498153f053ed2); ?>
<?php endif; ?>
<?php /**PATH C:\Users\WronM\Documents\resource-presenter\api2\resources\views/components/commodities.blade.php ENDPATH**/ ?>