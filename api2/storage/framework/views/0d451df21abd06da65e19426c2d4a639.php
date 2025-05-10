<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['styleSheets' => ['css/app.css']]));

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

foreach (array_filter((['styleSheets' => ['css/app.css']]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php if (isset($component)) { $__componentOriginal8a240419d16b3c1a159498153f053ed2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a240419d16b3c1a159498153f053ed2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.main','data' => ['styleSheets' => ['css/style.css', 'https://unpkg.com/leaflet@1.9.3/dist/leaflet.css']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['styleSheets' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['css/style.css', 'https://unpkg.com/leaflet@1.9.3/dist/leaflet.css'])]); ?>
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

    <header class="background-image">
        <h1>Konflikty a Ceny Surowców</h1>
        <p>Analiza wpływu konfliktów na rynki surowców.</p>
        <a href="analizy.html">
            <button>Zobacz</button>
        </a>

    </header>

    <section class="konflikty" id="konflikty">
        <h2>Mapa świata z głównymi konfliktami 2025</h2>
        <div class="map-and-cards">
            <div id="mapa-kontener"></div>

            <div class="card-container">
                <div class="card">
                    <h3>Ukraina</h3>
                    <p>Wojna wpływa na ceny energii, zboża i nawozów.</p>
                </div>
                <div class="card">
                    <h3>Bliski Wschód</h3>
                    <p>Napięcia zwiększają ceny ropy naftowej i gazu.</p>
                </div>
                <div class="card">
                    <h3>Afryka (Sahel)</h3>
                    <p>Konflikty ograniczają wydobycie złota i uranu.</p>
                </div>
                <div class="card">
                    <h3>Ameryka Łacińska</h3>
                    <p>Przemoc karteli wpływa na handel surowcami.</p>
                </div>
                <div class="card">
                    <h3>Azja Południowo-Wschodnia</h3>
                    <p>Niepokoje w regionie zaburzają rynek metali.</p>
                </div>
                <div class="card">
                    <h3>Iran i Zatoka Perska</h3>
                    <p>Napięcia wpływają na ceny ropy i gazu transportowanego cieśniną Ormuz.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="podsumowanie">
        <h2>Jak konflikty wpływają na ceny surowców?</h2>
        <div class="impact-cards">
            <div class="impact-card">
                <img src="img/dostawa.png" alt="Zakłócenie dostaw">
                <h3>Zakłócenie dostaw</h3>
                <p>Konflikty mogą prowadzić do przerwania łańcuchów dostaw i ograniczenia dostępności surowców.</p>
            </div>
            <div class="impact-card">
                <img src="img/wykres.png" alt="Zmienność cen">
                <h3>Zmienność cen</h3>
                <p>Niepewność geopolityczna powoduje wahania cen na światowych rynkach.</p>
            </div>
            <div class="impact-card">
                <img src="img/produkcja.png" alt="Wpływ na produkcję">
                <h3>Wpływ na produkcję</h3>
                <p>Konflikty mogą ograniczać wydobycie i przetwarzanie surowców.</p>
            </div>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="<?php echo e(asset('js/mapa.js')); ?>"></script>
    <script src="<?php echo e(asset('js/faq.js')); ?>"></script>
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
<?php /**PATH C:\Users\WronM\Documents\resource-presenter\api2\resources\views/components/home.blade.php ENDPATH**/ ?>