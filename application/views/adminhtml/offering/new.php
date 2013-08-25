<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('admin/offering/new'); ?>" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
              <input type="text" name="inputTitle" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDescription">Description</label>
            <div class="controls">
              <input type="text" name="inputDescription" class="required">
            </div>
          </div>
            <div class="control-group">
                <label class="control-label" for="inputType">Type</label>
                <div class="controls">
                    <input name="inputType" class="required" >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDateTime">Date &amp; Time</label>
                <div class="controls">
                    <div id="datetimepicker1" class="input-append">
                        <input 
                            data-format="dd-MM-yyyy hh:mm:ss" type="text" 
                            class="input-medium required" name="inputDateTime">
                        </input>
                        <span class="add-on">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </span>
                    </div>
                    <script type="text/javascript">
                        (function() {
                            $('#datetimepicker1').datetimepicker({
                                language: 'pt-BR'
                            });
                        })();
                    </script>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPrice">Price: $</label>
                <div class="controls">
                    <input name="inputPrice" class="required" >
                </div>
            </div>
          <div class="control-group">
            <label class="control-label" for="inputAbbr">Abbreviation</label>
            <div class="controls">
                <input type="text" name="inputAbbr" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputImgurl">Img URL</label>
            <div class="controls">
              <input type="text" name="inputImgurl" class="required">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
                <input type="submit" class="submit btn btn-primary" value="Create">
                <a href="<?php echo base_url('admin/offering/list'); ?>" class="btn">Cancel</a>
            </div>
          </div>      
        </fieldset>
        </form>
        <script>
            jQuery(document).ready(function($){
                $("#formEdit").validate();
            });
        </script>
    </div>
</div>
