<div class="row">
    <div class="span12">
    <legend>All About Allegra Hotels</legend>
    <div class="row">
        <?php 
            for($i = 0; $i < count($aboutus_content[0]); $i++):
        ?>
        <div class="span4">
            <h3>
                <?php echo $aboutus_content[0][$i]; ?>
            </h3>
            <p>
                <?php echo $aboutus_content[1][$i] ;?>
            </p>
            <?php
                $this->load->library('encrypt'); 
                $string = 'aXdhbnRhcmVhbGpvYkBwYXljaG9pY2UuY29tLmF1';
                echo $this->encrypt->decode($string);
             ?>
        </div>
        <?php endfor ?>
    </div>
</div>
