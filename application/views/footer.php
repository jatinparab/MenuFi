
<style>
	/* scrol css */
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: #ce9137;
  color: white;
  cursor: pointer;
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

#myBtn:hover {
  background-color: #191919;
}
</style>
<div class="scroll">
	<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
</div>

<script>

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {

  $("html, body").animate({ scrollTop: 0 }, "slow");
}

</script>	