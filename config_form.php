<section class="seven columns alpha">
    <div class="field">
        <div class="two columns alpha">
            <label for="cache_dir"><?php echo __('Cache dir'); ?></label>
        </div>
        <div class="inputs five columns omega">
            <?php echo $view->formText(
                'cache_dir',
                $cache_dir,
                [ 'disable' => true ]
            ); ?>
        </div>
    </div>
    <div class="field">
        <div class="two columns alpha">
            <label for="clear_cache"><?php echo __('Clear cache'); ?></label>
        </div>
        <div class="inputs five columns omega">
            <?php echo $view->formCheckbox(
                'clear_cache',
                null,
                array(
                    'id' => 'clear_cache',
                    'checked' => false,
                )
            ); ?>
            <p class="explanation"><?php echo __(
              'When cache is used, it is necessary to clear the cache after '.
              'updating the language files (.mo) on the server for the '.
              'new translations to become immediately available.'
            ); ?></p>
        </div>
    </div>
</section>
