<!-- resources/views/commodities/create.blade.php -->
<?php if (isset($component)) { $__componentOriginal8a240419d16b3c1a159498153f053ed2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a240419d16b3c1a159498153f053ed2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.main','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dodaj Surowiec</title>
        
        <!-- Link to your custom CSS file -->
        <link rel="stylesheet" href="<?php echo e(asset('css/create.css')); ?>">
    </head>
    <body>
        <h1>Dodaj Nowy Surowiec</h1>

        <!-- Back Link in the Top-Right Corner -->
        <a href="<?php echo e(route('commodities')); ?>" style="position: absolute; top: 20px; right: 1600px">
            <img src="<?php echo e(asset('img/back.png')); ?>" alt="Powrót" style="width: 32px; height: 32px;">
        </a>

        <form action="<?php echo e(route('commodities.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label for="name">Nazwa Surowca:</label>
            <input type="text" id="name" name="name" required>
            <br><br>

            <label for="description">Opis:</label>
            <textarea id="description" name="description" required></textarea>
            <br><br>

            <button type="submit">Zapisz Surowiec</button>
        </form>

        <?php if(session('success')): ?>
            <p><?php echo e(session('success')); ?></p>
        <?php endif; ?>
    </body>
    </html>
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
<?php /**PATH C:\Users\WronM\Documents\resource-presenter\api2\resources\views/components/create.blade.php ENDPATH**/ ?>