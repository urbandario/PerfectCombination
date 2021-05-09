<script>
    const btnScrollToTop = document.querySelector("#btnScrollToTop");
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
            btnScrollToTop.style.display = "block";
        } else {
            btnScrollToTop.style.display = "none";
        }
    }
    btnScrollToTop.addEventListener("click",function () {
        $("html, body").animate({scrollTop: 0}, "slow");
    });
</script>