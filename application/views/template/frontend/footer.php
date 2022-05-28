			</div> <!-- end container -->
		</div>
		<!-- end wrapper -->
		<!-- Footer -->
		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						© 2022 <?= $web_title;?>.
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer -->

		<!-- JS Plugins Init. -->
		<script>
			function tour() {
				introJs().setOptions({
					disableInteraction: true,
					steps: [{
						intro: "Welcome, we will briefly explain our feature`s"
					}]
				}).start();
			}

			$(document).ready(function () {
				$('table.table').each(function () {
					$($(this).attr('id')).DataTable({
						responsive: true
					});
				});

				//  ckeditor
				$('textarea.editor').each(function () {
					CKEDITOR.replace($(this).attr('id'));
				});
			})

		</script>

	</body>

</html>