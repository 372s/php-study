<script>
    var dd = 1556099880 * 1000;
    var date = new Date(dd);
    var Y = date.getFullYear();
    var M = date.getMonth();
    var D = date.getDate();
    console.log(date.toLocaleDateString().replace(/\//g, '-'));
    console.log(Y);
    console.log(M);
    console.log(D);
</script>