<div  <?php echo $attributes; ?>><div class="da-tree"></div></div>

<script require="@jstree">
    var opts = <?php echo admin_javascript_json($options); ?>, $tree = $('#<?php echo e($id, false); ?>').find('.da-tree');

    opts.core.data = <?php echo json_encode($nodes); ?>;

    $tree.on("loaded.jstree", function () {
        $tree.jstree('open_all');
    }).jstree(opts);
</script><?php /**PATH /www/wwwroot/ek.zzfw.xyz/vendor/dcat/laravel-admin/src/../resources/views/widgets/tree.blade.php ENDPATH**/ ?>