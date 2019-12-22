<?php
namespace ant\widgets;

class TinyMce extends \dosamigos\tinymce\TinyMce {
	public $fileFinder = [
		'url' => ['/file/elfinder/tinymce'],
	];
	
	public function init() {
		parent::init();
		
		$this->clientOptions['plugins'] = 'image';
		$this->clientOptions['file_picker_types'] = 'file image media';
		$this->clientOptions['file_picker_callback'] = \ant\file\widgets\ElFinder::getFilePickerCallback($this->fileFinder['url']);
	}
}