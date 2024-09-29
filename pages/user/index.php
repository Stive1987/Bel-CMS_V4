<?php
/**
 * Bel-CMS [Content management system]
 * @version 4.0.0 [PHP8.3]
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license MIT License
 * @copyright 2015-2025 Bel-CMS
 * @author as Stive - stive@determe.be
*/

use BelCMS\Requires\Common;

require ROOT.DS.'assets'.DS.'country.php';
if (!empty($user->profils->gender)) {
    $user->gender   = strtolower($user->profils->gender);
    $genderM        = $user->gender == 'MALE' ? 'selected' : '';
    $genderF        = $user->gender == 'FEMALE' ? 'selected' : '';
    $genderU        = $user->gender == 'NOSPEC' ? 'selected' : '';
} else {
    $genderM        = '';
    $genderF        = '';
    $genderU        = 'selected';
}
$birthday = Common::DatetimeReverse($user->profils->birthday);
if (empty($user->profils->avatar)) {
    $user->profils->avatar = constant('DEFAULT_AVATAR');
}
if (!empty($user->profils->hight_avatar) and !is_file($user->profils->hight_avatar)) {
    $user->profils->hight_avatar = 'assets/img/bg_default.png';
}
?>
<article class="belcms_user">
    <section class="belcms_user_content">
        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <?php include 'menu.php'; ?>
                </div>
                <div class="col-5">
                    <div id="section_user_profil">
                        <h2>Informations personnelles</h2>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                            <input id="username" class="form-control" placeholder="Username" type="text" required="required" name="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" value="<?=$_SESSION['USER']->user->username;?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input class="form-control" placeholder="e-mail" type="email" required="required" name="username" pattern="^[a-zA-Z0-9._%±]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$" value="<?=$_SESSION['USER']->user->mail;?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            <input placeholder="Anniversaire" class="form-control" type="date" name="birthday" value="<?=$_SESSION['USER']->profils->birthday;?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"> <i class="fa-solid fa-link"></i></span>
                            <input placeholder="Site-Web" class="form-control" type="url" name="websites" value="<?=$_SESSION['USER']->profils->websites;?>">
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" name="country">
                                <?php
                                foreach (contryList() as $k => $v):
                                    $selected = $user->profils->country == $v ? 'selected="selected"' : '';
                                    echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <select name="gender" class="form-select">
                                <option <?=$genderM?> value="male"><?=constant('MALE')?></option>
                                <option <?=$genderF?> value="female"><?=constant('FEMALE')?></option>
                                <option <?=$genderU?> value="nospec"><?=constant('NO_SPEC')?></option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                </div>
                <div class="col-3">
                <div id="section_user_profil_avatar">
                    <div id="section_user_profil_avatar_change">

                    </div>
                </div>
                    <textarea name="info_text" class="bel_cms_textarea_simple"><?=$_SESSION['USER']->profils->info_text?></textarea>
                </div>
            </div>
        </div>
    </section>
</article>

