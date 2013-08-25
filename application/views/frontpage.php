
    <div class="row" id="carousel-item">
        <div class="carousel slide span12" id="home_img_slides">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo base_url('assets/img/single_standard.jpg'); ?>" alt="Single Room">
                    <div class="carousel-caption">
                        <h4>Single Room</h4>
                        <p>single room. </p>
                    </div>
                </div>

                <div class="item">
                    <img src="<?php echo base_url('assets/img/double_standard.jpg'); ?>" alt="Double Room">
                    <div class="carousel-caption">
                        <h4>Double Room</h4>
                        <p>double room. </p>
                    </div>
                </div>

                <div class="item">
                    <img src="<?php echo base_url('assets/img/family_standard.jpg'); ?>" alt="King's Room">
                    <div class="carousel-caption">
                        <h4>King's Room</h4>
                        <p>King's room. </p>
                    </div>
                </div>
            </div>
            <a href="#home_img_slides" class="left carousel-control home_slide" data-slide="prev">&lsaquo;</a> 
            <a href="#home_img_slides" class="right carousel-control home_slide" data-slide="next">&rsaquo;</a> 
        </div>

        <div id="search-box">
            <form class="form-horizontal" method="post" action="<?php echo base_url('reservation'); ?>">
                <div class="control-group">
                    <label class="control-label" for="destination">Destination</label>
                    <div class="controls">
                        <select id="destination" name="destination" class="input-small">
                            <?php foreach($hotels as $hotel): ?>
                            <option value="<?php echo $hotel['id']; ?>"><?php echo $hotel['hotel_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Check-in</label>
                    <div class="controls">
                        <input id="dpd1" type="text" class="input-small" readonly name="checkin" data-date-format="dd-mm-yyyy"></input>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Check-out</label>
                    <div class="controls">
                        <input id="dpd2" type="text" class="input-small" readonly name="checkout" data-date-format="dd-mm-yyyy"></input>
                    </div>
                </div>
                <script>
                    (function(){

                        var nowTemp = new Date();
                        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                         
                        var checkin = $('#dpd1').datepicker({
                          onRender: function(date) {
                            return date.valueOf() < now.valueOf() ? 'disabled' : '';
                          }
                        }).on('changeDate', function(ev) {
                          if (ev.date.valueOf() > checkout.date.valueOf()) {
                            var newDate = new Date(ev.date)
                            newDate.setDate(newDate.getDate() + 1);
                            checkout.setValue(newDate);
                          }
                          checkin.hide();
                          $('#dpd2')[0].focus();
                        }).data('datepicker');
                        var checkout = $('#dpd2').datepicker({
                          onRender: function(date) {
                            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                          }
                        }).on('changeDate', function(ev) {
                          checkout.hide();
                        }).data('datepicker');
                    
                    })();
                </script>
                <div class="control-group">
                    <label class="control-label" for="no-of-room">Rooms</label>
                    <div class="controls">
                        <select id="no-of-room" name="no-of-room" class="input-mini">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="no-of-adults">Adults</label>
                    <div class="controls">
                        <select id="no-of-adults" class="input-mini">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="no-of-children">Children</label>
                    <div class="controls">
                        <select id="no-of-children" class="input-mini">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" href="#" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div class="row">
        <div class="span3">
            <ul class="thumbnails thumb1">
                <li class="span3">
                <div class="home-links">
                    <img src="<?php echo base_url('assets/img/ecotourism_australia_logo.jpg'); ?>" alt="ecotourism."/>
                    <h3>Eco Tourism Australia.</h3>
                    <p>Take care of our environment.</p></br>
                    <a class="btn btn-success" href="http://www.ecotourism.org.au/">More</a>
                </div>
                </li>
            </ul>
        </div>

        <div class="span3">
            <ul class="thumbnails thumb2">
                <li class="span3">
                <div class="home-links">
                    <img src="<?php echo base_url('assets/img/melbourne.jpg'); ?>" alt="melbourne."/>
                    <h3>Welcome To Melbourne!</h3>
                    <p>Explore and Enjoy Melbourne!</p></br>
                    <a class="btn btn-success" href="http://www.visitvictoria.com/Regions/Melbourne.aspx">More</a>
                </div>
                </li>
            </ul>
        </div>

        <div class="span3">
            <ul class="thumbnails thumb3">
                <li class="span3">
                <div class="home-links">
                    <img src="<?php echo base_url('assets/img/public_trans_vic.png'); ?>" alt="Travel in Melbourne"/>
                    <h3>Travel in Melbourne.</h3>
                    <p>It's easy and fun to travel in Melbourne.</p>
                    <a class="btn btn-success" href="http://ptv.vic.gov.au/">More</a>
                </div>
                </li>
            </ul>
        </div>

        <div class="span3">
            <ul class="thumbnails thumb4">
                <li class="span3">
                <div class="home-links">
                    <img src="<?php echo base_url('assets/img/ecocertified.jpg'); ?>" alt="Eco Operators"/>
                    <h3>Useful links of eco-friendly travel operators</h3>
                    <p><a class="btn btn-success" href="http://www.atwad.com.au/">A Tour With A Difference</a></p>
                    <p><a class="btn btn-success" href="http://www.adventuretours.com.au/category/tours/from/melbourne">Adventure Tours</a></p>
                    <p><a class="btn btn-primary" href="http://www.bikebeyond.com.au/index.html">Bike Beyond</a></p>
                </div>
                </li>
            </ul>
        </div>

        <style>
            #carousel-item {
                margin-bottom: 0px;
            }
            .home-links {
                background-color: #333333;
                color: white;
                padding: 14px;
                min-height: 360px;
                position: relative;
            }            
            .home-links h3 {
                line-height: 1.2em;
            }

            .home-links > a {
                margin-top: 54px;
            }
        </style>

    </div>
