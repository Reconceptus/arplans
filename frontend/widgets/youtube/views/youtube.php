<?php /* @var $width */
/* @var $height */
/* @var $autoplay */
/* @var $repeat */
/* @var $controls */
/* @var $showInfo */
?>
<iframe
        width="<?= $width ?>"
        height="<?= $height ?>"
        src="//www.youtube.com/embed/<?= $url ?>?rel=0<?= ($autoplay ? '&autoplay=1' : '') ?><?= $repeat ? '&loop=1&playlist=' . $url : '' ?>&controls=<?= $controls ?>&showinfo=<?= $showInfo ?>"
        frameborder="0">

</iframe>