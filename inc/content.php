    <!-- Content -->
    <section class="container main-load">
        <article class="post_article" itemscope itemtype="https://schema.org/Article">
        <?php $this->content(); ?>
        </article>
        
        <nav class="nearbypost">
            <div class="alignleft"><?php $this->thePrev('%s','No more'); ?></div>
            <div class="alignright"><?php $this->theNext('%s','No more'); ?></div>
        </nav>
    </section>