<style>
    #res-cart .dl-horizontal dt {
        width: 90px;
    }
    #res-cart .dl-horizontal dd {
        margin-left: 100px;
    }
</style>
<div id="res-root" class="container">
    <div id="res-top" class="row">
        <div class="span7" style="margin: 0 auto;float:none;">
            <input type="hidden" id="roomString" name="roomString" value="<?php echo $room_string; ?>">
            <input type="hidden" id="offeringString" name="offeringString" value="">
            <ul class="nav nav-pills" style="margin: 10px 0;">
                <li><a href="#">1.Select Room</a></li>
                <li><a href="#">2.Select Offering</a></li>
                <li><a href="#">3.Complete Information</a></li>
                <li><a href="#">4.Confirm Order</a></li>
            </ul>
        </div>
    </div>
    <div id="res-content" class="row">
        <div id="res-sidebar" class="span3">
            <div class="row">
                <div class="span3" id="res-cart">
                    Loading...
                </div>
            </div>
        </div>
        <div class="span9">
            <div id="res-main" class="row">
                Loading...
            </div>
        </div>
    </div>
    <div id="res-bottom" class="row">
        <div id="res-ctrl" class="span12" style="text-align:center;margin:20px 0">
            <span id="btn-next" class="btn btn-large btn-primary">Choose Package</span>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($){

    switchPage(1); 

    $(document).on('click', 'span[data-opt="add_roomtype"]', function() {
        $('span[data-opt="add_roomtype"]').addClass('disabled');
        var id = $(this).data("id"),
            _this = $(this);
        $.ajax({
            url: "<?php echo base_url('res/ajax/add_roomtype'); ?>/"+id,
            method: 'GET',
        }).done(function(data) {
            $('span[data-opt="add_roomtype"]').removeClass('disabled');
            _this.addClass('disabled');
            $('span[data-opt="add_roomtype"]').text('Book');
            _this.text("Selected");
            updateAll();
        });
    });

    $(document).on('click', 'span[data-opt="remove_roomtype"]',function() {
        var _this = $(this);
        _this.addClass('disabled');
        $.ajax({
            url: "<?php echo base_url('res/ajax/remove_roomtype'); ?>",
            method: 'GET',
        }).done(function(data) {
            $('span[data-opt="add_roomtype"]').removeClass('disabled').text("Book");
            switchPage(1);
            updateAll();
        });
    });

    $(document).on('click', 'span[data-opt="add_offering"]', function() {

        $('span[data-opt="add_offering"]').addClass('disabled');
        var id = $(this).data("id"),
            no = $(this).siblings("select").val(),
            _this = $(this);

        $.ajax({
            url: "<?php echo base_url('res/ajax/add_offering'); ?>/"+id+"/"+no,
            method: 'GET',
        }).done(function(data) {
            $('span[data-opt="add_offering"]').removeClass('disabled');
            updateAll();
        });
   
    });

    $(document).on('click', 'span[data-opt="remove_offering"]', function() {

        $('span[data-opt="remove_offering"]').addClass('disabled');
        var id = $(this).data("id"),
            _this = $(this);

        $.ajax({
            url: "<?php echo base_url('res/ajax/remove_offering'); ?>/"+id,
            method: 'GET',
        }).done(function(data) {
            $('span[data-opt="add_offering"]').removeClass('disabled');
            updateAll();
        });
   
    });

    $(document).on('click', "#btn-next", function() {
        var step = $("#res-main").children("div").data("step");
        if (step < 4)
            switchPage(step + 1);
        else
            window.location = "<?php echo base_url('reservation/create'); ?>";
    })

    $(document).on('click', "#res-top li", function() {
        if (!$(this).hasClass("disabled") && $(this).index() < 3)
            switchPage($(this).index() + 1);
    })

    $(document).on('click', "#showhideRoomPriceDetail", function(event) {
        event.preventDefault();
        $("#roomPriceDetail").slideToggle();
    })

    function switchPage(step) {
        var geturl, gettext, getdata;
        switch (step) {
            case 1:
                var roomString = $("#roomString").val(),
                    ps = roomString.split(","),
                    hotel = ps[0], checkin = ps[1],
                    checkout = ps[2], noOfRoom = ps[3];

                geturl = 'res/ajax/room';
                gettext = 'Finish Select Room';
                getdata = "hotel="+hotel+"&checkin="+checkin+"&checkout="+
                            checkout+"&noOfRoom="+noOfRoom;
                break;
            case 2:
                geturl = 'res/ajax/offering';
                gettext = 'Finish Select Package';
                getdata = '';
                break;
            case 3:
                geturl = 'res/ajax/form';
                gettext = 'Finish and Review Order';
                getdata = '';
                break;
            case 4:
                geturl = 'res/ajax/confirm';
                gettext = 'Confirm Order';
                getdata = $("#reservePayment").serialize();
                break;
        }

        $.ajax({
            url: "<?php echo base_url('/'); ?>"+geturl,
            data: getdata,
            method: 'GET',
        }).done(function(data) {
            $("#res-main").html(data);
            $("#btn-next").text(gettext);
            updateAll(step);
        });
    }

    function updateAll(step) {
        updateTop();
        updateCart(step);
    }

    function updateTop() {
        var t = $('#res-top').find("li"),
            step = $("#res-main").children("div").data("step");

        t.removeClass("active").removeClass("disabled");

        for (i = 0; i < 4; i++) {
            if (i == step - 1)
                t.eq(i).addClass("active");
            else if (i > step - 1)
                t.eq(i).addClass("disabled");
        }
    }

    function updateCart(step) {
        $.ajax({
            url: "<?php echo base_url('res/ajax/cart'); ?>",
            method: 'GET'
        }).done(function(data) {
            $("#res-cart").html(data);
            var cartBtn = $("#res-cart .btn");
            if (step > 2) {
                cartBtn.hide();
            } else {
                cartBtn.show();
            }
        });
    }
});
</script>
