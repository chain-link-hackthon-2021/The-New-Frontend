<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <script src="/assets/js/jquery.min.js"></script>
    <section class="content">

        <style>
            .coinimage {
                width: 40px;
                height: 40px;
            }
            .form-group{
                margin-bottom: 10px;
            }
        </style>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="/Shop/<?= $name; ?>/Design" method="POST" enctype="multipart/form-data" class="card-style mb-30" style="padding: 25px 10px;">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h4 class="text-bold">Design</h4>
                            </div>
                            <div class="right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-show-help-desk-button" type="checkbox" <?php if($shops[0]['showHelp'] == 1){ echo 'checked="checked"';} ?> data-val="true" data-val-required="The Show Help Desk Button field is required." name="ShowHelpDeskButton" value="true">
                                    <label class="custom-control-label" for="sw-show-help-desk-button">Show Help Desk Button</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-show-badges" type="checkbox" <?php if($shops[0]['showBadges'] == 1){ echo 'checked="checked"';} ?>  data-val="true" data-val-required="The Show Badges field is required." name="ShowBadges" value="true">
                                    <label class="custom-control-label" for="sw-show-badges">Show Badges</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input" id="sw-show-profile-image" type="checkbox" <?php if($shops[0]['displayImage'] == 1){ echo 'checked="checked"';} ?>  data-val="true" data-val-required="The Display Profile Image field is required." name="ShowProfileImage" value="true">
                                    <label class="custom-control-label" for="sw-show-profile-image">Display Profile Image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-center bg-gray-light">
                                    <input type="hidden" name="oldImage" value="<?= $shops[0]['imageSrc']; ?>">
                                    <img style="height:200px;" id="blah" class="img-fluid" src="<?= $shops[0]['imageSrc']; ?>" alt="your image">
                                </div>
                                <hr>
                                <div>
                                    <label class="control-label">Banner Image</label>
                                    <input type="file" accept="image/*" name="BannerImage" id="imgInp">
                                </div>
                                <span class="text-danger field-validation-valid" data-valmsg-for="BannerImage" data-valmsg-replace="true"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>