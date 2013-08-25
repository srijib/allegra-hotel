<div class="row">
    <div class="span6 offset3">
        <form action="" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="inputTitle">Title</label>
                <div class="controls">
                    <input type="text" name="inputTitle" value="<?php echo $offering->get('offering_title')?>" class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDescription">Description</label>
                <div class="controls">
                    <textarea name="inputDescription" class="required" disabled><?php echo $offering->get('offering_description')?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputType">Type</label>
                <div class="controls">
                    <input name="inputType" value="<?php echo $offering->get('offering_type')?>"  class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDateTime">Date &amp; Time</label>
                <div class="controls">
                    <div id="datetimepicker1" class="input-append">
                        <input 
                            data-format="dd-MM-yyyy hh:mm:ss" type="text" 
                            class="input-medium required" name="inputDateTime"
                            value="<?php echo $offering->get('offering_time')?>" disabled>
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
                    <input name="inputPrice" value="<?php echo $offering->get('offering_price')?>"  class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputAbbr">Abbreviation</label>
                <div class="controls">
                    <input type="text" name="inputAbbr" value="<?php echo $offering->get('offering_abbr')?>" class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputImgurl">Img URL</label>
                <div class="controls">
                    <input type="text" name="inputImgurl" value="<?php echo $offering->get('offering_img_url')?>" class="required" disabled> 
                </div>
            </div>
            <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" id="editInfo">Edit</button>
                <button class="btn btn-success" id="saveInfo">Save</button>
                <a href="<?php echo base_url('admin/offering/list'); ?>" class="btn">Cancel</a>
            </div>
            <script>
                (function(){
                    var ed = $("#editInfo"), sa = $("#saveInfo");
                    ed.show();sa.hide();
                    ed.on('click', function(event) {
                        event.preventDefault();
                        $("#formEdit input, #formEdit select, #formEdit textarea").removeAttr('disabled');
                        ed.hide();sa.show();
                        $("#formEdit").validate();
                    });
                    sa.on('click', function(event) {
                        event.preventDefault();
                        var postData = $("#formEdit").serialize();
                        $.ajax({
                            url: '<?php echo site_url('/ajax/saveOffering/' . $offering->get('id')); ?>',
                            data: postData,
                            method: 'POST'
                        }).done(function() {
                            $("#formEdit input, #formEdit select, #formEdit textarea")
                                .attr('disabled','disabled')
                                .removeClass('valid');
                            window.location = "<?php echo base_url('admin/offering/list'); ?>";
                        });
                    });
                })();
            </script>
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
