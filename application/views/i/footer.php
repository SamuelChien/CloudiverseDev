				<footer>
						<section id="footer-top">
								<div class="container padding row font-thin">
										<ul id="site-index">
												<li><a href="#">Site link #1</a></li>
												<li><a href="#">Site link #2</a></li>
												<li><a href="#">Site link #3</a></li>
										</ul>
								</div>
						</section>
						<section id="footer-middle">
								<div class="container font-interface">
										<section class="border-bottom row padding-bottom">
												<section class="columns medium-4 text-center bordered padding">
														<div class="heading font-title text-upper padding-bottom">Cloudiverse</div>
														<div class="font-thin">a short about cloudiverse goes here</div>
												</section>
												<section class="columns medium-8 text-center">
														<div class="columns padding medium-4 bordered">
																<div class="font-thin padding-bottom">Something about Premium</div>
																<div>Want this? blah blah ... </div>
														</div>
														<div class="columns padding medium-4 bordered">
																<div class="font-thin padding-bottom">Need Help?</div>
																<div>Why not ... </div>
														</div>
														<div class="columns padding medium-4">
																<div class="font-thin padding-bottom">Search</div>
																<div>Search Form here</div>
														</div>
												</section>
										</section>
										<section class="row padding">
												<div class="columns padding large-2 medium-4">
														<div class="font-thin padding-bottom">Feature #1</div>
														<div>Lorem ipsum dolor sit amet, eam sint debitis ea, ne sea natum sensibus molestiae. Persius omittam suscipit et sea, modo aliquid eam cu.</div>
												</div>
												<div class="columns padding large-2 medium-4">
														<div class="font-thin padding-bottom">Feature #2</div>
														<div>Lorem ipsum dolor sit amet, eam sint debitis ea, ne sea natum sensibus molestiae. Persius omittam suscipit et sea, modo aliquid eam cu.</div>
												</div>
												<div class="columns padding large-2 medium-4">
														<div class="font-thin padding-bottom">Feature #3</div>
														<div>Lorem ipsum dolor sit amet, eam sint debitis ea, ne sea natum sensibus molestiae. Persius omittam suscipit et sea, modo aliquid eam cu.</div>
												</div>
												<div class="columns padding large-2 medium-4">
														<div class="font-thin padding-bottom">Feature #4</div>
														<div>Lorem ipsum dolor sit amet, eam sint debitis ea, ne sea natum sensibus molestiae. Persius omittam suscipit et sea, modo aliquid eam cu.</div>
												</div>
												<div class="columns padding large-2 medium-4">
														<div class="font-thin padding-bottom">Feature #5</div>
														<div>Lorem ipsum dolor sit amet, eam sint debitis ea, ne sea natum sensibus molestiae. Persius omittam suscipit et sea, modo aliquid eam cu.</div>
												</div>
												<div class="columns padding large-2 medium-4">
														<div class="font-thin padding-bottom">Feature #6</div>
														<div>Lorem ipsum dolor sit amet, eam sint debitis ea, ne sea natum sensibus molestiae. Persius omittam suscipit et sea, modo aliquid eam cu.</div>
												</div>
										</section>
								</div>
						</section>
						<section id="footer-bottom" class="font-interface">
								<div class="container padding row">
										<div id="footer-legalinfo" class="medium-6 columns padding">
												<div id="version">v<?php echo config_item('version').' | Generated in '.$this->benchmark->elapsed_time().' seconds'; ?></div>
												<div id="legal">2013 &copy; Cloudiverse Inc. All rights reserved.</div>
										</div>
										<div id="footer-social" class="font-awesome medium-6 columns padding">
												<a href="#"><div id="site-fb">&#xf09a;</div></a>
												<a href="#"><div id="site-twitter">&#xf099;</div></a>
												<a href="#"><div id="site-mail">&#xf003;</div></a>
										</div>
								</div>
						</section>
				</footer>
				<section id="body-scripts">
						<script type='text/javascript' src="<?php echo base_url('asset/js/foundation.min.js');?>"></script>
						<script type='text/javascript' src="<?php echo base_url('asset/js/header.js');?>"></script>
						<script> $(document).foundation(); </script>
<?php
		// Custom JS includes goes here!
		foreach ($header_JS_inc as $script) { ?>
						<script type="text/javascript" src="<?php echo $script?>"></script>
<?php } ?>
				</section>
		</body>
</html>