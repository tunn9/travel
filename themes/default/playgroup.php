<script>
// Check browser support
if (typeof(Storage) !== "undefined") {
    // Store
    $('form.rental').submit(function() {
        localStorage.setItem("startlocation", $('[name=startlocation]').val());
        localStorage.setItem("endlocation", $('[name=endlocation]').val());
        return true;
    });

    // Retrieve
    $('[name=startlocation]').val(localStorage.getItem("startlocation"));
    $('[name=endlocation]').val(localStorage.getItem("endlocation"));
}
</script>

