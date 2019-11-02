<?php
    include("../fillin/scripts.php");

    foreach (classes::getAllByID(accounts::get_current_account()->id) as $value) {
?>
    <div class="classDiv col-sm-2" id="newClassDiv" data-id="<?php echo $value->id; ?>">
        <div class="deleteClassDiv">
            <button class="deleteClass btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">Class name</span>
            <input class="form-control classInputField" value="<?php echo $value->name; ?>"></input>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Teacher name</span>
            <input class="form-control classInputField" value="<?php echo $value->teacher; ?>"></input>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Room number</span>
            <input class="form-control classInputField" value="<?php echo $value->roomNumber; ?>"></input>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Color</span>
            <select class="form-control selectpicker">
                <option data-content="<span class='colorCircle colorGrey'></span> Grey">grey</option>
                <option data-content="<span class='colorCircle colorLightGrey'></span> Light Grey">lightgrey</option>
                <option data-content="<span class='colorCircle colorRed'></span> Red">red</option>
                <option data-content="<span class='colorCircle colorPink'></span> Pink">pink</option>
                <option data-content="<span class='colorCircle colorPurple'></span> Purple">purple</option>
                <option data-content="<span class='colorCircle colorGreen'></span> Green">green</option>
                <option data-content="<span class='colorCircle colorYellow'></span> Yellow">yellow</option>
                <option data-content="<span class='colorCircle colorOrange'></span> Orange">orange</option>
                <option data-content="<span class='colorCircle colorBlue'></span> Blue">#7d7dff</option>
            </select>
            <script id="rs">
                $($("#rs").parent().children()[1]).selectpicker("val", "<?php echo $value->color; ?>")
                $("#rs").remove()
            </script>
        </div>
    </div>
<?php
    }
?>
