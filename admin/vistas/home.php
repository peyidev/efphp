
<div class="admin-generic">
    <h1 class="title-general">HOME</h1>
    <section id="main_content">

        <div class="admin-left-column-50">
            <a href="?s=building-vista" class="btn btn-default btn-block">Admin buildings</a>
            <a href="?s=mail-admin" class="btn btn-default btn-block">Recent contact/info messages</a>
            <a href="?s=log-admin" class="btn btn-default btn-block">Recent admin activity</a>
        </div>

        <div class="admin-right-column-50">
            <?php
                $m = new Mhmproperties('home');
                $buildings = $m->getBuildingResume();
            ?>
        </div>
    </section>
</div>