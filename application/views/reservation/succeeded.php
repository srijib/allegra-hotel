<div class="container">
    <div class="row">
        <div class="span12">
            <legend>Thank you</legend>

            <div style="margin-top:50px;margin-bottom:50px;text-align:center">
                <h2>Thanks for booking with Allegra Hotel</h2>
                <p>Click <a href="<?php echo base_url('packagepage'); ?>">here</a> to see more packages we have.</p>
                <p>If you have any question, do not hesitate to contact us.</p>
                
                <h5 style="margin-top:50px;">Would you mind tell us where did you heard about us?</h5>
                <div class="row">
                    <div class="span4 offset4" style="min-height:150px;">
                        <style>
                            .span5 input {
                                margin-bottom: 10px;
                            }
                        </style>
                        <div id="before" style="text-align:left;">
                            <input type="checkbox">I did a search.</input><br/>
                            <input type="checkbox">I heard you guys from my friends/family.</input><br/>
                            <input type="checkbox">From advertisements on TV/street post.</input><br/>
                            <input type="text" placeholder="other..." style="input-small"></input><br/>
                            <button class="btn btn-success">Submit</button>
                        </div>
                        <div id="after" style="text-align:center;display:none;">
                            <p>Thanks very much for your response!</p>
                        </div>
                        <script>
                            (function(){
                                $("#before button").on('click', function(event) {
                                    event.preventDefault();
                                    $('#before').slideUp(function() {
                                        $("#after").slideDown();
                                    });
                                })
                            })();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
