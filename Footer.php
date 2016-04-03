<a href="#" class="scroll"><img src="img/Scroll-to-top-button.png" alt="Fleche vers le haut" /></a>
<footer>
	<div>
		<div>Site Web créé par : Michael BOUTBOUL	-   Marie-Lucile CANIARD<br/><br/></div>
	</div>
</footer>
	<script src="js/vendor/smoothscroll.js"></script>
	<script src="js/vendor/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('body').append('<a href="#top" class="top_link" title="Revenir en haut de page"></a>');
		});
	</script>
	<script>
		$(document).ready(function()
		{
			
			//Check to see if the window is top if not then display button
			$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
					$('.scroll').fadeIn();
				} else {
					$('.scroll').fadeOut();
				}
			});
			
			//Click event to scroll to top
			$('.scroll').click(function(){
				$('html, body').animate({scrollTop : 0},800);
				return false;
			});
			
		});
	</script>
    <script src="js/foundation.min.js"></script>
    <script> $(document).foundation();</script>
	</body>
</html>