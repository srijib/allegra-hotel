<div class="container">
    <div class="row">
        <div class="span12">

            <?php
                $i = 1;
                foreach ($allmeta as $type => $metas) :
                    if ($i % 2 === 1) echo '<div class="row">';
            ?>
                <div class="span6">
                    <h4><?php echo ucwords($type); ?> Attributes Description</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Key</th>
                                <th>Label</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                        foreach ($metas as $key => $meta) :
            ?>
                            <tr>
                                <td><?php echo $key; ?></td>
                                <td><?php echo $meta[0]; ?></td>
                                <td><?php echo $meta[1]; ?></td>
                                <td><a href="<?php echo base_url("admin/meta/edit/$meta[0]"); ?>">Edit</a></td>
                            </tr>
            <?php
                        endforeach
            ?>
                        </tbody>
                    </table>
                </div>
            <?php
                    if ($i++ % 2 === 0) echo '</div>';
                endforeach
            ?>
        </div>
    </div>
</div>
