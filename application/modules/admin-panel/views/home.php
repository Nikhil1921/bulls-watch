<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <?= anchor(admin('banner'), '<div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-danger">
                            <i class="nc-icon nc-image text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                                <p class="card-category">Banners</p>
                                <p class="card-title">'.$this->main->counter('banners', []).'</p><p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>', 'class="text-decoration-none"') ?>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <?= anchor(admin('testimonial'), '<div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-danger">
                            <i class="fa fa-users text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                                <p class="card-category">Testimonials</p>
                                <p class="card-title">'.$this->main->counter('testimonials', ['is_deleted' => 0]).'</p><p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>', 'class="text-decoration-none"') ?>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <?= anchor(admin('gallery'), '<div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-danger">
                            <i class="nc-icon nc-image text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                                <p class="card-category">Gallery</p>
                                <p class="card-title">'.$this->main->counter('gallery', []).'</p><p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>', 'class="text-decoration-none"') ?>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <?= anchor(admin('career'), '<div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-danger">
                            <i class="fa fa-users text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                                <p class="card-category">Careers</p>
                                <p class="card-title">'.$this->main->counter('careers', ['is_deleted' => 0]).'</p><p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>', 'class="text-decoration-none"') ?>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <?= anchor(admin('services'), '<div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-danger">
                            <i class="fa fa-file-text-o text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                                <p class="card-category">Services</p>
                                <p class="card-title">'.$this->main->counter('services', ['is_deleted' => 0]).'</p><p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>', 'class="text-decoration-none"') ?>
    </div>
</div>