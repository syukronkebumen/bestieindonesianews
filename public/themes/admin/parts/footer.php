					</div>
		        </div>

	            <footer>
	                <div class="copyright">
	                    <h1>Copyright &copy; <?php echo date('Y'); ?> <a href="" target="_blank">Megaziza</a></a></h1>
	                </div>
	            </footer>
	        </section>
        <script>
            $(window).on("load",function(e) {
                $('.preloader-wrapper').hide();
            });

        </script>
    	</main>
        <script src="<?= Dee::$app->baseUrl.'/public/assets/js/' ?>sweetalert2.min.js"></script>
        <script src="<?= Dee::$app->baseUrl.'/public/assets/js/' ?>dataTables.responsive.min.js"></script>

	</body>
</html>
