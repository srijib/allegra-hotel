<div class="container">
<div class="row">
    <div class="span6 offset3">
    <?php
        //var_dump($forms);
    ?>
    <?php foreach ($forms as $form_id=>$form) : ?>
        <form action="<?php echo base_url('admin/option/save'); ?>" class="form-horizontal" id="<?php echo $form_id; ?>" method="post">
            <legend>
                <?php echo $form['legend']; ?>
            </legend>
            <fieldset>
        <?php foreach ($form['fields'] as $field_id=>$field) : ?>
            <div class="control-group">
                <label class="control-label" for="<?php echo $field_id; ?>"><?php echo $field['label']; ?></label>
                <div class="controls">
                <?php
                    switch ($field['type']) :
                        case 'text':
                        case 'textarea':
                ?>
                            <input type="<?php echo $field['type']; ?>" id="<?php echo $field_id; ?>"
                                name="<?php echo $field_id; ?>" value="<?php echo $field['value']; ?>">
                <?php       break;
                        case 'select':
                ?>
                            <select id="<?php echo $field_id; ?>" name="<?php echo $field_id; ?>">
                        <?php
                            foreach ($field['options'] as $opt) :
                        ?>
                                <option value=<?php echo $opt['value']; ?>
                                <?php if ($field['value'] == $opt['value']) echo 'selected="selected"'; ?>
                                ><?php echo $opt['label']; ?></option>
                        <?php
                            endforeach;
                        ?>
                            </select>
                <?php       break;
                        default:
                            break;
                    endswitch;
                ?>
                </div>
            </div>
        <?php endforeach; ?>
            <div class="control-group">
                <div class="controls">
                    <button class="btn btn-primary" name="which_form" value="<?php echo $form_id; ?>">Save</button>
                </div>
            </div>
            </fieldset>
        </form>
    <?php endforeach; ?>
    </div>
</div>
</div>
