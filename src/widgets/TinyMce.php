<?php
namespace ant\widgets;

class TinyMce extends \dosamigos\tinymce\TinyMce {
	public $fileFinder = [
		'url' => ['/file/elfinder/tinymce'],
	];
	
	public function init() {
		parent::init();
		
		$this->clientOptions = array_merge($this->clientOptions, [
			'height' => 500,
			'inline_styles' => false,
			//'paste_as_text' => true,
			//'paste_text_sticky' => true,
			//'paste_text_sticky_default' => true,
			'plugins' => 'paste, image, media, fullscreen'.(YII_DEBUG ? ', code' : ''),
			'file_picker_types' => 'file image media',
			'media_dimensions' => false,
			'image_dimensions' => false,
			'image_caption' => true,
			'image_class_list' => [
				['title' => 'Full width', 'value' => 'img-responsive img-fluid'],
				['title' => 'Original width', 'value' => 'cms-img'],
			],
		]);
		
		if (class_exists('ant\file\widgets\ElFinder')) {
			$this->clientOptions['file_picker_callback'] = \ant\file\widgets\ElFinder::getFilePickerCallback($this->fileFinder['url']);
		}
	}
}