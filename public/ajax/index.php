<script src=".././js/jquery/jquery-1.11.3.min.js"></script>
<script>
    $.getJSON(
        '/ajax/index.do.php',
        function(d) {
            console.log(d)
        }
    );
</script>