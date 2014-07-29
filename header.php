<?php
$menu = array(
    array('url'=> 'home.html', 'label' => 'Home'),
    array('url'=> 'profilo.html', 'label' => 'Profilo'),
    array('url'=> 'servizi.html', 'label' => 'Servizi'),
//array('url'=> 'identity.html', 'label' => 'Identity'),
    array('url'=> 'clienti.html', 'label' => 'Clienti'),
    array('url'=> 'blog.html', 'label' => 'Blog'),
    array('url'=> 'contatti.html', 'label' => 'Contatti')
);
?>
<header>
    <div class="container">
        <hgroup id="brand" class="left">
            <a href="#" title="I-factory | Internet Solutions">
                <h1>I-factory</h1>
                <h2>Internet Solutions</h2>
                <img src="images/logo_ifactory.png" alt="I-factory | Internet Solutions" />
            </a>
        </hgroup>
        <div id="btn-responsive-menu" class="right"></div>
        <?php include('social.php')?>
        <div class="clr"></div>
        <nav id="main-nav">
            <ul>
                <?php
                foreach($menu AS $item){
                    if($item['url'] == $pagina)
                        echo '<li><a href="'.$item['url'].'" class="sel">'.$item['label'].'</a></li>';
                    else
                        echo '<li><a href="'.$item['url'].'">'.$item['label'].'</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>