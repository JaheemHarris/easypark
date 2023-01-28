<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');
		if(!function_exists('assets_loader')){
			function assets_loader($fileName){
				$assetsFolder="assets/";
				return base_url($assetsFolder.$fileName);
			}
		}
		if(!function_exists('css_loader')){
			function css_loader($cssFileName){
				$cssFolder="assets/css/";
				return base_url($cssFolder.$cssFileName);
			}
		}
		if(!function_exists('js_loader')){
			function js_loader($jsFileName){
				$jsFolder="assets/js/";
				return base_url($jsFolder.$jsFileName);
			}
		}
		// if(!function_exists('bootstrap_css_loader')){
		// 	function bootstrap_css_loader($jsFileName){
		// 		$jsFolder="assets/bootstrap/dist/css/";
		// 		return base_url($jsFolder.$jsFileName);
		// 	}
		// }
		// if(!function_exists('bootstrap_js_loader')){
		// 	function bootstrap_js_loader($jsFileName){
		// 		$jsFolder="assets/bootstrap/dist/js/";
		// 		return base_url($jsFolder.$jsFileName);
		// 	}
		// }
		// if(!function_exists('plugins_loader')){
		// 	function plugins_loader($jsFileName){
		// 		$jsFolder="assets/plugins/";
		// 		return base_url($jsFolder.$jsFileName);
		// 	}
		// }
		if(!function_exists('image_loader')){
			function image_loader($imageSource){
				$imageFolder="assets/img/";
				return base_url($imageFolder.$imageSource);
			}
		}
		if(!function_exists('font_loader')){
			function font_loader($font){
				$fontFolder="assets/fonts/";
				return base_url($fontFolder.$font);
			}
		}
		// if(!function_exists('bootstrap4_css_loader')){
		// 	function bootstrap4_css_loader($jsFileName){
		// 		$jsFolder="assets/bootstrap-4.6.1-dist/css/";
		// 		return base_url($jsFolder.$jsFileName);
		// 	}
		// }
		// if(!function_exists('bootstrap4_js_loader')){
		// 	function bootstrap4_js_loader($jsFileName){
		// 		$jsFolder="assets/bootstrap-4.6.1-dist/js/";
		// 		return base_url($jsFolder.$jsFileName);
		// 	}
		// }
