<?php $__env->startSection('title', 'Service'); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<main class="services">
<h1 class="theme-heading">PERSOONLIJKE HULP</h1>
<div class="theme-line"></div>
<section class="video-container">
    <div class="row bg-grey">
        <div class="col-lg-5">
            <div class="tekst">
                <small class="top-caption">Hieronder zie enkele redenen waarom</small>
                <h2 class="orange">mensen besluiten om met mij samen te werken:</h2>
                <ul>
                    <li>
                        <p>Aliquid harum id cumque? Nemo maiores quas, eum optio beatae facilis, expedita commodi tenetur.</p>
                    </li>
                    <li>
                        <p>Esse cum at provident nisi, laboriosam eveniet beatae odit porro. Velit odit voluptate maiores.</p>
                    </li>
                    <li>
                        <p>Iste, id! Iste nesciunt reprehenderit provident dolorum perspiciatis suscipit iusto, voluptates corrupti consectetur quis.</p>
                    </li>
                    <li>
                        <p>Recusandae consequuntur alias, quis minus officiis officia distinctio maiores totam, voluptatibus architecto nihil eos.</p>
                    </li>
                    <li>
                        <p>Itaque doloremque expedita veritatis perferendis animi culpa et ea aliquid alias ipsam! Deserunt, cumque?</p>
                    </li>
                    <li>
                        <p>Beatae nisi doloribus ipsa, dolor veniam saepe aliquid, quasi recusandae, accusamus neque similique quisquam!</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="video-playable">
                <img src="images/home-img.png" alt="" class="vid">
                <iframe class="vid yt" src="https://www.youtube.com/embed/dy2UQofvwH8" frameborder="0" allowfullscreen></iframe>
                <div class="btn-overlay">
                    <button class="btn-play" onclick="playServiceVideo();">watch now</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="card-container">
   <?php if(count($packages)==0): ?>
    <h3 class="text-center">Sorry! We did not have any package yet. For join, Kindly contact at our place.</h3>
   <?php endif; ?>
    <?php $i=0; foreach ($packages as $p) { ?>
    <div class="service-card<?php if ($i == 1) {
                echo " selected";
            }
?>" data-aos="<?php if ($i == 0) {
        echo "fade-left";
}if ($i == 1) {
    echo "zoom-in";
}if ($i == 2) {
    echo "fade-right";
}
?>" style="margin-bottom:30px;">
    <a href="/<?php echo $p->slug; ?>/service" style="text-decoration:none;">
        <div class="service-card-header">
            <p><?php echo Ucwords($p->service); ?></p>
        </div>
        <div class="service-card-subheader">
            <p class="price">€ <?php echo $p->Start_fee; ?>,-<span>/<?php $time = $p->days;
            echo $time; ?> days</span></p>
            <small style="color:#616161;">Incl. BTW</small>
        </div>
        <div class="service-card-body">
            <ul>
            <?php $string = explode('.', $p->sdescription);
            foreach ($string as $ps) { ?>
                <li style="color:#616161;"><?php echo $ps; ?></li>
            <?php } ?>
            </ul>
        </div>
        <div class="service-card-footer">
            <div class="button-container" style="text-align: center;">
                <a href="<?php echo e($is_company?'/org/'.$company_data['slug']:''); ?>/signup/<?php echo $p->id; ?>" class="theme-btn">REGISTER WITH THIS PACKAGE</a>
            </div>
        </div>    
    </a>
    </div>
        <?php $i++;
        if ($i == 3) {
            $i = 0;
        }
    } ?>
</section>
<section class="service-contact ">
    <div class="row ">
        <div class="col-lg-4 contact-image ">
            <img src="images/ipd.png " alt=" ">
        </div>
        <div class="col-lg-8 contact-text">
            <small class="heading-caption ">Laten we</small>
            <h1>kennismaken</h1>
            <p>Als je een online coaching dienst afneemt is het belangrijk om elkaar écht te leren kennen. Daarom adviseer ik je alvorens je start een intakegesprek in te plannen. Dit gesprek is kosteloos en zal in mijn praktijk, via skype of telefonisch plaatsvinden. We zullen hier spreken over je doelstelling, huidige situatie en waarom je nog niet bij je doel bent. Hierbij zal ik je een eerlijk advies geven of ik je kan helpen met het realiseren van je doelen. </p>
            <button class="theme-btn ">Vraag intake aan!</button>
        </div>
    </div>
</section>
<!-- ./contact -->
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>