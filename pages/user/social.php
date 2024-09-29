<article class="belcms_user">
    <section class="belcms_user_content">
        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <?php include 'menu.php'; ?>
                </div>
                <div class="col-8">
					<form action="user/submitsocial" method="post" class="belcms_section_user_main_form">
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-facebook"></i></span>
							<input class="form-control" name="facebook" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('FACEBOOK');?>" value="<?=$user->social->facebook?>" pattern="^[a-z\d\.]{5,}$">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-x-twitter"></i></span>
							<input class="form-control" name="x_twitter" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('X_TWITTER');?>" value="<?=$user->social->x_twitter?>" pattern="^[A-Za-z0-9_]{1,15}$">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-discord"></i></span>
							<input class="form-control" name="discord" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('DISCORD');?>" value="<?=$user->social->discord?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-pinterest"></i></span>
							<input class="form-control" name="pinterest" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('PINTEREST');?>" value="<?=$user->social->pinterest?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-linkedin-in"></i></span>
							<input class="form-control" name="linkedIn" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('LINKEDIN');?>" value="<?=$user->social->linkedIn?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-youtube"></i></span>
							<input class="form-control" name="youtube" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('YOUTUBE');?>" value="<?=$user->social->youtube?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-whatsapp"></i></span>
							<input class="form-control" name="whatsapp" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('WHATSAPP');?>" value="<?=$user->social->whatsapp?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-instagram"></i></span>
							<input class="form-control" name="instagram" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('INSTAGRAM');?>" value="<?=$user->social->instagram?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-facebook-messenger"></i></span>
							<input class="form-control" name="messenger" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('MESSENGER');?>" value="<?=$user->social->messenger?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-tiktok"></i></span>
							<input class="form-control" name="tiktok" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('TIKTOK');?>" value="<?=$user->social->tiktok?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-snapchat"></i></span>
							<input class="form-control" name="snapchat" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('SNAPCHAT');?>" value="<?=$user->social->snapchat?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-telegram"></i></span>
							<input class="form-control" name="telegram" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('TELEGRAM');?>" value="<?=$user->social->telegram?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-reddit"></i></span>
							<input class="form-control" name="reddit" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('REDDIT');?>" value="<?=$user->social->reddit?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-skype"></i></span>
							<input class="form-control" name="skype" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('SKYPE');?>" value="<?=$user->social->skype?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-viber"></i></span>
							<input class="form-control" name="viber" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('VIBER');?>" value="<?=$user->social->viber?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-windows"></i></span>
							<input class="form-control" name="teams_ms" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('TEAMS_MS');?>" value="<?=$user->social->teams_ms?>">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa-brands fa-twitch"></i></span>
							<input class="form-control" name="twitch" type="text" placeholder="<?=constant('ENTER_YOUR');?> <?=constant('TWITCH');?>" value="<?=$user->social->twitch?>">
						</div>
						<div class="input-group mb-3">
							<button type="submit" class="btn btn-secondary">Enregistrer</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</article>