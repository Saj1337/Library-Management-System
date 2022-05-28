<!-- These js file for all js functionality -->
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/parsley.min.js"></script>
<script src="js/wow.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


<script>
new WOW().init();
</script>
<script>
$(document).ready(function() {
    $('.input-focus').on('click', function() {
        $(this).children('input').focus();
    });
});
</script>
<script>
// optional
$('#carouselExampleIndicators').carousel({
    interval: 5000
});
</script>