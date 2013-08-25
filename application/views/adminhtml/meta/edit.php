<div class="container">
    <div class="row">
        <div class="span12">
            <?php
                $n = false;
                ($operation === 'new') ? $n = true : $n = false;
            ?>
            <form class="form-horizontal" action="<?php echo base_url('admin/meta/save'); ?>" method="post">
                <legend><?php echo ($n) ? 'Create New' : 'Edit'; ?> Meta</legend>
                <?php if (!$n) : ?>
                <div class="control-group">
                    <label class="control-label" for="meta_id">Meta ID</label>
                    <div class="controls">
                        <input type="text" id="meta_id" name="meta_id" readonly="true"
                        value="<?php if (!$n) echo $meta->get('id'); ?>">
                    </div>
                </div>
                <?php endif ?>
                <div class="control-group">
                    <label class="control-label" for="meta_key">Meta Key</label>
                    <div class="controls">
                        <?php
                            if (!$n) {
                                $exploder = explode("_", $meta->get('key'));
                                unset($exploder[0]);
                                $meta_key = implode("_", $exploder);
                            }
                        ?>
                        <?php echo $meta_type; ?>_&nbsp;<input type="text" id="meta_key" name="meta_key" value="<?php if
                        (isset($meta_key)) echo $meta_key; ?>"
                        class="input-small required" 
                        <?php
                            if (!$n || (isset($meta) && $meta->get('system')))
                                echo 'readonly="true"';
                        ?>>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="meta_label">Meta Label</label>
                    <div class="controls">
                        <input type="text" id="meta_label" name="meta_label" value="<?php if (!$n) echo $meta->get('label'); ?>"
                        class="required">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="meta_datatype">Meta Datatype</label>
                    <div class="controls">
                        <input type="text" id="meta_datatype" name="meta_datatype" value="<?php if (!$n) echo
                        $meta->get('datatype'); ?>" <?php if (!$n && $meta->get('system')) echo 'readonly="true"'?>
                        class="required">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox" for="meta_required">
                            <input type="checkbox" id="meta_required" name="meta_required"
                            <?php if (!$n && $meta->get('required')) echo 'checked="checked"'; ?>
                            <?php if (!$n && $meta->get('system')) echo 'readonly="true"'?>> Meta Required
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="hidden" value="<?php echo $meta_type; ?>" name="meta_type">
                        <button type="submit" name="opt" class="btn btn-primary" value="save">Save</button>
                        <a class="btn" href="<?php echo base_url('admin/meta'); ?>">Cancel</a>
                        <?php if (!$n && !$meta->get('system')) : ?>
                            <button type="submit" name="opt" class="btn btn-warning" value="delete">Delete</button>
                        <?php endif ?>
                    </div>
                </div>
            </form>
            <script>
            jQuery(document).ready(function($){
                $("form").validate();
            });
            </script>
        </div>
    </div>
</div>
