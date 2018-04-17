<main>
    <div class="ui container">
        <div class="ui grid">
            <div class="sixteen wide column">
                <div class="col page-title">
                    <h2 class="ui header">
                        Settings
                    </h2>
                </div>
            </div>
        </div>
        <div class="ui grid">
            <div class="sixteen wide column">
                <div class="setting-tabs">
                    <?php echo Component::get('setting/tabs') ?>
                </div>
            </div>
        </div>
        <div class="ui grid">
            <div class="sixteen wide column">
                <form id="settingForm" class="ui form">
                    <?php foreach($settings as $setting):?>
                        <?php if($setting->key_field == 'language'): ?>
                            <div class="field">
                                <label for="formLangSite">
                                    <?= $setting->name ?>
                                </label>
                                <select class="ui search dropdown" name="<?= $setting->key_field ?>" id="formLangSite">
                                    <?php foreach ($languages as $language): ?>
                                        <option value="<?= $language->key ?>">
                                            <?= $language->title ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        <?php else: ?>
                            <div class="field">
                                <label for="formNameSite">
                                    <?= $setting->name ?>
                                </label>
                                    <input type="text" name="<?= $setting->key_field ?>" value="<?= $setting->value ?>" id="formNameSite">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <button type="submit" class="ui primary button" onclick="setting.update(this); return false;">
                        Save changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>