<?php

	function ispimpinan() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'PIMPINAN') {
			redirect('auth');
		}
	}

	function isadmin() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'ADMIN') {
			redirect('auth');
		}
	}

	function iskaryawan() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'KARYAWAN') {
			redirect('auth');
		}
	}

	function pimpinan_or_admin() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'PIMPINAN' && $level != 'ADMIN') {
			redirect('auth');
		}
	}