<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $operation ?> <?= $title ?></h4>
    </div>
    <div class="card-body">
        <?= form_open_multipart('', '', ['image' => isset($data['image']) ? $data['image'] : '']) ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Name', 'name', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'id' => "name",
                            'name' => "name",
                            'maxlength' => 200,
                            'required' => "",
                            'onkeyup' => "changeSlug(this.value.trim());",
                            'value' => set_value('name') ? html_entity_decode(set_value('name')) : (isset($data['name']) ? $data['name'] : '')
                        ]); ?>
                        <?= form_error('name') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Slug', 'slug', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'type' => "text",
                            'id' => "slug",
                            'name' => "slug",
                            'maxlength' => 200,
                            'readonly' => 'readonly',
                            'required' => "",
                            'value' => set_value('slug') ? set_value('slug') : (isset($data['slug']) ? $data['slug'] : '')
                        ]); ?>
                        <?= form_error('slug') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= form_label('Title', 'title', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'id' => "title",
                            'name' => "title",
                            'maxlength' => 200,
                            'required' => "",
                            'value' => set_value('title') ? html_entity_decode(set_value('title')) : (isset($data['title']) ? $data['title'] : '')
                        ]); ?>
                        <?= form_error('title') ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <?= img('assets/images/image-placeholder.jpg') ?>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <?= form_input([
                                'id' => "image",
                                'name' => "image",
                                'type' => "file",
                                'accept' => "image/jpg, image/jpeg, image/png",
                                isset($data['image']) ? 'required' : '',
                            ]); ?>
                            </span>
                            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                </div>
                <?php if(isset($data['image'])): ?>
                    <div class="col-md-3">
                        <?= img($this->path.$data['image'], '', 'height="170" width="100%"') ?>
                    </div>
                <?php endif ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= form_label('Description', 'description', 'class="col-form-label"') ?>
                        <textarea name="description" id="description" class="form-control ckeditor" required=""><?= set_value('description') ? set_value('description') : (isset($data['description']) ? $data['description'] : '') ?></textarea>
                        <?= form_error('description') ?>
                    </div>
                </div>
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