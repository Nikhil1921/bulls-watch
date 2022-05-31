<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= form_label('Job') ?>
            <?= form_input([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($c_title) ? $c_title : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= form_label('Name') ?>
            <?= form_input([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($name) ? $name : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= form_label('Mobile') ?>
            <?= form_input([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($phone) ? $phone : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= form_label('Email') ?>
            <?= form_input([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($email) ? $email : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= form_label('Subject') ?>
            <?= form_input([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($subject) ? $subject : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= form_label('Aadhar No.') ?>
            <?= form_input([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($aadhar) ? $aadhar : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?= form_label('Message') ?>
            <?= form_textarea([
                'class' => "form-control",
                'readonly' => "",
                'value' => isset($message) ? $message : ''
            ]); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= form_label('Photo') ?>
            <?= img($this->path.$image, '', 'height="250" width="100%"') ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= form_label('Police Certificate') ?>
            <?= img($this->path.$police_certy, '', 'height="250" width="100%"') ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= form_label('Licence') ?>
            <?= img($this->path.$licence, '', 'height="250" width="100%"') ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?= form_label('Resume') ?>
            <iframe src="<?= base_url($this->path.$resume) ?>" width="100%" height="500"></iframe>
        </div>
    </div>
</div>