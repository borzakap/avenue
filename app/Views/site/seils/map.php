<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <div id="map-canvas" style="position: relative; overflow: hidden;"></div>
            <script>
                var markers = [
                    <?php foreach ($items as $item) : ?>
                        ['<?= $item->title?>', 'img.png', '<?= $item->type ?>', '<?= $item->latitude ?>', '<?= $item->longitude ?>'],
                    <?php endforeach; ?>
                ];
            </script>
        </div><!-- container -->
    </div><!-- section -->
</section>