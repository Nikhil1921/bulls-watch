<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $operation ?> <?= $title ?></h4>
    </div>
    <div class="card-body">
        <?= form_open() ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Titile', 'c_title', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'id' => "c_title",
                            'name' => "c_title",
                            'maxlength' => 100,
                            'required' => "",
                            'value' => set_value('c_title') ? set_value('c_title') : (isset($data['c_title']) ? $data['c_title'] : '')
                        ]); ?>
                        <?= form_error('c_title') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Eligibility', 'eligibility', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'id' => "eligibility",
                            'name' => "eligibility",
                            'maxlength' => 100,
                            'required' => "",
                            'value' => set_value('eligibility') ? set_value('eligibility') : (isset($data['eligibility']) ? $data['eligibility'] : '')
                        ]); ?>
                        <?= form_error('eligibility') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Height', 'height', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'id' => "height",
                            'name' => "height",
                            'maxlength' => 3,
                            'required' => "",
                            'value' => set_value('height') ? set_value('height') : (isset($data['height']) ? $data['height'] : '')
                        ]); ?>
                        <?= form_error('height') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Documents', 'documents', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'id' => "documents",
                            'name' => "documents",
                            'maxlength' => 150,
                            'required' => "",
                            'value' => set_value('documents') ? set_value('documents') : (isset($data['documents']) ? $data['documents'] : '')
                        ]); ?>
                        <?= form_error('documents') ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= form_label('Description', 'description', 'class="col-form-label"') ?>
                        <?= form_textarea([
                            'class' => "form-control",
                            'id' => "description",
                            'name' => "description",
                            'required' => "",
                            'value' => set_value('description') ? set_value('description') : (isset($data['description']) ? $data['description'] : '')
                        ]); ?>
                        <?= form_error('description') ?>
                    </div>
                </div>
                <div class="col-12"></div>
                <div class="col-6 col-md-3">
                    <?= form_button([
                        'type'    => 'submit',
                        'class'   => 'btn btn-outline-primary btn-round btn-block col-12',
                        'content' => 'SAVE'
                    ]); ?>
                </div>
                <div class="col-6 col-md-3">
                    <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger btn-round btn-block col-12"'); ?>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>